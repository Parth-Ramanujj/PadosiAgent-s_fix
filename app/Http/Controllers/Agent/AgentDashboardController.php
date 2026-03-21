<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\AgentLead;
use App\Models\AgentProfileView;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $agent = auth()->user()->agent;
        
        if (!$agent) {
             // If for some reason the agent record is missing but they have the role
             return redirect()->route('agent.registration')->with('error', 'Please complete your registration.');
        }

        $agent->load([
            'profile',
            'activeSubscription',
            'serviceableCities',
            'insuranceSegments'
        ]);

        $startOfMonth = Carbon::now()->startOfMonth();

        $leadBaseQuery = AgentLead::where('agent_id', $agent->id);
        $totalLeads = (clone $leadBaseQuery)->count();
        $monthlyLeads = (clone $leadBaseQuery)->where('created_at', '>=', $startOfMonth)->count();

        $newLeads = (clone $leadBaseQuery)->where('lead_status', 'new')->count();
        $contactedLeads = (clone $leadBaseQuery)->where('lead_status', 'contacted')->count();
        $followUpLeads = (clone $leadBaseQuery)->where('lead_status', 'follow_up')->count();
        $closedLeads = (clone $leadBaseQuery)->where('lead_status', 'closed')->count();

        $activeLeads = $newLeads + $contactedLeads + $followUpLeads;
        $conversionRate = $totalLeads > 0 ? round(($closedLeads / $totalLeads) * 100, 1) : 0;

        try {
            $totalPageViews = AgentProfileView::where('agent_id', $agent->id)->sum('view_count');
            $monthlyVisits = AgentProfileView::where('agent_id', $agent->id)
                ->where('view_date', '>=', $startOfMonth->toDateString())
                ->sum('view_count');
        } catch (\Throwable $e) {
            Log::warning('Dashboard profile view stats unavailable', [
                'agent_id' => $agent->id,
                'error' => $e->getMessage(),
            ]);
            $totalPageViews = 0;
            $monthlyVisits = 0;
        }

        $recentLeads = AgentLead::where('agent_id', $agent->id)
            ->latest()
            ->take(10)
            ->get();

        $dashboardStats = [
            'conversionRate' => $conversionRate,
            'monthlyTarget' => 0,
            'totalPageViews' => $totalPageViews,
            'contactRequests' => $totalLeads,
            'monthlyVisits' => $monthlyVisits,
            'totalLeads' => $totalLeads,
            'monthlyLeads' => $monthlyLeads,
            'newLeads' => $newLeads,
            'contactedLeads' => $contactedLeads,
            'followUpLeads' => $followUpLeads,
            'closedLeads' => $closedLeads,
            'activeLeads' => $activeLeads,
        ];
        
        return view('agent.dashboard', compact('agent', 'dashboardStats', 'recentLeads'));
    }
}
