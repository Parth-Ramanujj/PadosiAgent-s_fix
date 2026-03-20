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
            'activeSubscription'
        ])
        ->whereHas('user', function($q) {
            $q->where('role', 'agent');
        });

        // Filter by Insurance Type (Segment)
        if ($request->filled('InsuranceType')) {
            $types = (array) $request->InsuranceType;
            $query->whereHas('insuranceSegments', function($q) use ($types) {
                $q->whereIn('name', $types);
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
