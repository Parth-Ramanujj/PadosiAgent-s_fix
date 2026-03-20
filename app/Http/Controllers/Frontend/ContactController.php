<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Exception;

class ContactController extends Controller
{
    /**
     * Store a new contact submission
     */
    public function store(Request $request): JsonResponse
    {
        Log::info('CONTACT FORM SUBMISSION - Received data:', $request->all());

        try {
            // Validation rules
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|min:2|max:100',
                'mobile' => 'required|string|regex:/^[0-9]{10}$/',
                'email' => 'required|email|max:100',
                'company' => 'nullable|string|max:100',
                'subject' => 'required|string|min:5|max:100',
                'message' => 'required|string|min:10|max:1000',
            ], [
                'mobile.regex' => 'Please enter a valid 10-digit mobile number',
                'subject.min' => 'Subject must be at least 5 characters',
                'subject.max' => 'Subject must be less than 100 characters',
                'message.min' => 'Message must be at least 10 characters',
                'message.max' => 'Message must be less than 1000 characters',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please fix the validation errors below.',
                    'errors' => $validator->errors()
                ], 422);
            }

            $toEmail = 'support@padosiagent.com';
            //$toEmail = 'vims81122@gmail.com';
            $subject = 'New Contact Message: ' . $request->subject;
            $body = "You received a new contact message.\n\n"
                . "Name: {$request->name}\n"
                . "Email: {$request->email}\n"
                . "Mobile: {$request->mobile}\n"
                . "Company: " . ($request->company ?: 'N/A') . "\n"
                . "Subject: {$request->subject}\n\n"
                . "Message:\n{$request->message}\n";

            Mail::raw($body, function ($message) use ($toEmail, $subject, $request) {
                $message->to($toEmail)
                    ->subject($subject)
                    ->replyTo($request->email, $request->name);
            });

            Log::info('CONTACT FORM SUBMISSION - Email sent', [
                'to' => $toEmail,
                'from' => $request->email,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your message has been sent successfully. We will get back to you soon.'
            ], 200);
        } catch (ValidationException $e) {
            Log::error('CONTACT FORM SUBMISSION - Validation Error: ' . json_encode($e->errors()));
            return response()->json([
                'success' => false,
                'message' => 'Please fix the validation errors below.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('CONTACT FORM SUBMISSION - Error: ' . $e->getMessage());
            Log::error('CONTACT FORM SUBMISSION - Trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Failed to submit your message. Please try again.'
            ], 500);
        }
    }

}
