<?php
// app/Services/PincodeService.php
namespace App\Services;

use App\Models\Pincode;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;  // ← ADD THIS LINE!

class PincodeService
{
    protected $apiBaseUrl = 'https://api.postalpincode.in/pincode';

    /**
     * Get pincode details from API or cache
     */
    public function getPincodeDetails(string $pincode): ?array
    {
        return Cache::remember("pincode_{$pincode}", 86400, function () use ($pincode) {
            try {
                $response = Http::timeout(10)->get("{$this->apiBaseUrl}/{$pincode}");

                if ($response->successful()) {
                    $data = $response->json();

                    if (!empty($data[0]['PostOffice'])) {
                        $firstOffice = $data[0]['PostOffice'][0];

                        return [
                            'pincode' => $pincode,
                            'office_name' => $firstOffice['Name'] ?? null,
                            'district' => $firstOffice['District'] ?? null,
                            'state' => $firstOffice['State'] ?? null,
                            'division' => $firstOffice['Division'] ?? null,
                            'region' => $firstOffice['Region'] ?? null,
                            'circle' => $firstOffice['Circle'] ?? null,
                            'taluk' => $firstOffice['Taluk'] ?? null,
                            'latitude' => $this->geocodePincode($pincode, $firstOffice)['lat'] ?? null,
                            'longitude' => $this->geocodePincode($pincode, $firstOffice)['lng'] ?? null,
                        ];
                    }
                }
            } catch (\Exception $e) {
                Log::error("Failed to fetch pincode {$pincode}: " . $e->getMessage());
            }

            return null;
        });
    }

    /**
     * Geocode pincode to get coordinates
     * Using OpenStreetMap as free alternative
     */
    private function geocodePincode(string $pincode, array $officeData): array
    {
        // Try multiple geocoding strategies
        $coordinates = $this->geocodeFromOpenStreetMap($pincode, $officeData);

        if (!$coordinates) {
            // Fallback to approximate coordinates based on state
            $coordinates = $this->getStateCoordinates($officeData['State'] ?? 'Gujarat');
        }

        return $coordinates;
    }

    private function geocodeFromOpenStreetMap(string $pincode, array $officeData): array
    {
        $query = urlencode("{$pincode}, {$officeData['District']}, {$officeData['State']}, India");

        try {
            $response = Http::get("https://nominatim.openstreetmap.org/search", [
                'q' => $query,
                'format' => 'json',
                'limit' => 1
            ]);

            $data = $response->json();

            if (!empty($data[0])) {
                return [
                    'lat' => (float) $data[0]['lat'],
                    'lng' => (float) $data[0]['lon']
                ];
            }
        } catch (\Exception $e) {
            // Silently fail and use fallback
        }

        return [];
    }

    private function getStateCoordinates(string $state): array
    {
        // Approximate state center coordinates
        $stateCoordinates = [
            'Gujarat' => ['lat' => 22.2587, 'lng' => 71.1924],
            'Maharashtra' => ['lat' => 19.7515, 'lng' => 75.7139],
            'Delhi' => ['lat' => 28.7041, 'lng' => 77.1025],
            // Add more states as needed
        ];

        return $stateCoordinates[$state] ?? ['lat' => 20.5937, 'lng' => 78.9629]; // India center
    }

    /**
     * OPTIMIZED nearby search using SQL calculation (faster with indexes)
     */
    public function getNearbyPincodesOptimized(string $basePincode, int $radiusKm = 300): array
    {
        $base = $this->getOrCreatePincode($basePincode);

        if (!$base || !$base->latitude || !$base->longitude) {
            return [];
        }

        // Using bounding box optimization first
        $boundingBox = $this->calculateBoundingBox($base->latitude, $base->longitude, $radiusKm);

        // First get candidates within bounding box (uses latitude,longitude index)
        $candidates = Pincode::whereBetween('latitude', [$boundingBox['min_lat'], $boundingBox['max_lat']])
            ->whereBetween('longitude', [$boundingBox['min_lng'], $boundingBox['max_lng']])
            ->where('pincode', '!=', $basePincode)
            ->get();

        if ($candidates->isEmpty()) {
            return [];
        }

        // Then calculate exact distance for candidates only
        $nearby = [];
        foreach ($candidates as $candidate) {
            $distance = $this->calculateHaversineDistance(
                $base->latitude,
                $base->longitude,
                $candidate->latitude,
                $candidate->longitude
            );

            if ($distance <= $radiusKm) {
                $nearby[] = [
                    'pincode' => $candidate->pincode,
                    'office_name' => $candidate->office_name,
                    'district' => $candidate->district,
                    'state' => $candidate->state,
                    'distance_km' => round($distance, 2),
                    'latitude' => $candidate->latitude,
                    'longitude' => $candidate->longitude,
                ];
            }
        }

        // Sort by distance
        usort($nearby, function ($a, $b) {
            return $a['distance_km'] <=> $b['distance_km'];
        });

        return array_slice($nearby, 0, 100); // Limit to 100
    }

    public function getNearbyPincodes_query(string $basePincode, int $radiusKm = 300): array
    {
        // Get base coordinates
        $base = Pincode::select('latitude', 'longitude')
            ->where('pincode', $basePincode)
            ->first();

        if (!$base) return [];

        // SIMPLE FAST QUERY - no complex calculations
        $results = DB::select("
        SELECT 
            pincode, office_name, district, state, latitude, longitude,
            (6371 * ACOS(
                COS(RADIANS(?)) * COS(RADIANS(latitude)) *
                COS(RADIANS(longitude) - RADIANS(?)) +
                SIN(RADIANS(?)) * SIN(RADIANS(latitude))
            )) AS distance_km
        FROM pincodes
        WHERE latitude BETWEEN ? - (? / 111.0) AND ? + (? / 111.0)
          AND longitude BETWEEN ? - (? / (111.0 * COS(RADIANS(?)))) 
                            AND ? + (? / (111.0 * COS(RADIANS(?))))
          AND pincode != ?
        HAVING distance_km <= ?
        ORDER BY distance_km
        LIMIT 200
    ", [
            $base->latitude,
            $base->longitude,
            $base->latitude,
            $base->latitude,
            $radiusKm,
            $base->latitude,
            $radiusKm,
            $base->longitude,
            $radiusKm,
            $base->latitude,
            $base->longitude,
            $radiusKm,
            $base->latitude,
            $basePincode,
            $radiusKm
        ]);

        return array_map(function ($row) {
            return [
                'pincode' => $row->pincode,
                'office_name' => $row->office_name,
                'district' => $row->district,
                'state' => $row->state,
                'distance_km' => round($row->distance_km, 2),
                'latitude' => $row->latitude,
                'longitude' => $row->longitude,
            ];
        }, $results);
    }

    /**
     * Find nearby pincodes within radius
     */
    public function getNearbyPincodes(string $basePincode, int $radiusKm = 300): array
    {
        // Get or create base pincode
        $base = $this->getOrCreatePincode($basePincode);

        if (!$base || !$base->latitude) {
            return [];
        }

        // Calculate bounding box for optimization
        $boundingBox = $this->calculateBoundingBox($base->latitude, $base->longitude, $radiusKm);

        // First, get pincodes within bounding box
        $candidates = Pincode::whereBetween('latitude', [$boundingBox['min_lat'], $boundingBox['max_lat']])
            ->whereBetween('longitude', [$boundingBox['min_lng'], $boundingBox['max_lng']])
            ->where('pincode', '!=', $basePincode)
            ->get();

        // Then calculate exact distance using Haversine formula
        $nearby = [];

        foreach ($candidates as $candidate) {
            $distance = $this->calculateHaversineDistance(
                $base->latitude,
                $base->longitude,
                $candidate->latitude,
                $candidate->longitude
            );

            if ($distance <= $radiusKm) {
                $nearby[] = [
                    'pincode' => $candidate->pincode,
                    'office_name' => $candidate->office_name,
                    'district' => $candidate->district,
                    'state' => $candidate->state,
                    'distance_km' => round($distance, 2),
                    'latitude' => $candidate->latitude,
                    'longitude' => $candidate->longitude,
                ];
            }
        }

        // Sort by distance
        usort($nearby, function ($a, $b) {
            return $a['distance_km'] <=> $b['distance_km'];
        });

        return $nearby;
    }

    /**
     * Get or create pincode record
     */
    public function getOrCreatePincode(string $pincode): ?Pincode
    {
        // Check if exists in database
        $existing = Pincode::where('pincode', $pincode)->first();

        if ($existing) {
            return $existing;
        }

        // Fetch from API and store
        $details = $this->getPincodeDetails($pincode);

        if ($details) {
            return Pincode::create($details);
        }

        return null;
    }

    /**
     * Calculate bounding box for optimization
     */
    // private function calculateBoundingBox(float $lat, float $lng, int $radiusKm): array
    // {
    //     $radiusDeg = $radiusKm / 111.0; // Approx degrees per km

    //     return [
    //         'min_lat' => $lat - $radiusDeg,
    //         'max_lat' => $lat + $radiusDeg,
    //         'min_lng' => $lng - $radiusDeg / cos(deg2rad($lat)),
    //         'max_lng' => $lng + $radiusDeg / cos(deg2rad($lat)),
    //     ];
    // }

    /**
     * Haversine distance calculation
     */
    // private function calculateHaversineDistance(float $lat1, float $lng1, float $lat2, float $lng2): float
    // {
    //     $earthRadius = 6371; // km

    //     $dLat = deg2rad($lat2 - $lat1);
    //     $dLng = deg2rad($lng2 - $lng1);

    //     $a = sin($dLat / 2) * sin($dLat / 2) +
    //         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
    //         sin($dLng / 2) * sin($dLng / 2);

    //     $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    //     return $earthRadius * $c;
    // }
    private function calculateBoundingBox(float $lat, float $lng, int $radiusKm): array
    {
        static $kmPerDegreeLat = 111.0;
        static $deg2rad = 0.017453292519943295;

        // One-time conversion and cosine
        $latRad = $lat * $deg2rad;
        $cosLat = cos($latRad);

        // Guard against near-pole locations
        if (abs($cosLat) < 0.01) {
            $cosLat = 0.01;
        }

        $degLat = $radiusKm / $kmPerDegreeLat;
        $degLng = $radiusKm / ($kmPerDegreeLat * $cosLat);

        return [
            'min_lat' => max(-90.0, $lat - $degLat),
            'max_lat' => min(90.0, $lat + $degLat),
            'min_lng' => $this->normalizeLng($lng - $degLng),
            'max_lng' => $this->normalizeLng($lng + $degLng),
        ];
    }

    private function normalizeLng(float $lng): float
    {
        // Fast normalization (no loops)
        $lng = fmod($lng, 360.0);
        if ($lng > 180.0) $lng -= 360.0;
        if ($lng < -180.0) $lng += 360.0;
        return $lng;
    }
    private function calculateHaversineDistance(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        static $earthRadius = 6371.0;
        static $deg2rad = 0.017453292519943295; // π/180

        // Fast conversion to radians
        $lat1Rad = $lat1 * $deg2rad;
        $lng1Rad = $lng1 * $deg2rad;
        $lat2Rad = $lat2 * $deg2rad;
        $lng2Rad = $lng2 * $deg2rad;

        $dLat = $lat2Rad - $lat1Rad;
        $dLng = $lng2Rad - $lng1Rad;

        // Calculate once
        $sinDLat2 = sin($dLat * 0.5);
        $sinDLng2 = sin($dLng * 0.5);

        // Haversine
        $a = $sinDLat2 * $sinDLat2 +
            cos($lat1Rad) * cos($lat2Rad) *
            $sinDLng2 * $sinDLng2;

        return $earthRadius * 2.0 * atan2(sqrt($a), sqrt(1.0 - $a));
    }

    /**
     * Bulk import pincodes for an area
     */
    public function importPincodesForDistrict(string $district, string $state): int
    {
        // This is a limitation - postalpincode.in doesn't have district search
        // You would need the Excel file for bulk import

        Log::warning("Bulk import requires CSV file. Using API for single lookups only.");
        return 0;
    }
}
