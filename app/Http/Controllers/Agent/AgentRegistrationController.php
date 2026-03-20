<?php
// app/Http\Controllers/AgentRegistrationController.php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\AgentSubscription;
use App\Models\AgentProfile;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use App\Mail\PaymentSuccessMail;

class AgentRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        // ----------------------------------------------------------------------
        // SESSION MANAGEMENT:
        // Only keep the form filled if the user is coming from:
        // 1. The plan selection page (clicked "Back")
        // 2. The registration page itself (refresh/validation error)
        // 3. The data processing route (validation redirect)
        // Otherwise (e.g., coming from Home, About Us), clear the session for a fresh start.
        // ----------------------------------------------------------------------
        $previousUrl = url()->previous();
        $allowedSegments = ['agent-registration', 'agent-register-step1', 'chooseplan'];
        $shouldKeepSession = false;

        foreach ($allowedSegments as $segment) {
            if (Str::contains($previousUrl, $segment)) {
                $shouldKeepSession = true;
                break;
            }
        }

        if (!$shouldKeepSession) {
            session()->forget(['current_agent_id', 'google_user', 'applied_promo_code']);
        }

        $agent = null;
        if (session()->has('current_agent_id')) {
            $agent = Agent::find(session('current_agent_id'));
        }

        $isVerified = false;
        $verifiedEmail = session('verified_email');
        if (session('email_verified') && $verifiedEmail) {
            $isVerified = true;
        } elseif ($agent && $agent->email_verified_at) {
            $isVerified = true;
            $verifiedEmail = $agent->email;
        }
        
        return response()
            ->view('agent-registration', compact('agent', 'isVerified', 'verifiedEmail'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    }

    /**
     * Show the plans page (Restrict direct access)
     */
    public function showPlans()
    {
        $agentId = session('current_agent_id');
        
        if (!$agentId) {
            return redirect()->route('agent.registration')->with('error', 'Please start the registration process first.');
        }

        $agent = Agent::find($agentId);

        if (!$agent) {
            session()->forget('current_agent_id');
            return redirect()->route('agent.registration')->with('error', 'Registration record not found.');
        }

        // Must have verified email to see plans
        if (!$agent->email_verified_at) {
            return redirect()->route('agent.registration')->with('error', 'Please verify your email address before choosing a plan.');
        }

        return view('plans');
    }

    /**
     * Send OTP for email verification
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;

        // Check if an active USER account already exists for this email with agent role
        $existingUser = User::where('email', $email)->where('role', 'agent')->first();
        if ($existingUser) {
            return response()->json([
                'success' => false,
                'message' => 'This email is already associated with an active Agent account. Please login to access your dashboard.'
            ], 422);
        }

        $otp = rand(100000, 999999);

        // Store OTP in session with timestamp
        session([
            'email_otp' => $otp,
            'otp_email' => $email,
            'otp_expires_at' => now()->addMinutes(10)
        ]);

        try {
            Mail::to($email)->send(new OtpMail($otp));
            Log::info("OTP sent to $email: $otp");
            
            return response()->json([
                'success' => true,
                'message' => 'OTP has been sent to your email address. Please check your inbox.'
            ]);
        } catch (\Exception $e) {
            Log::error('OTP Send Error: ' . $e->getMessage());
            Log::info("OTP for $email (Email failed): $otp");
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP email. Please try again or contact support.'
            ], 500);
        }
    }

    /**
     * Verify OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
            'email' => 'required|email'
        ]);

        $sessionOtp = session('email_otp');
        $otpEmail = session('otp_email');
        $expiresAt = session('otp_expires_at');

        if (!$sessionOtp || !$expiresAt || now()->gt($expiresAt)) {
            return response()->json([
                'success' => false,
                'message' => 'OTP expired or not found. Please request a new one.'
            ], 400);
        }

        if ($request->email !== $otpEmail) {
            return response()->json([
                'success' => false,
                'message' => 'Email mismatch. Please request OTP again.'
            ], 400);
        }

        if ($request->otp == $sessionOtp) {
            // Mark as verified in session
            session(['email_verified' => true, 'verified_email' => $request->email]);
            
            // Clear OTP from session after successful verification
            session()->forget(['email_otp', 'otp_expires_at']);

            // Update agent record if they are already in the registration flow
            $agent = Agent::where('email', $request->email)->first();
            if ($agent) {
                $agent->update(['email_verified_at' => now()]);
                // If they are resuming, also ensure this is their current agent session
                session(['current_agent_id' => $agent->id]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Email verified successfully!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid OTP. Please try again.'
        ], 400);
    }

    /**
     * Redirect to Google for authentication
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Store in session
            session([
                'google_user' => [
                    'email' => $googleUser->getEmail(),
                    'fullname' => $googleUser->getName(),
                    'google_id' => $googleUser->getId()
                ]
            ]);

            // Return HTML that auto-closes the popup
            return "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Authentication Complete</title>
            <style>
                body {
                    margin: 0;
                    padding: 40px;
                    font-family: Arial, sans-serif;
                    text-align: center;
                    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                    color: white;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }
                .success-icon {
                    font-size: 48px;
                    margin-bottom: 20px;
                }
                .message {
                    margin-bottom: 30px;
                }
                .close-btn {
                    background: white;
                    color: #059669;
                    border: none;
                    padding: 10px 20px;
                    border-radius: 5px;
                    cursor: pointer;
                    font-weight: bold;
                }
            </style>
        </head>
        <body>
            <div class='success-icon'>✅</div>
            <div class='message'>
                <h2>Authentication Successful!</h2>
                <p>Your information has been filled in the form.</p>
                <p>Closing this window...</p>
            </div>
            <button class='close-btn' onclick='window.close()'>Close Window</button>

            <script>
                // Auto-close after 2 seconds
                setTimeout(() => {
                    window.close();
                }, 2000);
                
                // Close on any click
                document.addEventListener('click', function() {
                    window.close();
                });
                
                // Close on escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        window.close();
                    }
                });
            </script>
        </body>
        </html>";
        } catch (\Exception $e) {
            Log::error('Google auth error: ' . $e->getMessage());
            return "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Authentication Failed</title>
            <style>
                body {
                    margin: 0;
                    padding: 40px;
                    font-family: Arial, sans-serif;
                    text-align: center;
                    background: #ef4444;
                    color: white;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }
            </style>
        </head>
        <body>
            <div style='font-size:48px;margin-bottom:20px;'>❌</div>
            <h2>Authentication Failed!</h2>
            <p>Please try again.</p>
            <button onclick='window.close()' style='padding:10px 20px;background:white;color:#ef4444;border:none;border-radius:5px;cursor:pointer;'>Close</button>
        </body>
        </html>";
        }
    }

    public function getGoogleSessionData()
    {
        $googleUser = session('google_user');

        if ($googleUser) {
            // Clear session after retrieving data
            session()->forget('google_user');

            return response()->json([
                'success' => true,
                'user' => $googleUser
            ]);
        }

        return response()->json(['success' => false]);
    }
    // public function handleGoogleCallback(Request $request)
    // {
    //     try {
    //         $googleUser = Socialite::driver('google')->user();

    //         Log::info('Google callback received:', [
    //             'email' => $googleUser->getEmail(),
    //             'name' => $googleUser->getName()
    //         ]);

    //         // Return JSON response for popup
    //         return response()->json([
    //             'success' => true,
    //             'user' => [
    //                 'email' => $googleUser->getEmail(),
    //                 'fullname' => $googleUser->getName(),
    //                 'google_id' => $googleUser->getId()
    //             ]
    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error('Google callback error: ' . $e->getMessage());

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Google authentication failed. Please try again.'
    //         ], 500);
    //     }
    // }

    /**
     * Get Google user data for pre-filling form
     */
    public function getGoogleUserData()
    {
        try {
            $googleUser = session('google_user');

            if ($googleUser) {
                return response()->json([
                    'success' => true,
                    'user' => [
                        'email' => $googleUser['email'],
                        'fullname' => $googleUser['fullname']
                    ]
                ]);
            }

            return response()->json(['success' => false]);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 500);
        }
    }

    /**
     * Clear Google session data
     */
    public function clearGoogleSession()
    {
        session()->forget('google_user');
        return response()->json(['success' => true]);
    }

    public function registerStep1(Request $request)
    {
        Log::info('STEP 1 - Received combined data:', $request->all());

        try {
            // Combined Validation
            $request->validate([
                'fullname' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'mobile' => 'required|string|max:15',
                'user_types' => 'required|array|min:1',
                'insurance_companies' => 'required|string', // JSON string from hidden input
                'experience_range' => 'required|string|max:50',
                'client_base' => 'required|string|max:50',
            ]);

            $insuranceCompanies = json_decode($request->insurance_companies, true);
            if (!is_array($insuranceCompanies) || empty($insuranceCompanies)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please select at least one insurance company.'
                ], 422);
            }

            // Define valid insurance companies (same as old version)
            $validInsuranceCompanies = [
                'Life Insurance Corporation of India',
                'Axis Max Life Insurance Limited',
                'HDFC Life Insurance Company Limited',
                'ICICI Prudential Life Insurance Company Limited',
                'Kotak Mahindra Life Insurance Company Limited',
                'Aditya Birla SunLife Insurance Company Limited',
                'TATA AIA Life Insurance Company Limited',
                'SBI Life Insurance Company Limited',
                'Bajaj Life Insurance Limited',
                'PNB MetLife India Insurance Company Limited',
                'Reliance Nippon Life Insurance Company Limited',
                'Aviva Life Insurance Company India Limited',
                'Sahara India Life Insurance Company Limited',
                'Shriram Life Insurance Company Limited',
                'Bharti AXA Life Insurance Company Limited',
                'Generali Central Life Insurance Company Limited',
                'Ageas Federal Life Insurance Company Limited',
                'Canara HSBC Life Insurance Company Limited',
                'Bandhan Life Insurance Limited',
                'Pramerica Life Insurance Company Limited',
                'Star Union Dai-Ichi Life Insurance Company Limited',
                'IndiaFirst Life Insurance Company Limited',
                'Edelweiss Life Insurance Company Limited',
                'CreditAccess Life Insurance Limited',
                'Acko Life Insurance Limited',
                'Go Digit Life Insurance Limited',
                'Acko General Insurance Limited',
                'Agriculture Insurance Company of India Limited',
                'Bajaj General Insurance Limited',
                'Cholamandalam MS General Insurance Company Limited',
                'ECGC Limited',
                'Generali Central Insurance Company Limited',
                'Go Digit General Insurance Limited',
                'HDFC ERGO General Insurance Company Limited',
                'ICICI LOMBARD General Insurance Company Limited',
                'IFFCO TOKIO General Insurance Company Limited',
                'Zurich Kotak General Insurance Company Limited',
                'Kshema General Insurance Limited',
                'Liberty General Insurance Limited',
                'Magma General Insurance Limited',
                'National Insurance Company Limited',
                'Navi General Insurance Limited',
                'Raheja QBE General Insurance Co. Ltd.',
                'Reliance General Insurance Company Limited',
                'Royal Sundaram General Insurance Company Limited',
                'SBI General Insurance Company Limited',
                'Shriram General Insurance Company Limited',
                'Tata AIG General Insurance Company Limited',
                'The New India Assurance Company Limited',
                'The Oriental Insurance Company Limited',
                'United India Insurance Company Limited',
                'Universal Sompo General Insurance Company Limited',
                'Zuna General Insurance Ltd.',
                'Aditya Birla Health Insurance Co. Limited',
                'Care Health Insurance Ltd.',
                'Galaxy Health and Allied Insurance Company Limited',
                'ManipalCigna Health Insurance Company Limited',
                'Niva Bupa Health Insurance Company Limited',
                'Reliance Health Insurance Ltd.',
                'Star Health & Allied Insurance Co. Ltd.',
                'Narayana Health Insurance Company Limited'
            ];

            $invalidCompanies = array_diff($insuranceCompanies, $validInsuranceCompanies);
            if (!empty($invalidCompanies)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid insurance companies selected: ' . implode(', ', $invalidCompanies)
                ], 422);
            }

            $requestEmail = $request->email;
            $currentAgentId = session('current_agent_id');

            // ----------------------------------------------------------------------
            // VERIFICATION ENFORCEMENT
            // ----------------------------------------------------------------------
            $isVerified = false;
            if (session('email_verified') && session('verified_email') === $requestEmail) {
                $isVerified = true;
            } else {
                // Check if existing agent in DB is already verified
                if ($currentAgentId) {
                    $currentAgent = Agent::find($currentAgentId);
                    if ($currentAgent && $currentAgent->email === $requestEmail && $currentAgent->email_verified_at) {
                        $isVerified = true;
                    }
                }
            }

            if (!$isVerified) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please verify your email address with OTP before continuing.'
                ], 422);
            }
            // ----------------------------------------------------------------------
            $existingUser = User::where('email', $requestEmail)->where('role', 'agent')->first();
            if ($existingUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'This email is already associated with an active Agent account. Please login to access your dashboard.'
                ], 422);
            }

            // 2. Check if the email exists in agents table to avoid duplicate entry error
            $existingAgentByEmail = Agent::where('email', $requestEmail)->first();
            
            // Prepare agent data
            $agentData = [
                'fullname' => $request->fullname,
                'email' => $requestEmail,
                'mobile' => $request->mobile,
                'user_types' => $request->user_types,
                'insurance_companies' => $insuranceCompanies,
                'experience_range' => $request->experience_range,
                'client_base' => $request->client_base,
                'registration_step' => 1,
                'status' => 'incomplete',
            ];

            if (session('email_verified') && session('verified_email') === $requestEmail) {
                $agentData['email_verified_at'] = now();
                // Clear verification session to prevent reuse
                session()->forget(['email_verified', 'verified_email']);
            }

            // Promo Code Logging (Store in file not in DB)
            if ($request->filled('promo_code')) {
                $promoCode = $request->promo_code;
                $validPromos = [
                    "LICINDIAPadosiAgent",
                    "TALICPadosiAgent",
                    "TAGICPadosiAgent",
                    "BALICPadosiAgent",
                    "BAGICPadosiAgent",
                    "STARSAHIPadosiAgent",
                    "CARESAHIPadosiAgent",
                    "NationalGICPadosiAgent",
                    "UnitedGICPadosiAgent",
                    "NewIndiaGICPadosiAgent",
                    "OriantalGICPadosiAgent",
                    "Pre-Launch"
                ];

                if (in_array($promoCode, $validPromos)) {
                    session(['applied_promo_code' => $promoCode]);

                    try {
                        $logData = [
                            'timestamp' => now()->toDateTimeString(),
                            'name' => $request->fullname,
                            'email' => $request->email,
                            'mobile' => $request->mobile,
                            'promo_code' => $promoCode
                        ];
                        \Illuminate\Support\Facades\Storage::append('promo_codes_applied.json', json_encode($logData));
                    } catch (\Exception $e) {
                        Log::error('Promo code file logging failed: ' . $e->getMessage());
                    }
                }
            } else {
                session()->forget('applied_promo_code');
            }

            // Determine if we should Create or Update
            if ($currentAgentId) {
                $currentAgent = Agent::find($currentAgentId);
                
                if ($currentAgent) {
                    // Check if they are trying to change to an email that already exists elsewhere
                    if ($existingAgentByEmail && $existingAgentByEmail->id !== $currentAgent->id) {
                         // Switch to the existing agent record (resume that one)
                         $agent = $existingAgentByEmail;
                         $agent->update($agentData);
                         session(['current_agent_id' => $agent->id]);
                         $operation = 'switched_to_existing';
                         $reason = 'Email changed to another existing incomplete agent record';
                    } else {
                        // Update current session agent
                        $agent = $currentAgent;
                        $agent->update($agentData);
                        $operation = 'updated_session_agent';
                        $reason = 'Updating agent in current session';
                    }
                } else {
                    // Session had ID but agent gone from DB? Create/Resume.
                    if ($existingAgentByEmail) {
                        $agent = $existingAgentByEmail;
                        $agent->update($agentData);
                        $operation = 'resumed_existing_no_session';
                    } else {
                        $agent = Agent::create($agentData);
                        $operation = 'created_new_not_found';
                    }
                    session(['current_agent_id' => $agent->id]);
                    $reason = 'Previous session ID invalid, resumed or created new';
                }
            } else {
                // No session - Create or Resume
                if ($existingAgentByEmail) {
                    $agent = $existingAgentByEmail;
                    $agent->update($agentData);
                    $operation = 'resumed_existing';
                    $reason = 'No session, but email found in incomplete registrations';
                } else {
                    $agent = Agent::create($agentData);
                    $operation = 'created_new';
                    $reason = 'Fresh registration';
                }
                session(['current_agent_id' => $agent->id]);
            }



            Log::info('STEP 1 - Agent ' . $operation . ' with ID: ' . $agent->id, [
                'reason' => $reason,
                'email' => $agent->email,
                'mobile' => $agent->mobile
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Registration details saved successfully!',
                    'redirect' => url('/chooseplan'),
                    'agent_id' => $agent->id,
                ]);
            }

            return redirect('/chooseplan');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('STEP 1 - Validation Error: ' . json_encode($e->errors()));
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('STEP 1 - Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function registerStep1_itsgood(Request $request)
    {
        Log::info('STEP 1 - Received data:', $request->all());

        try {
            // Validation
            $request->validate([
                'fullname' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'mobile' => 'required|string|max:15',
                'user_types' => 'required|array|min:1'
            ]);

            $currentAgentId = session('current_agent_id');

            // Check if email already exists (excluding current session if any)
            $existingAgent = Agent::where('email', $request->email)->first();

            if ($existingAgent && $existingAgent->id != $currentAgentId) {
                return response()->json([
                    'success' => false,
                    'message' => 'This email is already registered. Please use a different email or login to your account.'
                ], 422);
            }

            // Check if mobile already exists (excluding current session if any)
            $existingMobile = Agent::where('mobile', $request->mobile)->first();
            if ($existingMobile && $existingMobile->id != $currentAgentId) {
                return response()->json([
                    'success' => false,
                    'message' => 'This phone number is already registered. Please use a different phone number.'
                ], 422);
            }

            // Check if we have Google user data in session
            $googleUser = session('google_user');
            $isGoogleAuth = !empty($googleUser);

            // Prepare agent data - ONLY fields that exist in your table
            $agentData = [
                'fullname' => $request->fullname,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'user_types' => json_encode($request->user_types), // or $request->user_types if column is array type
                'registration_step' => 1,
                'status' => 'incomplete',
            ];

            // Add Google-specific data if available
            if ($isGoogleAuth) {
                $agentData['google_id'] = $googleUser['google_id'];
                $agentData['email_verified_at'] = now();
            }

            // Create or update agent
            if ($currentAgentId) {
                $currentAgent = Agent::find($currentAgentId);

                if ($currentAgent) {
                    // Check if this is the same person or different person
                    $isSamePerson = ($currentAgent->email === $request->email &&
                        $currentAgent->mobile === $request->mobile);

                    if ($isSamePerson) {
                        // Same person continuing - UPDATE
                        $agent = $currentAgent;
                        $agent->update($agentData);
                    } else {
                        // Different person - CREATE NEW and clear old session
                        session()->forget('current_agent_id');
                        $agent = Agent::create($agentData);
                        session(['current_agent_id' => $agent->id]);

                        Log::info('STEP 1 - Different person detected, created new agent. Old ID: ' . $currentAgentId . ', New ID: ' . $agent->id);
                    }
                } else {
                    // Agent not found in DB (session corrupted), create new
                    $agent = Agent::create($agentData);
                    session(['current_agent_id' => $agent->id]);

                    Log::info('STEP 1 - Agent not found in DB, created new agent with ID: ' . $agent->id);
                }
            } else {
                // No session, create new agent
                $agent = Agent::create($agentData);
                session(['current_agent_id' => $agent->id]);

                Log::info('STEP 1 - No session found, created new agent with ID: ' . $agent->id);
            }

            // Clear Google session data after successful registration
            if ($isGoogleAuth) {
                session()->forget('google_user');
            }

            Log::info('STEP 1 - Agent processed with ID: ' . $agent->id, [
                'previous_agent_id' => $currentAgentId,
                'email' => $agent->email,
                'mobile' => $agent->mobile,
                'operation' => isset($isSamePerson) && $isSamePerson ? 'updated' : 'created'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Basic information saved successfully!',
                'next_step' => 2,
                'agent_id' => $agent->id,
                'is_google_auth' => $isGoogleAuth,
                'operation' => isset($isSamePerson) && $isSamePerson ? 'updated' : 'created_new'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('STEP 1 - Validation Error: ' . json_encode($e->errors()));

            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('STEP 1 - Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function registerStep1_old(Request $request)
    {
        Log::info('STEP 1 - Received data:', $request->all());

        try {
            // Validation
            $request->validate([
                'fullname' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'mobile' => 'required|string|max:15',
                'user_types' => 'required|array|min:1'
            ]);

            // Check if email already exists (excluding current session if any)
            $existingAgent = Agent::where('email', $request->email)->first();
            $currentAgentId = session('current_agent_id');

            if ($existingAgent) {

                return response()->json([
                    'success' => false,
                    'message' => 'This email is already registered. Please use a different email or login to your account.'
                ], 422);
            }

            // Check if mobile already exists (excluding current session if any)
            $existingMobile = Agent::where('mobile', $request->mobile)->first();
            if ($existingMobile) {
                return response()->json([
                    'success' => false,
                    'message' => 'This mobile number is already registered. Please use a different mobile number.'
                ], 422);
            }

            // Check if we have Google user data in session
            $googleUser = session('google_user');
            $isGoogleAuth = !empty($googleUser);

            // Prepare agent data
            $agentData = [
                'fullname' => $request->fullname,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'user_types' => $request->user_types,
                'registration_step' => 1,
                'status' => 'incomplete',
            ];

            // Add Google-specific data if available
            if ($isGoogleAuth) {
                $agentData['google_id'] = $googleUser['google_id'];
                $agentData['email_verified_at'] = now(); // Mark email as verified for Google users
            }

            // Create or update agent
            if ($existingAgent && $existingAgent->id == $currentAgentId) {
                // Update existing agent
                $agent = $existingAgent;
                $agent->update($agentData);
            } else {
                // Create new agent
                $agentData['unique_id'] = 'PAD' . Str::random(6) . time();
                $agentData['password'] = Hash::make(Str::random(12));

                $agent = Agent::create($agentData);
            }

            // Store agent ID in session for subsequent steps
            session(['current_agent_id' => $agent->id]);

            // Clear Google session data after successful registration
            if ($isGoogleAuth) {
                session()->forget('google_user');
            }

            Log::info('STEP 1 - Agent created/updated with ID: ' . $agent->id, [
                'google_id' => $agent->google_id,
                'email_verified_at' => $agent->email_verified_at
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Basic information saved successfully!',
                'next_step' => 2,
                'agent_id' => $agent->id,
                'is_google_auth' => $isGoogleAuth
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('STEP 1 - Validation Error: ' . json_encode($e->errors()));

            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('STEP 1 - Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function registerStep2(Request $request)
    {
        Log::info('STEP 2 - Received data:', $request->all());

        try {
            // Get agent ID from session
            $agentId = session('current_agent_id');

            if (!$agentId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Session expired. Please start registration again.'
                ], 400);
            }

            // Find the agent
            $agent = Agent::find($agentId);
            if (!$agent) {
                return response()->json([
                    'success' => false,
                    'message' => 'Agent record not found. Please start registration again.'
                ], 404);
            }

            // Define valid insurance companies
            $validInsuranceCompanies = [
                'Life Insurance Corporation of India',
                'Axis Max Life Insurance Limited',
                'HDFC Life Insurance Company Limited',
                'ICICI Prudential Life Insurance Company Limited',
                'Kotak Mahindra Life Insurance Company Limited',
                'Aditya Birla SunLife Insurance Company Limited',
                'TATA AIA Life Insurance Company Limited',
                'SBI Life Insurance Company Limited',
                'Bajaj Life Insurance Limited',
                'PNB MetLife India Insurance Company Limited',
                'Reliance Nippon Life Insurance Company Limited',
                'Aviva Life Insurance Company India Limited',
                'Sahara India Life Insurance Company Limited',
                'Shriram Life Insurance Company Limited',
                'Bharti AXA Life Insurance Company Limited',
                'Generali Central Life Insurance Company Limited',
                'Ageas Federal Life Insurance Company Limited',
                'Canara HSBC Life Insurance Company Limited',
                'Bandhan Life Insurance Limited',
                'Pramerica Life Insurance Company Limited',
                'Star Union Dai-Ichi Life Insurance Company Limited',
                'IndiaFirst Life Insurance Company Limited',
                'Edelweiss Life Insurance Company Limited',
                'CreditAccess Life Insurance Limited',
                'Acko Life Insurance Limited',
                'Go Digit Life Insurance Limited',
                'Acko General Insurance Limited',
                'Agriculture Insurance Company of India Limited',
                'Bajaj General Insurance Limited',
                'Cholamandalam MS General Insurance Company Limited',
                'ECGC Limited',
                'Generali Central Insurance Company Limited',
                'Go Digit General Insurance Limited',
                'HDFC ERGO General Insurance Company Limited',
                'ICICI LOMBARD General Insurance Company Limited',
                'IFFCO TOKIO General Insurance Company Limited',
                'Zurich Kotak General Insurance Company Limited',
                'Kshema General Insurance Limited',
                'Liberty General Insurance Limited',
                'Magma General Insurance Limited',
                'National Insurance Company Limited',
                'Navi General Insurance Limited',
                'Raheja QBE General Insurance Co. Ltd.',
                'Reliance General Insurance Company Limited',
                'Royal Sundaram General Insurance Company Limited',
                'SBI General Insurance Company Limited',
                'Shriram General Insurance Company Limited',
                'Tata AIG General Insurance Company Limited',
                'The New India Assurance Company Limited',
                'The Oriental Insurance Company Limited',
                'United India Insurance Company Limited',
                'Universal Sompo General Insurance Company Limited',
                'Zuna General Insurance Ltd.',
                'Aditya Birla Health Insurance Co. Limited',
                'Care Health Insurance Ltd.',
                'Galaxy Health and Allied Insurance Company Limited',
                'ManipalCigna Health Insurance Company Limited',
                'Niva Bupa Health Insurance Company Limited',
                'Reliance Health Insurance Ltd.',
                'Star Health & Allied Insurance Co. Ltd.',
                'Narayana Health Insurance Company Limited'
            ];

            // Validate insurance companies if provided
            $insuranceCompanies = [];
            if (!$request->has('insurance_companies')) {

                return response()->json([
                    'success' => false,
                    'message' => 'Please add atlest one insurance company.'
                ], 422);
            }

            if ($request->has('insurance_companies') && !empty($request->insurance_companies)) {
                $insuranceCompanies = json_decode($request->insurance_companies, true);

                if (!is_array($insuranceCompanies)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid insurance companies format.'
                    ], 422);
                }

                // Check for invalid companies
                $invalidCompanies = array_diff($insuranceCompanies, $validInsuranceCompanies);
                if (!empty($invalidCompanies)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid insurance companies selected: ' . implode(', ', $invalidCompanies)
                    ], 422);
                }
            }

            // $portfolioTotal = ($request->life_insurance ?? 0) +
            //     ($request->health_insurance ?? 0) +
            //     ($request->general_insurance ?? 0) +
            //     ($request->motor ?? 0);

            // if ($portfolioTotal !== 100) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Portfolio distribution must total 100%. Current total: ' . $portfolioTotal . '%'
            //     ], 422);
            // }

            // Validation for step 2
            $request->validate([
                'license_number' => 'nullable|string|max:255',
                'pan_number' => 'nullable|string|max:20',
                'insurance_companies' => 'nullable|string', // Keep as string since it's JSON
                'experience_range' => 'required|string|max:50',
                'client_base' => 'required|string|max:50',
                'life_insurance' => 'nullable|integer|min:0|max:100',
                'health_insurance' => 'nullable|integer|min:0|max:100',
                'general_insurance' => 'nullable|integer|min:0|max:100',
                'motor' => 'nullable|integer|min:0|max:100',
                //'others' => 'nullable|integer|min:0|max:100',
                'desired_services' => 'nullable|array',
                'software_services' => 'nullable|array',
                'software_name' => 'nullable|string|max:255',
            ]);

            // Validate portfolio total is 100%
            // $portfolioTotal = ($request->life_insurance ?? 0) +
            //     ($request->health_insurance ?? 0) +
            //     ($request->general_insurance ?? 0) +
            //     ($request->motor ?? 0) +
            //     ($request->others ?? 0);

            // $portfolioTotal = ($request->life_insurance ?? 0) +
            //     ($request->health_insurance ?? 0) +
            //     ($request->general_insurance ?? 0) +
            //     ($request->motor ?? 0);

            // if ($portfolioTotal !== 100) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Portfolio distribution must total 100%. Current total: ' . $portfolioTotal . '%'
            //     ], 422);
            // }

            // Update agent with core registration data and draft for the rest
            $agent->update([
                'insurance_companies' => $insuranceCompanies,
                'experience_range' => $request->experience_range,
                'client_base' => $request->client_base,
                'registration_step' => 2,
                'registration_draft' => [
                    'license_number' => $request->license_number,
                    'pan_number' => $request->pan_number,
                    'portfolio_breakdown' => [
                        'life_insurance' => $request->life_insurance ?? 0,
                        'health_insurance' => $request->health_insurance ?? 0,
                        'general_insurance' => $request->general_insurance ?? 0,
                        'motor' => $request->motor ?? 0,
                    ],
                    'desired_services' => $request->desired_services,
                    'software_services' => $request->software_services,
                    'software_name' => $request->software_name ?? null,
                ]
            ]);

            Log::info('STEP 2 - Agent updated: ' . $agent->id, [
                'pan_number' => $agent->pan_number,
                'software_name' => $agent->software_name,
                'insurance_companies' => $agent->insurance_companies,
                'portfolio_total' => @$portfolioTotal
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Professional details saved successfully!',
                'next_step' => 3,
                'agent_id' => $agent->id
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('STEP 2 - Validation Error: ' . json_encode($e->errors()));

            return response()->json([
                'success' => false,
                'message' => 'Please check the form data again!',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('STEP 2 - Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
    
public function completeRegistration(Request $request)
{
    Log::info('COMPLETE REGISTRATION - Starting', $request->all());

    try {
        // Get agent ID from session
        $agentId = session('current_agent_id');

        if (!$agentId) {
            return response()->json(['success' => false, 'message' => 'Session expired.'], 400);
        }

        $agent = Agent::find($agentId);
        if (!$agent) {
            return response()->json(['success' => false, 'message' => 'Agent not found.'], 404);
        }

        // 1. Basic Validation (only trust the plan identifier)
        $request->validate([
            'plan_type' => 'required|in:basic,professional',
            'plan_name' => 'required|string',
        ]);

        // 2. SERVER-SIDE PRICE DEFINITION (Overrides any values from frontend)
        $hasPromo = session()->has('applied_promo_code');
        
        // Define Final Totals (Matches your plans.blade.php logic)
        $pricing = [
            'basic' => [
                'standard' => 2359,
                'promo' => 589
            ],
            'professional' => [
                'standard' => 8258,
                'promo' => 2359
            ]
        ];

        // Retrieve the verified price
        $planType = $request->plan_type;
        $planName = $request->plan_name;
        $totalAmount = $pricing[$planType][$hasPromo ? 'promo' : 'standard'] ?? 2359;

        // 3. Reverse calculate base amount (to keep GST logs consistent)
        $planAmount = round($totalAmount / 1.18, 0); 
        $gst = $totalAmount - $planAmount;

        // Initialize Razorpay
        $key = config('services.razorpay.key');
        $secret = config('services.razorpay.secret');
        $razorpayOrder = null;

        if (!empty($key) && !empty($secret) && $key !== 'your_razorpay_key_here') {
            $razorpay = new \Razorpay\Api\Api($key, $secret);

            // Amount in paise
            $amountInPaise = $totalAmount * 100;

            $orderData = [
                'receipt' => 'agent_' . $agent->id . '_' . time(),
                'amount' => $amountInPaise,
                'currency' => 'INR',
                'payment_capture' => 1,
                'notes' => [
                    'agent_id' => $agent->id,
                    'plan_type' => $planType,
                    'plan_name' => $planName
                ]
            ];

            try {
                $razorpayOrder = $razorpay->order->create($orderData);
                Log::info('Razorpay Order Created:', ['order_id' => $razorpayOrder['id'], 'amount' => $totalAmount]);
            } catch (\Exception $e) {
                Log::error('Razorpay API Failed: ' . $e->getMessage());
                $razorpayOrder = null;
            }
        }

        // Update/Create Agent Subscription record
        $subscription = AgentSubscription::updateOrCreate(
            ['agent_id' => $agent->id, 'payment_status' => 'pending'],
            [
                'selected_plan' => $planName,
                'registration_amount' => $totalAmount, // Verified positive amount
                'razorpay_order_id' => $razorpayOrder['id'] ?? null,
                'status' => 'inactive'
            ]
        );

        $agent->update([
            'registration_step' => 3,
            'status' => 'pending_payment'
        ]);

        if ($razorpayOrder) {
            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder['id'],
                'amount' => $amountInPaise,
                'key' => $key,
                'agent_id' => $agent->id,
                'name' => $agent->fullname,
                'email' => $agent->email,
                'plan_amount' => $planAmount,
                'total_amount' => $totalAmount,
                'test_payment' => substr($key, 0, 8) === 'rzp_test'
            ]);
        } else {
            // Error: Don't allow user to proceed if Razorpay failed in production
            if (substr($key, 0, 8) !== 'rzp_test' && !empty($key)) {
                return response()->json(['success' => false, 'message' => 'Payment system error. Please try later.'], 500);
            }

            // Test Mode Fallback (Keep this only if you want to allow free test signups)
            $subscription->update(['payment_status' => 'completed', 'status' => 'active']);
            $agent->update(['status' => 'active']);

            return response()->json([
                'success' => true,
                'message' => 'Test registration successful!',
                'test_payment' => true,
                'agent_id' => $agent->id
            ]);
        }
    } catch (\Exception $e) {
        Log::error('Registration Error: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Server error occurred.'], 500);
    }
}

    public function completeRegistration_02March_2026(Request $request)
    {
        Log::info('COMPLETE REGISTRATION - Starting', $request->all());

        try {
            // Get agent ID from session
            $agentId = session('current_agent_id');

            if (!$agentId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Session expired. Please start registration again.'
                ], 400);
            }

            // Find the agent
            $agent = Agent::find($agentId);
            if (!$agent) {
                return response()->json([
                    'success' => false,
                    'message' => 'Agent record not found. Please start registration again.'
                ], 404);
            }

            // Validate plan selection
            $request->validate([
                'plan_type' => 'required|in:basic,professional',
                'plan_name' => 'required|string',
                'plan_amount' => 'required|numeric'
            ]);

            $planType = $request->plan_type;
            $planName = $request->plan_name;
            $planAmount = $request->plan_amount;

            // Calculate total with GST (18%)
            $gst = $planAmount * 0.18;
            $totalAmount = round($planAmount + $gst);

            // Initialize Razorpay
            $key = config('services.razorpay.key');
            $secret = config('services.razorpay.secret');
            $razorpayOrder = null;

            if (!empty($key) && !empty($secret) && $key !== 'your_razorpay_key_here') {
                $razorpay = new \Razorpay\Api\Api($key, $secret);

                // Create Razorpay order (amount in paise)
                $amountInPaise = $totalAmount * 100;

                $orderData = [
                    'receipt' => 'agent_' . $agent->id . '_' . time(),
                    'amount' => $amountInPaise,
                    'currency' => 'INR',
                    'payment_capture' => 1,
                    'notes' => [
                        'agent_id' => $agent->id,
                        'agent_email' => $agent->email,
                        'plan_type' => $planType,
                        'plan_name' => $planName,
                        'purpose' => 'Agent Registration - ' . $planName
                    ]
                ];

                try {
                    $razorpayOrder = $razorpay->order->create($orderData);
                    Log::info('Razorpay Order Created successfully:', ['order_id' => $razorpayOrder['id']]);
                } catch (\Exception $e) {
                    Log::error('Razorpay API Order Creation Failed: ' . $e->getMessage(), [
                        'agent_id' => $agent->id,
                        'amount' => $amountInPaise
                    ]);
                    $razorpayOrder = null;
                }
            } else {
                Log::warning('Razorpay Order Creation Skipped: Credentials missing or invalid.', [
                    'key_exists' => !empty($key),
                    'secret_exists' => !empty($secret),
                    'is_placeholder' => ($key === 'your_razorpay_key_here')
                ]);
            }

            // Update/Create Agent Subscription record
            $subscription = AgentSubscription::updateOrCreate(
                ['agent_id' => $agent->id, 'payment_status' => 'pending'],
                [
                    'selected_plan' => $planName,
                    'registration_amount' => $totalAmount,
                    'razorpay_order_id' => $razorpayOrder['id'] ?? null,
                    'status' => 'inactive'
                ]
            );

            // Update agent step and status
            $agent->update([
                'registration_step' => 3,
                'status' => 'pending_payment'
            ]);

            if ($razorpayOrder) {
                Log::info('Razorpay order created: ' . $razorpayOrder['id']);

                return response()->json([
                    'success' => true,
                    'order_id' => $razorpayOrder['id'],
                    'amount' => $orderData['amount'],
                    'currency' => $orderData['currency'],
                    'key' => $key,
                    'agent_id' => $agent->id,
                    'name' => $agent->fullname,
                    'email' => $agent->email,
                    'mobile' => $agent->mobile,
                    'plan_type' => $planType,
                    'plan_name' => $planName,
                    'plan_amount' => $planAmount,
                    'total_amount' => $totalAmount,
                    'test_payment' => substr($key, 0, 8) === 'rzp_test' // Mark as test payment ONLY if using test keys
                ]);
            } else {
                // FALLBACK ONLY IF RAZORPAY FAILED OR NO KEYS CONFIGURED
                Log::warning('Razorpay order creation failed or keys missing. Falling back to manual activation.');
                
                // If you want to FORCE payment and stop here, uncomment execution blocking
                // return response()->json(['success' => false, 'message' => 'Payment gateway initialization failed.'], 500);

                // For test environment without keys, auto-complete
                $subscription->update([
                    'payment_status' => 'completed',
                    'status' => 'active',
                    'razorpay_payment_id' => 'test_pay_' . time(),
                    'razorpay_order_id' => 'test_order_' . time(),
                    'starts_at' => now(),
                    'expires_at' => now()->addYear(),
                ]);

                $agent->update([
                    'status' => 'active',
                    'registration_step' => 2,
                ]);

                Log::info('Test payment auto-completed for agent: ' . $agent->id);

                return response()->json([
                    'success' => true,
                    'message' => 'We have received your payment. We will share your login credentials on your email.',
                    'test_payment' => true,
                    'agent_id' => $agent->id
                ]);
            }
        } catch (\Exception $e) {
            Log::error('COMPLETE REGISTRATION - Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
    public function handlePaymentSuccess(Request $request)
    {
        Log::info('PAYMENT SUCCESS - Received:', $request->all());

        try {
            $agent = Agent::find($request->agent_id);

            if (!$agent) {
                throw new \Exception('Agent not found');
            }


            // Check if payment already processed (prevents double processing)
            if ($agent->payment_status === 'completed') {
                Log::warning('Payment already processed for agent: ' . $agent->id);

                // Clear session if still exists
                session()->forget('current_agent_id');

                return response()->json([
                    'success' => true,
                    'message' => 'Payment already processed successfully.'
                ]);
            }

            // Validate required fields
            if (empty($request->razorpay_payment_id) || empty($request->razorpay_order_id) || empty($request->razorpay_signature)) {
                throw new \Exception('Missing payment verification data');
            }



            // Verify payment signature if Razorpay is configured
            $key = config('services.razorpay.key');
            $secret = config('services.razorpay.secret');

            if (!empty($key) && !empty($secret) && $key !== 'your_razorpay_key_here') {
                $razorpay = new \Razorpay\Api\Api($key, $secret);

                $attributes = [
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature
                ];

                $razorpay->utility->verifyPaymentSignature($attributes);
                Log::info('Payment signature verified successfully');
            }

            // Update Subscription record
            $subscription = AgentSubscription::where('razorpay_order_id', $request->razorpay_order_id)->first();
            if ($subscription) {
                $subscription->update([
                    'payment_status' => 'completed',
                    'status' => 'active',
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature,
                    'starts_at' => now(),
                    'expires_at' => now()->addYear(),
                ]);
            }

            // Update agent status and commit draft data
            $agent->update([
                'status' => 'active',
                'registration_step' => 2, // Mark as fully registered
            ]);

            // Commit draft data to normalized tables
            $this->commitRegistrationData($agent);

            // Clear session
            session()->forget('current_agent_id');

            Log::info('PAYMENT SUCCESS - Agent registration completed: ' . $agent->id);

            // Create/Link User record
            $this->createOrLinkUser($agent);

            // Send Success Email
            try {
                Mail::to($agent->email)->send(new PaymentSuccessMail($agent));
                Log::info('Payment Success Email sent to: ' . $agent->email);
            } catch (\Exception $e) {
                Log::error('Failed to send Payment Success Email: ' . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'We have received your payment. We will share your login credentials on your email.'
            ]);
        } catch (\Exception $e) {
            Log::error('PAYMENT SUCCESS - Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed: ' . $e->getMessage()
            ], 400);
        }
    }

    public function handlePaymentFailure(Request $request)
    {
        Log::warning('PAYMENT FAILURE - Received:', $request->all());

        try {
            $agentId = $request->agent_id;
            $agent = Agent::find($agentId);

            if ($agent) {
                $subscription = AgentSubscription::where('agent_id', $agent->id)
                    ->where('payment_status', 'pending')
                    ->latest()
                    ->first();
                
                if ($subscription) {
                    $subscription->update(['payment_status' => 'failed']);
                }

                $agent->update([
                    'status' => 'pending_payment'
                ]);
                Log::info('Agent payment status updated to failed in subscription table: ' . $agentId);
            }

            return response()->json([
                'success' => true,
                'message' => 'Payment failure logged.'
            ]);
        } catch (\Exception $e) {
            Log::error('PAYMENT FAILURE LOG ERR: ' . $e->getMessage());
            return response()->json(['success' => false], 500);
        }
    }

    /**
     * Handle Razorpay webhook
     */
    public function handleWebhook(Request $request)
    {
        // Get raw body and signature
        $payload = $request->getContent();
        $receivedSignature = $request->header('X-Razorpay-Signature');

        Log::info('RAZORPAY WEBHOOK RECEIVED', [
            'signature' => $receivedSignature,
            'payload' => $payload
        ]);

        // Verify webhook signature
        $webhookSecret = config('services.razorpay.webhook_secret');

        if (!$webhookSecret) {
            Log::error('RAZORPAY_WEBHOOK_SECRET not configured');
            return response('Webhook secret not configured', 400);
        }

        // $expectedSignature = hash_hmac('sha256', $payload, $webhookSecret);

        // if ($receivedSignature !== $expectedSignature) {
        //     Log::error('WEBHOOK SIGNATURE INVALID', [
        //         'expected' => $expectedSignature,
        //         'received' => $receivedSignature
        //     ]);
        //     return response('Invalid signature', 400);
        // }

        $data = json_decode($payload, true);
        $event = $data['event'] ?? null;

        if (!$event) {
            return response('Invalid event', 400);
        }

        Log::info('WEBHOOK EVENT: ' . $event);

        try {
            switch ($event) {
                case 'payment.captured':
                    $this->handlePaymentCaptured($data['payload']['payment']['entity']);
                    break;

                case 'payment.failed':
                    $this->handlePaymentFailed($data['payload']['payment']['entity']);
                    break;

                case 'order.paid':
                    $this->handleOrderPaid($data['payload']['order']['entity']);
                    break;
            }

            return response('Webhook processed successfully', 200);
        } catch (\Exception $e) {
            Log::error('WEBHOOK PROCESSING ERROR: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response('Error processing webhook', 500);
        }
    }

    /**
     * Handle successful payment
     */
    private function handlePaymentCaptured($payment)
    {
        Log::info('PAYMENT CAPTURED WEBHOOK', $payment);

        $orderId = $payment['order_id'];

        // Find subscription by razorpay_order_id
        $subscription = AgentSubscription::where('razorpay_order_id', $orderId)->first();

        if (!$subscription) {
            Log::error('Subscription not found for order: ' . $orderId);
            return;
        }

        $agent = $subscription->agent;

        // Update subscription record
        $subscription->update([
            'payment_status' => 'completed',
            'status' => 'active',
            'razorpay_payment_id' => $payment['id'],
            'starts_at' => now(),
            'expires_at' => now()->addYear(),
        ]);

        // Update agent status
        $agent->update([
            'status' => 'active',
            'registration_step' => 2,
        ]);

        // Commit draft data
        $this->commitRegistrationData($agent);

        Log::info('WEBHOOK: Agent activated via webhook: ' . $agent->id);

        // Create/Link User record
        $this->createOrLinkUser($agent);
    }

    /**
     * Handle failed payment
     */
    private function handlePaymentFailed($payment)
    {
        Log::info('PAYMENT FAILED WEBHOOK', $payment);

        $orderId = $payment['order_id'];

        $subscription = AgentSubscription::where('razorpay_order_id', $orderId)->first();

        if ($subscription) {
            $subscription->update([
                'payment_status' => 'failed',
                'status' => 'inactive'
            ]);
            Log::info('WEBHOOK: Payment failed for subscription order: ' . $orderId);
        }
    }

    /**
     * Handle order paid (alternative to payment.captured)
     */
    private function handleOrderPaid($order)
    {
        Log::info('ORDER PAID WEBHOOK', $order);

        $subscription = AgentSubscription::where('razorpay_order_id', $order['id'])->first();

        if ($subscription && $subscription->payment_status !== 'completed') {
            $subscription->update([
                'payment_status' => 'completed',
                'status' => 'active',
                'starts_at' => now(),
                'expires_at' => now()->addYear(),
            ]);

            $agent = $subscription->agent;
            $agent->update([
                'status' => 'active',
                'registration_step' => 2,
            ]);

            // Commit draft data
            $this->commitRegistrationData($agent);

            Log::info('WEBHOOK: Order paid for agent: ' . $agent->id);

            // Create/Link User record
            $this->createOrLinkUser($agent);
        }
    }


    public function completeRegistration_OLD(Request $request)
    {
        Log::info('COMPLETE REGISTRATION - Starting');

        try {
            // Get agent ID from session
            $agentId = session('current_agent_id');

            if (!$agentId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Session expired. Please start registration again.'
                ], 400);
            }

            // Find the agent
            $agent = Agent::find($agentId);
            if (!$agent) {
                return response()->json([
                    'success' => false,
                    'message' => 'Agent record not found. Please start registration again.'
                ], 404);
            }

            // Check if agent has completed step 2
            // if ($agent->registration_step < 2) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Please complete all registration steps first.'
            //     ], 400);
            // }

            // Update agent status to pending payment
            $agent->update([
                'registration_step' => 3,
                'status' => 'pending_payment',
                'registration_amount' => 2358.00,
                'payment_initiated_at' => now(),
            ]);

            Log::info('COMPLETE REGISTRATION - Agent ready for payment: ' . $agent->id);

            // Initialize Razorpay
            $key = env('RAZORPAY_KEY');
            $secret = env('RAZORPAY_SECRET');

            if (!empty($key) && !empty($secret) && $key !== 'your_razorpay_key_here') {
                $razorpay = new \Razorpay\Api\Api($key, $secret);

                // Create Razorpay order
                $orderData = [
                    'receipt' => 'agent_' . $agent->id,
                    'amount' => 235800, // ₹2358 in paise
                    'currency' => 'INR',
                    'payment_capture' => 1,
                    'notes' => [
                        'agent_id' => $agent->id,
                        'agent_email' => $agent->email,
                        'purpose' => 'Agent Registration Fee'
                    ]
                ];

                $razorpayOrder = $razorpay->order->create($orderData);

                // Update agent with Razorpay order ID
                $agent->update([
                    'razorpay_order_id' => $razorpayOrder['id']
                ]);

                Log::info('Razorpay order created: ' . $razorpayOrder['id']);

                return response()->json([
                    'success' => true,
                    'order_id' => $razorpayOrder['id'],
                    'amount' => $orderData['amount'],
                    'currency' => $orderData['currency'],
                    'key' => $key,
                    'agent_id' => $agent->id,
                    'name' => $agent->fullname,
                    'email' => $agent->email,
                    'mobile' => $agent->mobile,
                    'test_payment' => false
                ]);
            } else {
                // If Razorpay not configured, mark as test payment
                $agent->update([
                    'payment_status' => 'completed',
                    'status' => 'active',
                    'razorpay_payment_id' => 'test_pay_' . time(),
                    'razorpay_order_id' => 'test_order_' . time(),
                    'payment_completed_at' => now(),
                ]);

                Log::info('Test payment completed for agent: ' . $agent->id);

                return response()->json([
                    'success' => true,
                    'message' => 'Registration completed successfully! (Test Mode)',
                    'test_payment' => true,
                    'agent_id' => $agent->id
                ]);
            }
        } catch (\Exception $e) {
            Log::error('COMPLETE REGISTRATION - Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check email availability (optional API endpoint)
     */
    public function checkEmail(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email'
            ]);

            $exists = Agent::where('email', $request->email)->exists();

            return response()->json([
                'success' => true,
                'available' => !$exists,
                'message' => $exists ? 'Email already registered' : 'Email available'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error checking email: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create a User record for the agent and link it
     */
    private function createOrLinkUser(Agent $agent)
    {
        try {
            if ($agent->user_id) {
                return $agent->user;
            }

            // Check if user already exists with this email
            $user = User::where('email', $agent->email)->first();

            if (!$user) {
                $user = User::create([
                    'fullname' => $agent->fullname,
                    'email' => $agent->email,
                    'password' => Hash::make($agent->email), // Store email as hashed password
                    'role' => 'agent',
                    'status' => 'active',
                    'email_verified_at' => $agent->email_verified_at,
                ]);
                Log::info('New User record created for Agent: ' . $user->id);
            } else {
                // If user exists, ensure they have the agent role and update password to email
                $user->update([
                    'role' => 'agent',
                    'password' => Hash::make($agent->email)
                ]);
                Log::info('Existing User record found and updated for Agent: ' . $user->id);
            }

            $agent->update(['user_id' => $user->id]);

            return $user;
        } catch (\Exception $e) {
            Log::error('FAILED TO CREATE/LINK USER: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Commit data from registration_draft to normalized tables
     */
    private function commitRegistrationData(Agent $agent)
    {
        $draft = $agent->registration_draft;

        if (empty($draft)) {
            Log::info('No registration draft found for Agent: ' . $agent->id);
            return;
        }

        try {
            // Update Agent Profile with the details from draft
            $profile = AgentProfile::firstOrCreate(['agent_id' => $agent->id]);
            
            $profile->update([
                'license_number' => $draft['license_number'] ?? null,
                'pan_number' => $draft['pan_number'] ?? null,
                'software_name' => $draft['software_name'] ?? null,
                'portfolio_breakdown' => $draft['portfolio_breakdown'] ?? null,
                'desired_services' => $draft['desired_services'] ?? null,
            ]);

            // Logic for other tables like AgentInsuranceSegment could be added here if needed
            if (!empty($draft['desired_services'])) {
                // Example: Pre-fill some defaults or specific logic
            }

            // Clear draft after successful commit
            // $agent->update(['registration_draft' => null]);
            
            Log::info('Registration draft data committed for Agent: ' . $agent->id);
        } catch (\Exception $e) {
            Log::error('Draft commit failed for Agent: ' . $agent->id . ' - ' . $e->getMessage());
        }
    }
}
