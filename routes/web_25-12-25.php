<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentRegistrationController;
use App\Http\Controllers\ComingSoonController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\FacebookPostController;
use App\Http\Controllers\ContactController;



// Default landing page - Coming Soon
Route::get('/', [ComingSoonController::class, 'index'])->name('coming.soon');

// Contact Us Routes
Route::post('/contact/submit', [ContactController::class, 'store'])->name('contact.submit');


// Optional: You can also make it available at /coming-soon
Route::get('/coming-soon', [ComingSoonController::class, 'index']);
Route::get('/terms', function () {
    return view('terms');
});
Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/chooseplan', function () {
    return view('plans');
});

// Agent Registration Routes (keep these as they are)
Route::get('/agent-registration', [AgentRegistrationController::class, 'showRegistrationForm'])->name('agent.registration');

// Update these routes to match your subdirectory structure
Route::post('/agent-register-step1', [AgentRegistrationController::class, 'registerStep1'])->name('agent.register.step1');
Route::post('/agent-register-step2', [AgentRegistrationController::class, 'registerStep2'])->name('agent.register.step2');
Route::post('/agent-register-complete', [AgentRegistrationController::class, 'completeRegistration'])->name('agent.register.complete');
Route::post('/payment-success', [AgentRegistrationController::class, 'handlePaymentSuccess'])->name('payment.success');

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
Route::get('/test-webhook-form', function() {
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
Route::get('/test-real-webhook', function() {
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