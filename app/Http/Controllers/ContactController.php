<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
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

            // Check if email already exists recently (last 24 hours)
            $recentSubmission = ContactSubmission::where('email', $request->email)
                ->where('created_at', '>', now()->subDay())
                ->first();

            if ($recentSubmission) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have already submitted a contact request in the last 24 hours. Please wait before submitting another request.'
                ], 422);
            }

            // Generate reference ID
            $referenceId = ContactSubmission::generateReferenceId();

            // Create contact submission
            $contact = ContactSubmission::create([
                'reference_id' => $referenceId,
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'company' => $request->company,
                'subject' => $request->subject,
                'message' => $request->message,
                'status' => 'pending'
            ]);

            Log::info('CONTACT FORM SUBMISSION - Contact created: ' . $contact->id, [
                'reference_id' => $contact->reference_id,
                'email' => $contact->email
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your message has been sent successfully. We will get back to you soon.',
                'reference_id' => $contact->reference_id
            ], 201);
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

    /**
     * Get contact submission by reference ID
     */
    public function show($referenceId): JsonResponse
    {
        try {
            $contact = ContactSubmission::where('reference_id', $referenceId)->firstOrFail();

            return response()->json([
                'success' => true,
                'contact' => $contact
            ]);
        } catch (\Exception $e) {
            Log::error('CONTACT SHOW - Error: ' . $e->getMessage(), [
                'reference_id' => $referenceId
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Contact submission not found.'
            ], 404);
        }
    }

    /**
     * Update contact status
     */
    public function updateStatus(Request $request, $referenceId): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => 'required|in:pending,read,replied,closed'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid status.',
                    'errors' => $validator->errors()
                ], 422);
            }

            $contact = ContactSubmission::where('reference_id', $referenceId)->firstOrFail();

            $contact->update([
                'status' => $request->status
            ]);

            Log::info('CONTACT STATUS UPDATE - Updated: ' . $referenceId, [
                'status' => $request->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Contact status updated successfully.',
                'contact' => $contact
            ]);
        } catch (\Exception $e) {
            Log::error('CONTACT STATUS UPDATE - Error: ' . $e->getMessage(), [
                'reference_id' => $referenceId
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update contact status.'
            ], 500);
        }
    }
}
