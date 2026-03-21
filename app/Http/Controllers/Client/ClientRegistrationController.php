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

class ClientRegistrationController extends Controller
{
    public function quickRegister(Request $request)
    {
        $email = $request->email;

        // 1. Check if an active USER account already exists for this email with client role
        $existingUser = User::where('email', $email)->where('role', 'client')->first();
        if ($existingUser) {
            return response()->json([
                'success' => false,
                'message' => 'This email is already associated with an active Client account. Please login to continue.'
            ], 422);
        }

        // 2. Also check if email exists at all (could be an agent/admin)
        $anyUser = User::where('email', $email)->first();
        if ($anyUser) {
            return response()->json([
                'success' => false,
                'message' => 'This email is already registered. Please login to your account.'
            ], 422);
        }

        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'nullable|string|max:15',
            'pincode' => 'nullable|string|max:10',
        ]);

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

            // 3. Send Email
            Mail::to($user->email)->send(new ClientCredentialsMail($user->fullname, $user->email, $user->email));

            DB::commit();

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
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'Failed to register: ' . $e->getMessage()
            ], 500);
        }
    }
}
