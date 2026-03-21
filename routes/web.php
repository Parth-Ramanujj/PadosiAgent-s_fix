<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Agent\AgentRegistrationController;
use App\Http\Controllers\Frontend\ComingSoonController;
use App\Http\Controllers\User\ParticipantController;
use App\Http\Controllers\Frontend\FacebookPostController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\AgentLeadController;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\ExportAgentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\Agent\AgentProfileController;
use App\Http\Controllers\Client\ClientRegistrationController;

use Mailtrap\Helper\ResponseHelper;
use Mailtrap\MailtrapClient;
use Mailtrap\Mime\MailtrapEmail;
use Symfony\Component\Mime\Address;



Route::get('agents/export', [ExportAgentController::class, 'export'])
    ->name('agents.export');

// Default landing page
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/find-agents', [HomeController::class, 'findAgents'])->name('find.agents');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/profile/{slug}', [AgentProfileController::class, 'showProfile'])->name('agent.public-profile');
Route::post('/profile/{slug}/review', [AgentProfileController::class, 'storeReview'])->name('agent.store-review');
Route::post('/agent/toggle-favorite', [\App\Http\Controllers\Frontend\FavoriteController::class, 'toggleFavorite'])->name('agent.toggle-favorite');
// Contact Us Routes
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact/submit', [ContactController::class, 'store'])->name('contact.submit');
Route::view('/agent-login', 'agent-login')->name('agent.login');
Route::view('/client-login', 'client-login')->name('client.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/client/quick-register', [ClientRegistrationController::class, 'quickRegister'])->name('client.quick-register');
Route::post('/agent/leads/capture', [AgentLeadController::class, 'capture'])->name('agent.leads.capture');

// Password Reset Routes
Route::get('/forgot-password', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::get('/reset-password', function () { abort(404); });
Route::post('/reset-password', [AuthController::class, 'reset'])->name('password.update');

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminAgentController;

// Admin Panel Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    // Guest Admin Routes
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);

    // Protected Admin Routes
    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/agents', [AdminAgentController::class, 'index'])->name('agents');
        Route::post('/agents/toggle-status', [AdminAgentController::class, 'toggleStatus'])->name('agents.toggle_status');
        Route::get('/agents/get/{id}', [AdminAgentController::class, 'getAgent'])->name('agents.get');
        Route::get('/agents/manage/{id}', [AdminAgentController::class, 'showManageAgent'])->name('agents.manage');
        Route::post('/agents/save-notes', [AdminAgentController::class, 'saveAgentNotes'])->name('agents.save_notes');
        Route::post('/agents/update-plan', [AdminAgentController::class, 'updatePlan'])->name('agents.update_plan');
        Route::post('/agents/update-visibility', [AdminAgentController::class, 'updateVisibility'])->name('agents.update_visibility');
        Route::post('/agents/toggle-review', [AdminAgentController::class, 'toggleReviewApproval'])->name('agents.toggle_review_approval');
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});

Route::middleware(['auth', 'role:agent'])->prefix('agent')->group(function () {
    Route::get('/dashboard', [AgentDashboardController::class, 'index'])->name('agent.dashboard');
    Route::get('/edit-profile', [AgentProfileController::class, 'edit'])->name('agent.edit-profile');
    Route::post('/edit-profile', [AgentProfileController::class, 'update'])->name('agent.update-profile');
});

// Temporary preview route for the dashboard
Route::get('/preview/agent-dashboard', function () {
    $agent = auth()->user()?->agent;
    if (!$agent) {
        return "Please log in as an agent to view the dashboard.";
    }
    $agent->load(['profile', 'activeSubscription', 'serviceableCities', 'insuranceSegments']);
    return view('agent.dashboard', compact('agent'));
})->name('preview.agent.dashboard');

Route::get('/coming-soon', [ComingSoonController::class, 'index'])->name('coming.soon');
Route::get('/terms', function () {
    return view('terms');
});
Route::get('/privacy', function () {
    return view('privacy');
});
Route::get('/cancellation-refund-policy', function () {
    return view('CancellationRefundPolicy');
});

Route::get('/chooseplan', [AgentRegistrationController::class, 'showPlans'])->name('agent.plans');

// Agent Registration Routes (keep these as they are)
Route::get('/agent-registration', [AgentRegistrationController::class, 'showRegistrationForm'])->name('agent.registration');

// Update these routes to match your subdirectory structure
Route::post('/agent-send-otp', [AgentRegistrationController::class, 'sendOtp'])->name('agent.send.otp');
Route::post('/agent-verify-otp', [AgentRegistrationController::class, 'verifyOtp'])->name('agent.verify.otp');
Route::post('/agent-register-step1', [AgentRegistrationController::class, 'registerStep1'])->name('agent.register.step1');
Route::post('/agent-register-step2', [AgentRegistrationController::class, 'registerStep2'])->name('agent.register.step2');
Route::post('/agent-register-complete', [AgentRegistrationController::class, 'completeRegistration'])->name('agent.register.complete');
Route::post('/payment-success', [AgentRegistrationController::class, 'handlePaymentSuccess'])->name('payment.success');
Route::post('/payment-failure', [AgentRegistrationController::class, 'handlePaymentFailure'])->name('payment.failure');

// Razorpay Webhook Route (should be CSRF-exempt)
Route::post('/razorpay-webhook', [AgentRegistrationController::class, 'handleWebhook']);

// Google Authentication Routes
//Route::get('/auth/google', [AgentRegistrationController::class, 'redirectToGoogle'])->name('google.login');
//Route::get('/auth/google/callback', [AgentRegistrationController::class, 'handleGoogleCallback']);

Route::get('/auth/google', [AgentRegistrationController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AgentRegistrationController::class, 'handleGoogleCallback']);
// ADD THIS NEW ROUTE ONLY:
Route::get('/auth/google/get-session-data', [AgentRegistrationController::class, 'getGoogleSessionData']);


// Google Data API Routes
Route::get('/auth/google/user-data', [AgentRegistrationController::class, 'getGoogleUserData']);
//Route::post('/auth/google/clear-session', [AgentRegistrationController::class, 'clearGoogleSession']);

Route::get('/participants/create', [ParticipantController::class, 'create']);
Route::post('/participants', [ParticipantController::class, 'store']);
Route::get('/participants', [ParticipantController::class, 'index']);
Route::get('/participants/{participant}', [ParticipantController::class, 'show']);
Route::post('/participants/{shareableId}/mark-shared', [ParticipantController::class, 'markAsShared'])->name('participants.mark-shared');

// ==================== FACEBOOK API ROUTES ====================
Route::prefix('api/facebook')->group(function () {
    // Auto-post to Facebook
    Route::post('/auto-post', [FacebookPostController::class, 'autoPost']);

    // Verify Facebook post
    Route::post('/verify-post', [FacebookPostController::class, 'verifyPost']);

    // Store Facebook access token (from frontend JS SDK)
    Route::post('/store-token', [FacebookPostController::class, 'storeAccessToken']);

    // Get Facebook connection status
    Route::get('/connection-status/{participantId}', [FacebookPostController::class, 'getConnectionStatus']);

    // Manual share confirmation
    Route::post('/confirm-manual-share', [FacebookPostController::class, 'confirmManualShare']);
});


// Test route to verify routes are working
Route::get('/test-routes', function () {
    return response()->json([
        'status' => 'Routes are working!',
        'message' => 'If you see this, your routes are configured correctly'
    ]);
});


// routes/web.php
// routes/web.php
Route::get('/test-webhook-form', function () {
    $testAgent = \App\Models\Agent::whereNotNull('razorpay_order_id')->first();

    if (!$testAgent) {
        return "No agent found.";
    }

    $orderId = $testAgent->razorpay_order_id;
    $csrfToken = csrf_token(); // Get CSRF token

    return "
    <html>
    <body>
        <h1>Webhook Test</h1>
        <p>Testing Order: <b>$orderId</b></p>
        <button onclick='test()'>Test Webhook</button>
        <div id='result'></div>
        
        <script>
        function test() {
            fetch('/razorpay-webhook', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Razorpay-Signature': 'test',
                    'X-CSRF-TOKEN': '$csrfToken' // Add CSRF token
                },
                body: JSON.stringify({
                    event: 'payment.captured',
                    payload: {
                        payment: {
                            entity: {
                                id: 'pay_test_' + Date.now(),
                                order_id: '$orderId',
                                amount: 10000,
                                currency: 'INR'
                            }
                        }
                    }
                })
            })
            .then(r => r.text())
            .then(text => {
                document.getElementById('result').innerHTML = 'Status: ' + r.status + '<br>Response: ' + text;
            })
            .catch(e => {
                document.getElementById('result').innerHTML = 'Error: ' + e.message;
            });
        }
        </script>
    </body>
    </html>
    ";
});




// routes/web.php
Route::get('/test-real-webhook', function () {
    $testAgent = \App\Models\Agent::whereNotNull('razorpay_order_id')
        ->where('payment_status', '!=', 'completed')
        ->first();

    if (!$testAgent) {
        return "No pending agent found. Create a new test payment first.";
    }

    // Get actual order ID from recent test payment
    $orderId = $testAgent->razorpay_order_id;

    // Real Razorpay webhook format
    $webhookData = [
        "event" => "payment.captured",
        "payload" => [
            "payment" => [
                "entity" => [
                    "id" => "pay_" . uniqid(),
                    "entity" => "payment",
                    "amount" => 10000,
                    "currency" => "INR",
                    "status" => "captured",
                    "order_id" => $orderId,
                    "invoice_id" => null,
                    "international" => false,
                    "method" => "card",
                    "amount_refunded" => 0,
                    "refund_status" => null,
                    "captured" => true,
                    "description" => "Agent Registration",
                    "card_id" => "card_" . uniqid(),
                    "bank" => null,
                    "wallet" => null,
                    "vpa" => null,
                    "email" => "test@example.com",
                    "contact" => "+919999999999",
                    "notes" => [
                        "agent_id" => $testAgent->id,
                        "plan_type" => "professional"
                    ],
                    "fee" => 236,
                    "tax" => 36,
                    "error_code" => null,
                    "error_description" => null,
                    "created_at" => time()
                ]
            ]
        ],
        "created_at" => time()
    ];

    // Send to your webhook endpoint
    $client = new \GuzzleHttp\Client();

    try {
        $response = $client->post('https://padosiagents.com/razorpay-webhook', [
            'headers' => [
                'Content-Type' => 'application/json',
                'X-Razorpay-Signature' => 'test_signature_skip_verification'
            ],
            'body' => json_encode($webhookData),
            'timeout' => 10
        ]);

        return "Test sent! Response: " . $response->getStatusCode() . " - " . $response->getBody();
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

// Add this route for testing live 1 rupee payment
Route::get('/test-live-payment-1rs', function () {
    try {
        // Check if we're in live mode
        $key = config('services.razorpay.key');
        $secret = config('services.razorpay.secret');

        // if (strpos($key, 'rzp_live_') !== 0) {
        //     return response()->json([
        //         'error' => 'Not in live mode',
        //         'current_key' => substr($key, 0, 10) . '...',
        //         'message' => 'Switch to live Razorpay keys in .env'
        //     ], 400);
        // }

        // Create a test agent for this payment
        $testAgent = \App\Models\Agent::create([
            'fullname' => 'Test Agent - 1₹',
            'email' => 'test1rs@example.com',
            'mobile' => '9876543210',
            'status' => 'pending_payment',
            'payment_status' => 'pending',
            'selected_plan' => json_encode([
                'type' => 'test',
                'name' => '1 Rupee Test Plan',
                'base_amount' => 0.85, // ₹0.85 (before GST)
                'gst_amount' => 0.15,  // ₹0.15 (18% GST)
                'total_amount' => 1    // ₹1 total
            ]),
            'registration_amount' => 1,
            'registration_step' => 3,
        ]);

        // Store agent ID in session (mimicking your existing flow)
        session(['current_agent_id' => $testAgent->id]);

        // Initialize Razorpay
        $razorpay = new \Razorpay\Api\Api($key, $secret);

        // Create Razorpay order for 1 rupee (100 paise)
        $orderData = [
            'receipt' => 'test_1rs_' . $testAgent->id . '_' . time(),
            'amount' => 100, // 1 rupee = 100 paise
            'currency' => 'INR',
            'payment_capture' => 1,
            'notes' => [
                'agent_id' => $testAgent->id,
                'agent_email' => $testAgent->email,
                'plan_type' => 'test',
                'plan_name' => '1 Rupee Test Payment',
                'purpose' => 'Live Payment Test - ₹1'
            ]
        ];

        $razorpayOrder = $razorpay->order->create($orderData);

        // Update agent with Razorpay order ID
        $testAgent->update([
            'razorpay_order_id' => $razorpayOrder['id']
        ]);

        Log::info('1 Rupee Test Payment initiated for agent: ' . $testAgent->id);

        // Return the checkout page
        return view('payment-test-1rs', [
            'order_id' => $razorpayOrder['id'],
            'amount' => $orderData['amount'],
            'key' => $key,
            'agent_id' => $testAgent->id,
            'name' => $testAgent->fullname,
            'email' => $testAgent->email,
            'mobile' => $testAgent->mobile,
        ]);
    } catch (\Exception $e) {
        Log::error('1 Rupee Test Payment Error: ' . $e->getMessage());

        return response()->json([
            'error' => 'Payment setup failed',
            'message' => $e->getMessage()
        ], 500);
    }
});

// routes/api.php
// Route::prefix('api')->group(function () {
//     Route::get('/agents/nearby', [AgentController::class, 'getNearbyAgents']);
//     Route::post('/pincodes/preload', [AgentController::class, 'preloadCommonPincodes']);

//     // Test endpoint
//     Route::get('/test/{pincode}', function ($pincode) {
//         $service = app(\App\Services\PincodeService::class);
//         $details = $service->getPincodeDetails($pincode);
//         $nearby = $service->getNearbyPincodes($pincode, 100);

//         return response()->json([
//             'pincode_details' => $details,
//             'nearby_100km' => $nearby
//         ]);
//     });
// });

// routes/api.php
use App\Http\Controllers\Api\PincodeController;

Route::prefix('api')->group(function () {
    // Existing routes
    Route::get('/agents/nearby', [AgentController::class, 'getNearbyAgents']);
    Route::post('/pincodes/preload', [AgentController::class, 'preloadCommonPincodes']);

    // NEW: Pincode insertion/update routes
    Route::get('/pincode/fetch/{pincode}', [PincodeController::class, 'fetchAndStore']);
    Route::post('/pincode/bulk-fetch', [PincodeController::class, 'bulkFetchAndStore']);
    Route::post('/pincode/update-coordinates', [PincodeController::class, 'updateCoordinates']);

    // Test endpoint (updated)
    Route::get('/test/{pincode}', [PincodeController::class, 'testPincode']);

    // routes/web.php
    Route::get('/api-speed-test', function () {
        return view('api-speed-test');
    });
});

Route::get('/test-mail-api', function () {
    try {
        $email = (new MailtrapEmail())
            ->from(new Address('hello@padosiagents.com', 'Mailtrap Test'))
            ->to(new Address('padosiagent067@gmail.com'))
            ->subject('You are awesome!')
            ->category('Integration Test')
            ->text('Congrats for sending test email with Mailtrap!')
        ;

        $response = MailtrapClient::initSendingEmails(
            apiKey: env('MAILTRAP_API_TOKEN')
        )->send($email);

        return ResponseHelper::toArray($response);
    } catch (\Exception $e) {
        return [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
    }
});
