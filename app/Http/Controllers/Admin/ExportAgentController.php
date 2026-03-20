<?php
// app/Http\Controllers/ExportAgentController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Response; // Add this line


class ExportAgentController extends Controller
{

    public function export()
    {
        // Select only required columns, excluding unwanted ones
        $agents = Agent::select([
            'id',
            'fullname',
            'email',
            'mobile',
            'user_types',
            'pan_number',
            'license_number',
            'insurance_companies',
            'experience_range',
            'client_base',
            'portfolio_breakdown',
            'desired_services',
            'software_name',
            'razorpay_order_id',
            'razorpay_payment_id',
            'razorpay_signature',
            'payment_status',
            'selected_plan',
            'registration_amount',
            'created_at',
            'updated_at'
        ])->get();

        $filename = "agents_export_" . date('Y-m-d_H-i-s') . ".csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function () use ($agents) {
            $file = fopen('php://output', 'w');

            // Add UTF-8 BOM for Excel compatibility
            fwrite($file, "\xEF\xBB\xBF");

            // Add headers
            fputcsv($file, [
                'ID',
                'Full Name',
                'Email',
                'Mobile',
                'User Types',
                'PAN Number',
                'License Number',
                'Insurance Companies',
                'Experience Range',
                'Client Base',
                'Portfolio Breakdown',
                'Desired Services',
                'Software Name',
                'Razorpay Order ID',
                'Razorpay Payment ID',
                'Razorpay Signature',
                'Payment Status',
                'Selected Plan',
                'Registration Amount (₹)',
                'Created At',
                'Updated At'
            ]);

            // Add data rows
            foreach ($agents as $agent) {
                // Convert arrays to readable strings
                $userTypes = is_array($agent->user_types)
                    ? implode(' | ', $agent->user_types)
                    : $agent->user_types;

                $insuranceCompanies = is_array($agent->insurance_companies)
                    ? implode(' | ', $agent->insurance_companies)
                    : $agent->insurance_companies;

                $portfolioBreakdown = is_array($agent->portfolio_breakdown)
                    ? json_encode($agent->portfolio_breakdown, JSON_UNESCAPED_UNICODE)
                    : $agent->portfolio_breakdown;

                $desiredServices = is_array($agent->desired_services)
                    ? implode(' | ', $agent->desired_services)
                    : $agent->desired_services;

                $selectedPlan = is_array($agent->selected_plan)
                    ? json_encode($agent->selected_plan, JSON_UNESCAPED_UNICODE)
                    : $agent->selected_plan;

                fputcsv($file, [
                    $agent->id,
                    $agent->fullname ?? '',
                    $agent->email ?? '',
                    $agent->mobile ?? '',
                    $userTypes,
                    $agent->pan_number ?? '',
                    $agent->license_number ?? '',
                    $insuranceCompanies,
                    $agent->experience_range ?? '',
                    $agent->client_base ?? '',
                    $portfolioBreakdown,
                    $desiredServices,
                    $agent->software_name ?? '',
                    $agent->razorpay_order_id ?? '',
                    $agent->razorpay_payment_id ?? '',
                    $agent->razorpay_signature ?? '',
                    $agent->payment_status ?? '',
                    $selectedPlan,
                    $agent->registration_amount ?? '0.00',
                    $agent->created_at ?? '',
                    $agent->updated_at ?? ''
                ], ',', '"');
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
