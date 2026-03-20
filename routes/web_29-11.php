<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentRegistrationController;
use App\Http\Controllers\ComingSoonController;
use App\Http\Controllers\ParticipantController;


// Default landing page - Coming Soon
Route::get('/', [ComingSoonController::class, 'index'])->name('coming.soon');

// Optional: You can also make it available at /coming-soon
Route::get('/coming-soon', [ComingSoonController::class, 'index']);

// Agent Registration Routes (keep these as they are)
Route::get('/agent-registration', [AgentRegistrationController::class, 'showRegistrationForm'])->name('agent.registration');

// Update these routes to match your subdirectory structure
Route::post('/agent-register-step1', [AgentRegistrationController::class, 'registerStep1'])->name('agent.register.step1');
Route::post('/agent-register-step2', [AgentRegistrationController::class, 'registerStep2'])->name('agent.register.step2');
Route::post('/agent-register-complete', [AgentRegistrationController::class, 'completeRegistration'])->name('agent.register.complete');
Route::post('/payment-success', [AgentRegistrationController::class, 'handlePaymentSuccess'])->name('payment.success');

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


// Test route to verify routes are working
Route::get('/test-routes', function () {
    return response()->json([
        'status' => 'Routes are working!',
        'message' => 'If you see this, your routes are configured correctly'
    ]);
});
