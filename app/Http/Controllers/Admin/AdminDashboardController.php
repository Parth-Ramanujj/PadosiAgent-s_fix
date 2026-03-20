<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $periodMonths = in_array((int)$request->query('period'), [3, 6, 12]) ? (int)$request->query('period') : 12;

        try {
            $totalAgents = DB::table('agents')->count();

            $activeCount = DB::table('agents')->where('status', 'active')->count();
            $activePercent = $totalAgents > 0 ? round(($activeCount / $totalAgents) * 100) : 0;

            $newThisMonth = DB::table('agents')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)->count();

            $lastMonthCount = DB::table('agents')
                ->whereMonth('created_at', now()->subMonth()->month)
                ->whereYear('created_at', now()->year)->count();

            $growthPercent = $lastMonthCount > 0 ? round((($newThisMonth - $lastMonthCount) / $lastMonthCount) * 100) : 0;

            $distributors = DB::table('agents')
                ->where('user_types', 'LIKE', '%distributor%')
                ->orWhere('profession', 'LIKE', '%distributor%')
                ->count();

            $retentionRate = $activePercent;

            $rawPlans = DB::table('agent_subscriptions')
                ->select('selected_plan', DB::raw('count(*) as c'))
                ->groupBy('selected_plan')
                ->pluck('c', 'selected_plan')
                ->toArray();

            $planBreakdown = [];
            foreach ($rawPlans as $planKey => $count) {
                $planKey = trim($planKey);
                $name = $planKey;
                if (strpos($planKey, '{') !== false) {
                    $decoded = json_decode($planKey, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $name = $decoded['name'] ?? ($decoded['type'] ?? 'Other');
                    }
                }
                $planBreakdown[$name] = ($planBreakdown[$name] ?? 0) + $count;
            }

            $totalSubs = array_sum($planBreakdown);
            $profCount = $planBreakdown["Professional's Plan"] ?? ($planBreakdown["Professional Plan"] ?? 0);
            $starterCount = $planBreakdown["Starter's Plan"] ?? ($planBreakdown["Starter Plan"] ?? 0);
            $upgradeRate = $totalSubs > 0 ? round(($profCount / $totalSubs) * 100) : 0;

            $pageViews = DB::table('sessions')->count();
            $totalLeads = DB::table('participants')->count();

            // MoM Data
            $momData = DB::select("
                SELECT DATE_FORMAT(created_at, '%b %y') as label, COUNT(*) as total 
                FROM agents 
                WHERE created_at >= DATE_SUB(LAST_DAY(NOW()), INTERVAL ? MONTH)
                GROUP BY label, YEAR(created_at), MONTH(created_at)
                ORDER BY YEAR(created_at) ASC, MONTH(created_at) ASC
            ", [$periodMonths]);

            // Top Cities Data
            $cityData = DB::select("
                SELECT COALESCE(ap.address, 'Other') as label, COUNT(*) as total 
                FROM agents a
                LEFT JOIN agent_profiles ap ON a.id = ap.agent_id
                GROUP BY label 
                ORDER BY total DESC 
                LIMIT 8
            ");

            // Renewals
            $renewalStats = collect(DB::select("SELECT 
                        SUM(CASE WHEN expires_at < NOW() THEN 1 ELSE 0 END) as expired,
                        SUM(CASE WHEN expires_at BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 30 DAY) THEN 1 ELSE 0 END) as next_30,
                        SUM(CASE WHEN expires_at BETWEEN DATE_ADD(NOW(), INTERVAL 31 DAY) AND DATE_ADD(NOW(), INTERVAL 60 DAY) THEN 1 ELSE 0 END) as next_60,
                        SUM(CASE WHEN expires_at BETWEEN DATE_ADD(NOW(), INTERVAL 61 DAY) AND DATE_ADD(NOW(), INTERVAL 90 DAY) THEN 1 ELSE 0 END) as next_90
                     FROM agent_subscriptions"))->first();

            // Cast properties for template compliance
            $renewalStats = (array)$renewalStats;

        }
        catch (\Exception $e) {
            Log::error("Dashboard Data Fetch Error: " . $e->getMessage());
            // Default Values in case of error
            $totalAgents = 0;
            $activeCount = 0;
            $activePercent = 0;
            $newThisMonth = 0;
            $growthPercent = 0;
            $distributors = 0;
            $retentionRate = 0;
            $planBreakdown = [];
            $totalSubs = 0;
            $profCount = 0;
            $starterCount = 0;
            $upgradeRate = 0;
            $pageViews = 0;
            $totalLeads = 0;
            $momData = [];
            $cityData = [];
            $renewalStats = ['expired' => 0, 'next_30' => 0, 'next_60' => 0, 'next_90' => 0];
        }

        return view('admin.dashboard', compact(
            'periodMonths', 'totalAgents', 'activeCount', 'activePercent',
            'newThisMonth', 'growthPercent', 'distributors', 'retentionRate',
            'upgradeRate', 'pageViews', 'totalLeads', 'planBreakdown',
            'starterCount', 'profCount', 'totalSubs',
            'momData', 'cityData', 'renewalStats'
        ));
    }
}
