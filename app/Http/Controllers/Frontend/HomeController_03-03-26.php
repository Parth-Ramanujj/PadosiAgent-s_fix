<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        // Filter by Insurance Type (Segment)
        if ($request->filled('InsuranceType')) {
            $types = (array) $request->InsuranceType;
            
            // Map frontend readable names to DB enum values
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

        // Filter by City/State (from profile)
        if ($request->filled('location')) {
            $location = $request->location;
            $query->whereHas('profile', function($q) use ($location) {
                $q->where('city', 'like', "%{$location}%")
                  ->orWhere('state', 'like', "%{$location}%");
            });
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

        // Check if this is specifically a pagination request (infinite scroll/load more)
        if ($request->header('HX-Request') && $request->header('HX-Target') == 'load-more-wrapper') {
            // We return a wrapper to avoid inheriting the body's hx-select
            return view('partials.agents-list-chunk', compact('agents'));
        }

        return view('find-agents', compact('agents'));
    }
}
