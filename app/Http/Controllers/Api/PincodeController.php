<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PincodeService;
use App\Models\Pincode;
use Illuminate\Support\Facades\Validator;

class PincodeController extends Controller
{
    protected $pincodeService;

    public function __construct()
    {
        $this->pincodeService = new PincodeService();
    }

    /**
     * Fetch single pincode from API and store/update in database
     * URL: GET /api/pincode/fetch/382424
     */
    public function fetchAndStore($pincode)
    {
        // Validate pincode format
        $validator = Validator::make(['pincode' => $pincode], [
            'pincode' => 'required|digits:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid pincode format',
                'errors' => $validator->errors()
            ], 400);
        }

        // Check if already exists
        $existing = Pincode::where('pincode', $pincode)->first();

        if ($existing) {
            // Update existing record with fresh API data
            $details = $this->pincodeService->getPincodeDetails($pincode);

            if ($details) {
                $existing->update([
                    'office_name' => $details['office_name'] ?? $existing->office_name,
                    'district' => $details['district'] ?? $existing->district,
                    'state' => $details['state'] ?? $existing->state,
                    'division' => $details['division'] ?? $existing->division,
                    'region' => $details['region'] ?? $existing->region,
                    'circle' => $details['circle'] ?? $existing->circle,
                    'taluk' => $details['taluk'] ?? $existing->taluk,
                    'latitude' => $details['latitude'] ?? $existing->latitude,
                    'longitude' => $details['longitude'] ?? $existing->longitude,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Pincode updated successfully',
                    'action' => 'updated',
                    'pincode' => $pincode,
                    'data' => $existing
                ]);
            }
        }

        // Create new pincode
        $pincodeModel = $this->pincodeService->getOrCreatePincode($pincode);

        if ($pincodeModel) {
            return response()->json([
                'success' => true,
                'message' => 'Pincode created successfully',
                'action' => 'created',
                'pincode' => $pincode,
                'data' => $pincodeModel
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to fetch pincode data from API'
        ], 500);
    }

    /**
     * Bulk fetch multiple pincodes
     * URL: POST /api/pincode/bulk-fetch
     * Body: {"pincodes": ["382424", "382481", "380001"]}
     */
    public function bulkFetchAndStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pincodes' => 'required|array|min:1|max:100',
            'pincodes.*' => 'digits:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $pincodes = $request->input('pincodes');
        $results = [
            'created' => 0,
            'updated' => 0,
            'failed' => 0,
            'details' => []
        ];

        foreach ($pincodes as $pincode) {
            $existing = Pincode::where('pincode', $pincode)->first();
            $details = $this->pincodeService->getPincodeDetails($pincode);

            if ($details) {
                if ($existing) {
                    // Update existing
                    $existing->update([
                        'office_name' => $details['office_name'] ?? $existing->office_name,
                        'district' => $details['district'] ?? $existing->district,
                        'state' => $details['state'] ?? $existing->state,
                        'latitude' => $details['latitude'] ?? $existing->latitude,
                        'longitude' => $details['longitude'] ?? $existing->longitude,
                    ]);
                    $results['updated']++;
                    $action = 'updated';
                } else {
                    // Create new
                    Pincode::create([
                        'pincode' => $pincode,
                        'office_name' => $details['office_name'] ?? 'Unknown',
                        'district' => $details['district'] ?? 'Unknown',
                        'state' => $details['state'] ?? 'Unknown',
                        'latitude' => $details['latitude'] ?? null,
                        'longitude' => $details['longitude'] ?? null,
                        'division' => $details['division'] ?? null,
                        'region' => $details['region'] ?? null,
                        'circle' => $details['circle'] ?? null,
                        'taluk' => $details['taluk'] ?? null,
                    ]);
                    $results['created']++;
                    $action = 'created';
                }

                $results['details'][$pincode] = [
                    'status' => 'success',
                    'action' => $action,
                    'location' => $details['office_name'] ?? 'N/A'
                ];
            } else {
                $results['failed']++;
                $results['details'][$pincode] = [
                    'status' => 'failed',
                    'message' => 'API returned no data'
                ];
            }

            // Delay to avoid API rate limiting
            usleep(200000); // 0.2 seconds
        }

        return response()->json([
            'success' => true,
            'message' => 'Bulk operation completed',
            'summary' => $results
        ]);
    }

    /**
     * Update coordinates for existing pincodes (geocoding)
     * URL: POST /api/pincode/update-coordinates
     * Body: {"pincode": "382424"} or {"all": true}
     */
    public function updateCoordinates(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pincode' => 'nullable|digits:6',
            'all' => 'nullable|boolean',
            'limit' => 'nullable|integer|min:1|max:1000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        if ($request->has('pincode')) {
            // Update single pincode
            $pincode = $request->input('pincode');
            $record = Pincode::where('pincode', $pincode)->first();

            if (!$record) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pincode not found in database'
                ], 404);
            }

            // Get fresh coordinates
            $details = $this->pincodeService->getPincodeDetails($pincode);

            if ($details && isset($details['latitude']) && isset($details['longitude'])) {
                $record->update([
                    'latitude' => $details['latitude'],
                    'longitude' => $details['longitude']
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Coordinates updated',
                    'pincode' => $pincode,
                    'coordinates' => [
                        'latitude' => $details['latitude'],
                        'longitude' => $details['longitude']
                    ]
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Could not fetch coordinates'
            ], 500);
        } elseif ($request->input('all', false)) {
            // Update all pincodes missing coordinates
            $limit = $request->input('limit', 100);
            $pincodes = Pincode::whereNull('latitude')
                ->orWhereNull('longitude')
                ->limit($limit)
                ->get();

            $updated = 0;
            $failed = 0;

            foreach ($pincodes as $pincode) {
                $details = $this->pincodeService->getPincodeDetails($pincode->pincode);

                if ($details && isset($details['latitude']) && isset($details['longitude'])) {
                    $pincode->update([
                        'latitude' => $details['latitude'],
                        'longitude' => $details['longitude']
                    ]);
                    $updated++;
                } else {
                    $failed++;
                }

                usleep(300000); // 0.3 seconds delay
            }

            return response()->json([
                'success' => true,
                'message' => 'Batch coordinate update completed',
                'updated' => $updated,
                'failed' => $failed,
                'total_processed' => $pincodes->count()
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Please specify pincode or set all=true'
        ], 400);
    }

    /**
     * Test endpoint (replaces your inline function)
     * URL: GET /api/test/382424
     */
    public function testPincode($pincode)
    {
        $details = $this->pincodeService->getPincodeDetails($pincode);
        $nearby = $this->pincodeService->getNearbyPincodes($pincode, 250);
        //$nearby = $this->pincodeService->getNearbyPincodesOptimized($pincode, 20);


        return response()->json([
            'pincode_details' => $details,
            'nearby_100km' => $nearby
        ]);
    }

    /**
     * Search pincodes by location name
     * URL: GET /api/pincode/search?q=chandkheda
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return response()->json([
                'success' => false,
                'message' => 'Search query required'
            ], 400);
        }

        $results = Pincode::where('office_name', 'LIKE', "%{$query}%")
            ->orWhere('district', 'LIKE', "%{$query}%")
            ->orWhere('pincode', 'LIKE', "%{$query}%")
            ->limit(20)
            ->get();

        return response()->json([
            'success' => true,
            'query' => $query,
            'count' => $results->count(),
            'results' => $results
        ]);
    }
}
