<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Check if the 'payment_status' column still exists in the 'agents' table
        // We accept that it might be gone if the cleanup migration ran.
        $hasSourceColumn = Schema::hasColumn('agents', 'payment_status');
        
        $agents = DB::table('agents')->get();

        foreach ($agents as $agent) {
            // --- PART A: FIX DATA (If source exists) ---
            // If the agents table still has the original data, we FORCE update the subscription table
            // to match it. This fixes the issue where everything might have become 'pending'.
            if ($hasSourceColumn) {
                $status = $agent->payment_status ?? 'pending';
                
                DB::table('agent_subscriptions')
                    ->where('agent_id', $agent->id)
                    ->update([
                        'payment_status' => $status,
                        // Also try to recover plan info if available and likely correct
                        'selected_plan' => $agent->selected_plan ?? DB::raw('selected_plan'),
                        'registration_amount' => $agent->registration_amount ?? DB::raw('registration_amount'),
                        'razorpay_order_id' => $agent->razorpay_order_id ?? DB::raw('razorpay_order_id'),
                        'razorpay_payment_id' => $agent->razorpay_payment_id ?? DB::raw('razorpay_payment_id'),
                        'razorpay_signature' => $agent->razorpay_signature ?? DB::raw('razorpay_signature'),
                    ]);
            }

            // --- PART B: CREATE USERS (For Completed Payments) ---
            // We read the status FRESH from the subscription table (which we just potentially fixed)
            $sub = DB::table('agent_subscriptions')->where('agent_id', $agent->id)->first();
            $paymentStatus = $sub ? $sub->payment_status : 'pending';

            if ($paymentStatus === 'completed') {
                $user = DB::table('users')->where('email', $agent->email)->first();
                $userId = $user ? $user->id : null;

                if (!$user) {
                    try {
                        $userId = DB::table('users')->insertGetId([
                            'fullname' => $agent->fullname, // Matches 'fullname' column in users table
                            'email' => $agent->email,
                            'password' => Hash::make($agent->email), // Password same as email
                            'role' => 'agent',
                            'status' => 'active',
                            'email_verified_at' => now(), // Auto-verify paid agents
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    } catch (\Exception $e) {
                         // Email might exist but case sensitive issue or deleted user? 
                         // Just skip to be safe
                         Log::error("Could not create user for agent {$agent->id}: " . $e->getMessage());
                    }
                }

                // Link agent to user
                if ($userId) {
                    DB::table('agents')->where('id', $agent->id)->update(['user_id' => $userId]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
