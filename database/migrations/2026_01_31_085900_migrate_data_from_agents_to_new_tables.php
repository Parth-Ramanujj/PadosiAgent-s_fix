<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $agents = DB::table('agents')->get();

        foreach ($agents as $agent) {
            // Migrate Subscription Data
            // Check if subscription already exists to avoid duplicates
            $exists_sub = DB::table('agent_subscriptions')->where('agent_id', $agent->id)->exists();
            
            if (!$exists_sub) {
                // Safely handle selected_plan (could be JSON or string)
                $selectedPlan = $agent->selected_plan ?? null;
                if (is_string($selectedPlan) && (str_starts_with($selectedPlan, '{') || str_starts_with($selectedPlan, '['))) {
                     // Try to decode if it looks like JSON, but for now we just store as string if the target column is string.
                     // If target is string and source is JSON-string, we keep it as is or extract 'name'?
                     // Based on user context, we will likely just copy the value.
                }

                DB::table('agent_subscriptions')->insert([
                    'agent_id' => $agent->id,
                    'selected_plan' => is_array($selectedPlan) ? json_encode($selectedPlan) : ($selectedPlan ?? 'Basic'), // Default fallback
                    'registration_amount' => $agent->registration_amount ?? 0,
                    'razorpay_order_id' => $agent->razorpay_order_id ?? null,
                    'razorpay_payment_id' => $agent->razorpay_payment_id ?? null,
                    'razorpay_signature' => $agent->razorpay_signature ?? null,
                    'payment_status' => $agent->payment_status ?? 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Migrate Profile Data
            // Check if profile already exists
            $exists_profile = DB::table('agent_profiles')->where('agent_id', $agent->id)->exists();
            
            // Only create a profile if there is actual data to migrate
            $hasProfileData = !empty($agent->pan_number) || !empty($agent->license_number) || !empty($agent->software_name);

            if (!$exists_profile && $hasProfileData) {
                DB::table('agent_profiles')->insert([
                    'agent_id' => $agent->id,
                    'pan_number' => $agent->pan_number ?? null,
                    'license_number' => $agent->license_number ?? null,
                    'agency_name' => $agent->software_name ?? null, // Mapping software_name to agency_name based on context
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Create User Account if Payment is Completed
            if (($agent->payment_status ?? 'pending') === 'completed') {
                $user = DB::table('users')->where('email', $agent->email)->first();

                if (!$user) {
                    $userId = DB::table('users')->insertGetId([
                        'name' => $agent->fullname,
                        'email' => $agent->email,
                        'password' => Hash::make($agent->email), // Password is same as email
                        'role' => 'agent',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    
                    // Link the new User ID to the Agent record
                    DB::table('agents')->where('id', $agent->id)->update(['user_id' => $userId]);
                } else {
                     // If user exists, ensure they are linked
                    DB::table('agents')->where('id', $agent->id)->update(['user_id' => $user->id]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No specific reverse action as we don't want to delete data on rollback of this specific step
        // unless we built a complex restoration logic.
    }
};
