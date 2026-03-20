<?php
// app/Http/Controllers/AgentController.php
namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Services\PincodeService;
use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    protected $pincodeService;

    public function __construct(PincodeService $pincodeService)
    {
        $this->pincodeService = $pincodeService;
    }

    /**
     * Main endpoint: Get nearby agents within radius
     */
    public function getNearbyAgents(Request $request)
    {
        $request->validate([
            'pincode' => 'required|digits:6',
            'radius_km' => 'nullable|integer|min:1|max:500',
            'limit' => 'nullable|integer|min:1|max:100'
        ]);

        $pincode = $request->input('pincode');
        $radius = $request->input('radius_km', 300);
        $limit = $request->input('limit', 50);

        // Step 1: Get base pincode details
        $basePincode = $this->pincodeService->getOrCreatePincode($pincode);

        if (!$basePincode) {
            return response()->json([
                'success' => false,
                'message' => 'Pincode not found'
            ], 404);
        }

        // Step 2: Get nearby pincodes within radius
        $nearbyPincodes = $this->pincodeService->getNearbyPincodes($pincode, $radius);

        // Step 3: Get agents for these pincodes
        $pincodeList = array_column($nearbyPincodes, 'pincode');
        $pincodeList[] = $pincode; // Include base pincode

        $agents = Agent::with(['pincodeRecord'])
            ->whereIn('pincode', $pincodeList)
            ->limit($limit)
            ->get()
            ->map(function ($agent) use ($nearbyPincodes, $basePincode) {
                // Find distance for this agent's pincode
                $distance = 0;

                if ($agent->pincode == $basePincode->pincode) {
                    $distance = 0;
                } else {
                    foreach ($nearbyPincodes as $nearby) {
                        if ($nearby['pincode'] == $agent->pincode) {
                            $distance = $nearby['distance_km'];
                            break;
                        }
                    }
                }

                return [
                    'id' => $agent->id,
                    'name' => $agent->name,
                    'phone' => $agent->phone,
                    'address' => $agent->address,
                    'pincode' => $agent->pincode,
                    'distance_km' => $distance,
                    'location' => $agent->pincodeRecord ?
                        $agent->pincodeRecord->office_name . ', ' .
                        $agent->pincodeRecord->district : 'Unknown',
                ];
            })
            ->sortBy('distance_km')
            ->values();

        return response()->json([
            'success' => true,
            'base_pincode' => $basePincode->pincode,
            'base_location' => "{$basePincode->office_name}, {$basePincode->district}, {$basePincode->state}",
            'search_radius_km' => $radius,
            'total_nearby_pincodes' => count($nearbyPincodes),
            'total_agents_found' => $agents->count(),
            'agents' => $agents,
            'nearby_pincodes_sample' => array_slice($nearbyPincodes, 0, 10) // First 10 for reference
        ]);
    }

    /**
     * Pre-populate common pincodes in your area
     */
    public function preloadCommonPincodes()
    {
        // Common pincodes for Ahmedabad area
        $ahmedabadPincodes = [
            '382424', // Chandkheda
            '380015',
            '380001',
            '380009',
            '382481', // Sabarmati
            '380013',
            '380016',
            '380019',
            '380006',
            '380007',
            '380014'
        ];

        $results = [];
        foreach ($ahmedabadPincodes as $pincode) {
            $details = $this->pincodeService->getOrCreatePincode($pincode);
            $results[$pincode] = $details ? 'Loaded' : 'Failed';
        }

        return response()->json([
            'message' => 'Preload completed',
            'results' => $results
        ]);
    }
}
