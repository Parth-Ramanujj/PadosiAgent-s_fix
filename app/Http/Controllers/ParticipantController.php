<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Exception;

class ParticipantController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        Log::info('PARTICIPANT REGISTRATION - Received data:', $request->all());

        try {
            // Basic validation (remove unique rule from here)
            $request->validate([
                'full_name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone_number' => 'required|string|max:20',
                'have_insurance' => 'required|in:yes,no',
                'mutual_fund' => 'required|in:yes,no',
            ]);

            // Check if email already exists (manual unique check)
            $existingEmail = Participant::where('email', $request->email)->first();
            if ($existingEmail) {
                return response()->json([
                    'success' => false,
                    'message' => 'This email address is already registered.'
                ], 422);
            }

            // Check if phone number already exists
            $existingPhone = Participant::where('phone_number', $request->phone_number)->first();
            if ($existingPhone) {
                return response()->json([
                    'success' => false,
                    'message' => 'This phone number is already registered.'
                ], 422);
            }

            // Prepare data - use 'No' instead of false
            $participantData = [
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'have_insurance' => $request->have_insurance,
                'mutual_fund' => $request->mutual_fund,
                'thank_my_padosi' => $request->thank_my_Padosi,
                'thank_my_padosi_for' => $request->thank_my_Padosi_for,
                'shareable_id' => uniqid('part_'),
                'registration_completed_at' => now(),
                'participant_shared' => 'No' // Use 'No' for ENUM
            ];

            // Handle insurance data
            if ($request->have_insurance === 'yes') {
                $participantData['insurance_products'] = $request->products ?: [];
                $participantData['insurance_planning'] = null;
            } else {
                $participantData['insurance_products'] = null;
                $participantData['insurance_planning'] = $request->planning;
            }

            // Handle mutual fund data
            if ($request->mutual_fund === 'no') {
                $participantData['mf_plan'] = $request->mf_plan;
            } else {
                $participantData['mf_plan'] = null;
            }

            // Create participant
            $participant = Participant::create($participantData);

            // Generate share URL
            $shareUrl = url('/participants/share/' . $participant->shareable_id);

            Log::info('PARTICIPANT REGISTRATION - Participant created: ' . $participant->id);

            return response()->json([
                'success' => true,
                'message' => 'Registration completed successfully!',
                'participant' => $participant,
                'shareable_id' => $participant->shareable_id,
                'share_url' => $shareUrl
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('PARTICIPANT REGISTRATION - Validation Error: ' . json_encode($e->errors()));
            return response()->json([
                'success' => false,
                'message' => 'Please fix the validation errors below.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('PARTICIPANT REGISTRATION - Error: ' . $e->getMessage());
            Log::error('PARTICIPANT REGISTRATION - Trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Registration failed. Please try again.'
            ], 500);
        }
    }

    /**
     * Share participant page
     */
    public function share($shareableId)
    {
        try {
            $participant = Participant::where('shareable_id', $shareableId)->firstOrFail();

            Log::info('PARTICIPANT SHARE - Page accessed: ' . $shareableId);

            return view('participants.share', compact('participant'));
        } catch (\Exception $e) {
            Log::error('PARTICIPANT SHARE - Error: ' . $e->getMessage(), [
                'shareable_id' => $shareableId
            ]);

            abort(404, 'Participant not found');
        }
    }

    /**
     * Mark participant as shared
     */
    /**
     * Mark participant as shared
     */
    public function markAsShared($shareableId): JsonResponse
    {
        try {
            $participant = Participant::where('shareable_id', $shareableId)->firstOrFail();

            // Check if already shared
            if ($participant->participant_shared === 'Yes') {
                return response()->json([
                    'success' => true,
                    'message' => 'Already confirmed!'
                ]);
            }

            // Update to 'Yes' for ENUM
            $participant->update([
                'participant_shared' => 'Yes'
            ]);

            Log::info('PARTICIPANT SHARED - Updated to Yes: ' . $shareableId, [
                'participant_id' => $participant->id,
                'email' => $participant->email
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for sharing! Your participation has been confirmed.'
            ]);
        } catch (\Exception $e) {
            Log::error('PARTICIPANT SHARED - Error: ' . $e->getMessage(), [
                'shareable_id' => $shareableId
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to confirm your post. Please try again.'
            ], 500);
        }
    }
}
