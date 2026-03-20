<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        
        return view('agent.dashboard', compact('agent'));
    }
}
