<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AgentLead;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AgentLeadController extends Controller
{
    public function capture(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'agent_id' => 'required|exists:agents,id',
            'interaction_type' => 'required|in:call,whatsapp',
            'service_type' => 'nullable|string|max:100',
            'insurance_type' => 'nullable|string|max:100',
            'insurance_company' => 'nullable|string|max:150',
            'source_page' => 'nullable|string|max:150',
        ]);

        $leadUser = session('quick_lead_user', []);

        $customerName = $leadUser['fullname'] ?? null;
        $customerEmail = $leadUser['email'] ?? null;
        $customerMobile = $leadUser['mobile'] ?? null;
        $customerPincode = $leadUser['pincode'] ?? null;

        // Fallback to logged-in client details if quick-registration data is unavailable.
        if ((!$customerName || !$customerEmail) && auth()->check()) {
            /** @var User $user */
            $user = auth()->user();
            $customerName = $customerName ?: $user->fullname;
            $customerEmail = $customerEmail ?: $user->email;
            $customerMobile = $customerMobile ?: optional($user->client)->mobile;
            $customerPincode = $customerPincode ?: optional($user->client)->pincode;
        }

        $enquiryParts = array_filter([
            $validated['service_type'] ?? null,
            $validated['insurance_type'] ?? null,
            $validated['insurance_company'] ?? null,
        ]);

        AgentLead::create([
            'agent_id' => $validated['agent_id'],
            'customer_name' => $customerName,
            'customer_email' => $customerEmail,
            'customer_mobile' => $customerMobile,
            'customer_pincode' => $customerPincode,
            'interaction_type' => $validated['interaction_type'],
            'lead_status' => 'new',
            'service_type' => $validated['service_type'] ?? null,
            'insurance_type' => $validated['insurance_type'] ?? null,
            'insurance_company' => $validated['insurance_company'] ?? null,
            'enquiry_requirements' => !empty($enquiryParts) ? implode(' | ', $enquiryParts) : null,
            'source_page' => $validated['source_page'] ?? 'find-agents',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Lead captured successfully.',
        ]);
    }
}
