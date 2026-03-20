<?php
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\InstagramController;

// Route::get('/', function () {
//     return redirect('/admin/instagram');
// });

// Route::get('/admin/instagram', [InstagramController::class, 'showForm'])->name('instagram.form');
// Route::post('/admin/instagram', [InstagramController::class, 'publish'])->name('instagram.publish');

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentRegistrationController;

// Route::get('/', function () {
//     return redirect('/agent-registration');
// });

// // routes/web.php
// Route::get('/check-razorpay-config', [AgentRegistrationController::class, 'checkConfig']);
// //Visit: http://localhost:8000/check-razorpay-config

// Route::get('/agent-registration', [AgentRegistrationController::class, 'showRegistrationForm'])->name('agent.registration');
// Route::post('/agent-register', [AgentRegistrationController::class, 'register'])->name('agent.register');
// Route::post('/payment-success', [AgentRegistrationController::class, 'handlePaymentSuccess'])->name('payment.success');


// routes/web.php

Route::get('/', function () {
    return redirect('/agent-registration');
});

Route::get('/agent-registration', [AgentRegistrationController::class, 'showRegistrationForm'])->name('agent.registration');
Route::post('/agent-register', [AgentRegistrationController::class, 'register'])->name('agent.register');
Route::post('/initiate-payment', [AgentRegistrationController::class, 'initiatePayment'])->name('initiate.payment');
Route::post('/payment-success', [AgentRegistrationController::class, 'handlePaymentSuccess'])->name('payment.success');
Route::get('/check-razorpay-config', [AgentRegistrationController::class, 'checkConfig']);
