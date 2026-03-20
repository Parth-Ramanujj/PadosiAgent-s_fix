<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AgentRegistrationController extends Controller
{
    private $razorpay;

    public function __construct()
    {
        // Add validation for Razorpay keys
        if (empty(env('RAZORPAY_KEY')) || empty(env('RAZORPAY_SECRET'))) {
            throw new \Exception('Razorpay keys are not configured');
        }

        $this->razorpay = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    }

    public function showRegistrationForm()
    {
        // Check if Razorpay keys are set
        $razorpayKey = env('RAZORPAY_KEY');

        if (empty($razorpayKey) || $razorpayKey === 'your_razorpay_key_here') {
            return view('agent-registration')->with('error', 'Razorpay configuration missing');
        }

        return view('agent-registration');
    }

    public function register(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:agents,email',
            'mobile' => 'required|digits:10',
            'dob' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'profession' => 'required|in:LIC Agent,CA,Lawyer,Vehicle Insurance,Health Insurance',
            'company' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'experience' => 'nullable|string',
            'photo' => 'image|max:2048',
            'idproof' => 'file|mimes:png,jpg,jpeg,pdf|max:2048',
        ]);

        try {
            // Handle file uploads
            $photoPath = $request->file('photo')->store('agent-photos', 'public');
            $idproofPath = $request->file('idproof')->store('agent-idproofs', 'public');

            // Create agent record
            $agent = Agent::create(array_merge($validated, [
                'photo_path' => $photoPath,
                'idproof_path' => $idproofPath,
            ]));

            // Create Razorpay order - ₹2,000 in paise (2000 * 100 = 200000)
            $orderData = [
                'receipt' => 'agent_' . $agent->id,
                'amount' => 200000, // 2000 rupees in paise
                'currency' => 'INR',
                'payment_capture' => 1, // Auto capture payment
                'notes' => [
                    'agent_id' => $agent->id,
                    'purpose' => 'Agent Registration Fee'
                ]
            ];

            $razorpayOrder = $this->razorpay->order->create($orderData);

            // Update agent with Razorpay order ID
            $agent->update([
                'razorpay_order_id' => $razorpayOrder['id']
            ]);

            Log::info('Razorpay order created', ['order_id' => $razorpayOrder['id'], 'agent_id' => $agent->id]);

            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder['id'],
                'amount' => $orderData['amount'],
                'currency' => $orderData['currency'],
                'key' => env('RAZORPAY_KEY'),
                'agent_id' => $agent->id,
                'name' => $agent->fullname,
                'email' => $agent->email,
                'mobile' => $agent->mobile,
                'prefill' => [
                    'name' => $agent->fullname,
                    'email' => $agent->email,
                    'contact' => $agent->mobile
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Registration failed', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Registration failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function handlePaymentSuccess(Request $request)
    {
        $validated = $request->validate([
            'razorpay_payment_id' => 'required',
            'razorpay_order_id' => 'required',
            'razorpay_signature' => 'required',
            'agent_id' => 'required|exists:agents,id'
        ]);

        try {
            $attributes = [
                'razorpay_order_id' => $validated['razorpay_order_id'],
                'razorpay_payment_id' => $validated['razorpay_payment_id'],
                'razorpay_signature' => $validated['razorpay_signature']
            ];

            // Verify payment signature
            $this->razorpay->utility->verifyPaymentSignature($attributes);

            // Update agent payment status
            $agent = Agent::find($validated['agent_id']);
            $agent->update([
                'razorpay_payment_id' => $validated['razorpay_payment_id'],
                'razorpay_signature' => $validated['razorpay_signature'],
                'payment_status' => 'completed'
            ]);

            Log::info('Payment successful', [
                'agent_id' => $agent->id,
                'payment_id' => $validated['razorpay_payment_id']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payment successful! Registration completed.',
                'payment_id' => $validated['razorpay_payment_id']
            ]);
        } catch (\Exception $e) {
            Log::error('Payment verification failed', [
                'error' => $e->getMessage(),
                'agent_id' => $validated['agent_id']
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed: ' . $e->getMessage()
            ], 400);
        }
    }

    // Add a method to check Razorpay configuration
    public function checkConfig()
    {
        return response()->json([
            'razorpay_key_set' => !empty(env('RAZORPAY_KEY')),
            'razorpay_secret_set' => !empty(env('RAZORPAY_SECRET')),
            'key_prefix' => substr(env('RAZORPAY_KEY'), 0, 8)
        ]);
    }
}
