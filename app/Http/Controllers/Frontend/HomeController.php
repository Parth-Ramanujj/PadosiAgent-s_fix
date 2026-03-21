<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function about()
    {
        return view('about');
    }

    public function faq()
    {
        return view('faq');
    }

    public function findAgents(Request $request)
    {
        $shouldGateGuest = auth()->guest() && !$request->session()->has('quick_lead_user');

        // Do not query agent listings for guests until they submit details.
        if ($shouldGateGuest) {
            $agents = new LengthAwarePaginator([], 0, 5, 1, [
                'path' => $request->url(),
                'query' => $request->query(),
            ]);

            return view('find-agents', compact('agents', 'shouldGateGuest'));
        }

        $query = \App\Models\Agent::query()->with([
            'profile',
            'insuranceSegments',
            'performanceStats',
            'activeSubscription',
            'reviews' => function($q) {
                $q->where('is_approved', true);
            }
        ])
        ->whereHas('user', function($q) {
            $q->where('role', 'agent');
        });

        // Mapping of frontend readable names to DB segment types
        $typeMapping = [
            'Health Insurance' => 'health',
            'Health' => 'health',
            'Life Insurance' => 'life',
            'Life' => 'life',
            'Motor Insurance' => 'motor',
            'Motor' => 'motor',
            'SME Insurance' => 'sme',
            'SME' => 'sme',
            'Travel Insurance' => 'travel',
            'Travel' => 'travel',
            'Fire Insurance' => 'fire',
            'Fire' => 'fire',
            'Marine Insurance' => 'marine',
            'Marine' => 'marine',
            'Liability Insurance' => 'liability',
            'Liability' => 'liability',
            'Other General Insurance' => 'other',
            'Transport' => 'transport',
            'Workmen Compensation' => 'workmen_compensation',
            'GPA / GMC' => 'gpa_gmc',
            'Group Term Insurance' => 'group_term',
            'Cyber' => 'cyber'
        ];

        // Filter by Insurance Type (Segment)
        if ($request->filled('InsuranceType')) {
            $types = (array) $request->InsuranceType;
            $dbTypes = array_map(function($type) use ($typeMapping) {
                return $typeMapping[$type] ?? strtolower(str_replace(' Insurance', '', $type));
            }, $types);

            $query->whereHas('insuranceSegments', function($q) use ($dbTypes) {
                $q->whereIn('segment_type', $dbTypes);
            });
        }

        // Filter by Service Type (Lead Preferences)
        if ($request->filled('ServiceType')) {
            $serviceType = $request->ServiceType;
            $query->whereHas('leadPreferences', function($q) use ($serviceType) {
                if ($serviceType === 'New Policy') {
                    $q->where('leads_new_business', 1);
                } elseif ($serviceType === 'Claim Assistance') {
                    $q->where('leads_claims_support', 1);
                } elseif ($serviceType === 'Policy Review') {
                    $q->where('leads_portfolio_analysis', 1);
                }
            });
        }

        // Filter by City/State/Pincode (from profile)
        if ($request->filled('location') || $request->filled('pincode')) {
            $location = $request->location;
            $pincode = $request->pincode;
            
            $query->whereHas('profile', function($q) use ($location, $pincode) {
                $q->where(function($sq) use ($location, $pincode) {
                    if ($location) {
                        $sq->where('city', 'like', "%{$location}%")
                           ->orWhere('state', 'like', "%{$location}%");
                    }
                    if ($pincode) {
                        // Check if pincode matches in the service_pincodes array
                        $sq->orWhereJsonContains('service_pincodes', $pincode);
                    }
                });
            });

            // Also check if the location/pincode matches in serviceable cities
            $query->orWhereHas('serviceableCities', function($q) use ($location) {
                if ($location) {
                    $q->where('name', 'like', "%{$location}%");
                }
            });
        }

        // Filter by Insurance Company / Sub Product
        if ($request->filled('InsuranceCompany')) {
            $val = $request->InsuranceCompany;
            $insuranceType = $request->InsuranceType;

            if ($request->ServiceType === 'New Policy') {
                // For New Policy, InsuranceCompany field contains the Sub Product
                $query->whereHas('productExpertise', function($q) use ($val, $insuranceType, $typeMapping) {
                    $q->where('product_name', $val);
                    if ($insuranceType) {
                        $types = (array) $insuranceType;
                        $dbTypes = array_map(function($type) use ($typeMapping) {
                            return $typeMapping[$type] ?? strtolower(str_replace(' Insurance', '', $type));
                        }, $types);
                        $q->whereIn('segment_type', $dbTypes);
                    }
                });
            } else {
                // For other services, it's the actual Insurance Company
                $query->whereHas('portfolios', function($q) use ($val, $insuranceType, $typeMapping) {
                    if ($insuranceType) {
                        $types = (array) $insuranceType;
                        $dbTypes = array_map(function($type) use ($typeMapping) {
                            return $typeMapping[$type] ?? strtolower(str_replace(' Insurance', '', $type));
                        }, $types);
                        $q->whereIn('segment_type', $dbTypes);
                    }

                    $q->where(function($sq) use ($val) {
                        // Use more robust JSON querying for MySQL
                        $sq->where('primary_companies->name', $val)
                           ->orWhere('secondary_companies->name', $val);
                    });
                });
            }
        }

        // Generic Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('profile', function($pq) use ($search) {
                      $pq->where('city', 'like', "%{$search}%")
                        ->orWhere('state', 'like', "%{$search}%");
                  });
            });
        }

        $agents = $query->orderBy('created_at', 'desc')->paginate(5);
        $agents->appends($request->all());

        // Return partial for HTMX requests (like filters) to avoid full page load
        // But for boosted requests (full page navigation), we should return the full view
        if ($request->header('HX-Request') && !$request->header('HX-Boosted')) {
            return view('partials.find-agents-list', compact('agents', 'shouldGateGuest'));
        }

        return view('find-agents', compact('agents', 'shouldGateGuest'));
    }
}
