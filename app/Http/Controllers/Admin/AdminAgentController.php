<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminAgentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $planFilter = $request->query('plan', 'All Plans');
        $statusFilter = $request->query('status', 'All Status');
        $cityFilter = $request->query('city', '');

        $query = DB::table('agents as a')
            ->leftJoin('agent_profiles as ap', 'a.id', '=', 'ap.agent_id')
            ->leftJoin('agent_subscriptions as s', 'a.id', '=', 's.agent_id')
            ->select(
                'a.id', 'a.fullname', 'a.email', 'a.mobile', 'a.status', 'a.created_at', 
                'ap.address', 'ap.display_name',
                's.selected_plan', 's.expires_at',
                DB::raw('(SELECT AVG(rating) FROM agent_reviews WHERE agent_id = a.id AND is_approved = 1) as avg_rating'),
                DB::raw('(SELECT COUNT(*) FROM agent_reviews WHERE agent_id = a.id AND is_approved = 1) as review_count'),
                DB::raw('0 as lead_count')
            );

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('a.fullname', 'LIKE', "%{$search}%")
                  ->orWhere('a.email', 'LIKE', "%{$search}%")
                  ->orWhere('ap.display_name', 'LIKE', "%{$search}%");
            });
        }

        if ($planFilter !== 'All Plans') {
            $query->where('s.selected_plan', $planFilter);
        }

        if ($statusFilter !== 'All Status') {
            $query->where('a.status', $statusFilter === 'Active' ? 'active' : 'inactive');
        }

        if (!empty($cityFilter)) {
            $query->where('ap.address', 'LIKE', "%{$cityFilter}%");
        }

        $agents = $query->orderByDesc('a.id')->get();

        return view('admin.agents', compact('agents', 'search', 'planFilter', 'statusFilter', 'cityFilter'));
    }

    public function toggleStatus(Request $request)
    {
        $agent = DB::table('agents')->where('id', $request->id)->first();
        if ($agent) {
            DB::table('agents')->where('id', $request->id)->update(['status' => $request->status]);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true]);
            }
            return redirect()->back()->with('success', 'Agent status updated successfully.');
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => false, 'message' => 'Agent not found']);
        }
        return redirect()->back()->with('error', 'Agent not found.');
    }

    public function getAgent($id)
    {
        $agent = DB::table('agents as a')
            ->leftJoin('agent_profiles as ap', 'a.id', '=', 'ap.agent_id')
            ->leftJoin('agent_subscriptions as s', 'a.id', '=', 's.agent_id')
            ->where('a.id', $id)
            ->select(
                'a.id', 'a.fullname', 'a.email', 'a.mobile as phone', 'a.status', 'ap.address as location',
                'ap.license_number as license', 'ap.experience_years as experience', 'a.admin_notes',
                's.selected_plan'
            )->first();

        if ($agent) {
            return response()->json(['success' => true, 'agent' => $agent]);
        }
        
        return response()->json(['success' => false]);
    }

    public function showManageAgent($id)
    {
        $agent = DB::table('agents as a')
            ->leftJoin('agent_profiles as ap', 'a.id', '=', 'ap.agent_id')
            ->leftJoin('agent_subscriptions as s', 'a.id', '=', 's.agent_id')
            ->where('a.id', $id)
            ->select(
                'a.id', 'a.fullname', 'a.email', 'a.mobile', 'a.status', 'a.created_at', 'a.experience_range',
                'ap.address', 'ap.license_number', 'ap.experience_years', 'ap.office_address', 'ap.pan_number', 'a.admin_notes',
                'ap.is_profile_visible', 'ap.show_certificates', 'ap.show_achievements', 'ap.show_reviews',
                's.selected_plan', 's.expires_at',
                DB::raw('(SELECT AVG(rating) FROM agent_reviews WHERE agent_id = a.id AND is_approved = 1) as avg_rating'),
                DB::raw('(SELECT COUNT(*) FROM agent_reviews WHERE agent_id = a.id AND is_approved = 1) as review_count'),
                DB::raw('(SELECT COUNT(*) FROM agent_reviews WHERE agent_id = a.id AND is_approved = 0) as pending_reviews')
            )->first();

        if (!$agent) {
            return redirect()->route('admin.agents')->with('error', 'Agent not found.');
        }

        $reviews = DB::table('agent_reviews as r')
            ->leftJoin('users as u', 'r.user_id', '=', 'u.id')
            ->where('r.agent_id', $id)
            ->select('r.id', 'u.fullname as client_name', 'r.rating', 'r.review as review_text', 'r.is_approved', 'r.created_at')
            ->orderByDesc('r.created_at')
            ->limit(10)
            ->get();

        return view('admin.manage_agent', compact('agent', 'reviews'));
    }

    public function updateVisibility(Request $request)
    {
        $field = $request->field;
        $value = $request->value ? 1 : 0;
        $agentId = $request->id;

        $validFields = ['is_profile_visible', 'show_certificates', 'show_achievements', 'show_reviews'];
        if (!in_array($field, $validFields)) {
            return response()->json(['success' => false, 'message' => 'Invalid field']);
        }

        DB::table('agent_profiles')
            ->where('agent_id', $agentId)
            ->update([$field => $value, 'updated_at' => now()]);

        return response()->json(['success' => true]);
    }

    public function updatePlan(Request $request)
    {
        $agentId = $request->id;
        $newPlan = $request->selected_plan;
        $columns = Schema::getColumnListing('agent_subscriptions');

        $payload = [
            'agent_id' => $agentId,
            'selected_plan' => $newPlan,
            'registration_amount' => 0,
            'status' => 'active',
            'payment_status' => 'completed',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Keep admin-only metadata only when present in this DB schema variant.
        if (in_array('transaction_id', $columns, true)) {
            $payload['transaction_id'] = 'ADMIN_MANUAL';
        }
        if (in_array('is_active', $columns, true)) {
            $payload['is_active'] = 1;
        }
        if (in_array('amount', $columns, true)) {
            $payload['amount'] = 0;
        }
        if (in_array('price', $columns, true)) {
            $payload['price'] = 0;
        }
        if (in_array('fee', $columns, true)) {
            $payload['fee'] = 0;
        }
        if (in_array('plan_amount', $columns, true)) {
            $payload['plan_amount'] = 0;
        }

        // Drop keys that do not exist in current schema to avoid SQL unknown column errors.
        $payload = array_filter(
            $payload,
            fn ($value, $key) => in_array($key, $columns, true),
            ARRAY_FILTER_USE_BOTH
        );

        $exists = DB::table('agent_subscriptions')->where('agent_id', $agentId)->exists();

        if ($exists) {
            DB::table('agent_subscriptions')
                ->where('agent_id', $agentId)
                ->update(array_filter([
                    'selected_plan' => $newPlan,
                    'updated_at' => in_array('updated_at', $columns, true) ? now() : null,
                ], fn ($value) => !is_null($value)));
        } else {
            DB::table('agent_subscriptions')->insert($payload);
        }

        return redirect()->back()->with('success', 'Subscription plan updated successfully.');
    }

    public function toggleReviewApproval(Request $request)
    {
        DB::table('agent_reviews')
            ->where('id', $request->review_id)
            ->update(['is_approved' => $request->is_approved]);

        return redirect()->back()->with('success', 'Review status updated.');
    }

    public function saveAgentNotes(Request $request)
    {
        $agentId = $request->input('id');
        $notes = $request->input('notes') ?? $request->input('admin_notes');

        $agent = DB::table('agents')->where('id', $agentId)->first();
        if ($agent) {
            DB::table('agents')->where('id', $agentId)->update(['admin_notes' => $notes]);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true]);
            }
            return redirect()->back()->with('success', 'Notes saved successfully.');
        }
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => false, 'message' => 'Agent not found']);
        }
        return redirect()->back()->with('error', 'Agent not found.');
    }
}
