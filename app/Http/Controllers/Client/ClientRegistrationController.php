<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClientCredentialsMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClientRegistrationController extends Controller
{
    public function quickRegister(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'nullable|string|max:15',
            'pincode' => 'nullable|string|max:10',
        ]);

        $email = $request->email;

        // 1. Check if an active USER account already exists for this email with client role
        $existingUser = User::where('email', $email)->where('role', 'client')->first();
        if ($existingUser) {
            session([
                'quick_lead_user' => [
                    'fullname' => $request->fullname,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'pincode' => $request->pincode,
                ]
            ]);

            Auth::login($existingUser);

            return response()->json([
                'success' => true,
                'status' => 'success',
                'message' => 'Welcome back! Redirecting...',
                'redirect' => route('find.agents', ['pincode' => $request->pincode])
            ]);
        }

        // 2. Also check if email exists at all (could be an agent/admin)
        $anyUser = User::where('email', $email)->first();
        if ($anyUser) {
            return response()->json([
                'success' => false,
                'message' => 'This email is already registered. Please login to your account.'
            ], 422);
        }

        $pincode = $request->pincode ?? '000000'; // Default if not provided

        try {
            DB::beginTransaction();

            // 1. Create User
            $user = User::create([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'password' => Hash::make($request->email), // Password is same as email
                'role' => 'client',
                'status' => 'active',
                'email_verified_at' => now(),
            ]);

            // 2. Create Client Profile
            Client::create([
                'user_id' => $user->id,
                'mobile' => $request->mobile,
                'pincode' => $pincode,
            ]);

            DB::commit();

            // Send credentials email in best-effort mode so registration never fails on mail issues.
            try {
                Mail::to($user->email)->send(new ClientCredentialsMail($user->fullname, $user->email, $user->email));
            } catch (\Throwable $mailException) {
                Log::warning('Quick register mail send failed', [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'error' => $mailException->getMessage(),
                ]);
            }

            session([
                'quick_lead_user' => [
                    'fullname' => $request->fullname,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'pincode' => $request->pincode,
                ]
            ]);

            // 4. Auto-Login
            Auth::login($user);

            return response()->json([
                'success' => true,
                'status' => 'success',
                'message' => 'Registration successful! Redirecting...',
                'redirect' => route('find.agents', ['pincode' => $request->pincode])
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quick register failed', [
                'email' => $request->email,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'Unable to complete registration right now. Please try again.'
            ], 500);
        }
    }
}
