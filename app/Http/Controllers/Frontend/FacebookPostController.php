<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FacebookPostController extends Controller
{
    private $appId;
    private $appSecret;

    public function __construct()
    {
        $this->appId = config('services.facebook.client_id', '759405373797845');
        $this->appSecret = config('services.facebook.client_secret');
    }

    /**
     * Auto-post to Facebook for a participant
     */
    public function autoPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'participant_id' => 'required|exists:participants,id',
            'message' => 'required|string',
            'link' => 'required|url'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $participant = Participant::find($request->participant_id);

            // Check if participant has Facebook access token
            if (empty($participant->facebook_access_token)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Facebook not connected. Please connect Facebook first.',
                    'action_required' => 'facebook_connect'
                ], 400);
            }

            // Create post on Facebook
            $postResponse = Http::post('https://graph.facebook.com/v19.0/me/feed', [
                'message' => $request->message,
                'link' => $request->link,
                'access_token' => $participant->facebook_access_token
            ]);

            $result = $postResponse->json();

            if (isset($result['id'])) {
                // Success - update participant status
                $participant->update([
                    'status' => 'completed',
                    'facebook_post_id' => $result['id']
                ]);

                Log::info('Facebook auto-post successful', [
                    'participant_id' => $participant->id,
                    'facebook_post_id' => $result['id']
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Post created successfully on Facebook!',
                    'post_id' => $result['id'],
                    'post_url' => "https://facebook.com/{$result['id']}"
                ]);
            } else {
                // Handle Facebook API error
                $errorMessage = $result['error']['message'] ?? 'Unknown Facebook error';

                Log::error('Facebook auto-post failed', [
                    'participant_id' => $participant->id,
                    'error' => $errorMessage
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Facebook posting failed: ' . $errorMessage,
                    'facebook_error' => $result['error'] ?? null
                ], 400);
            }
        } catch (\Exception $e) {
            Log::error('Auto-post exception', [
                'participant_id' => $request->participant_id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Auto-post failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verify if a Facebook post exists and is public
     */
    public function verifyPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'participant_id' => 'required|exists:participants,id',
            'post_id' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $participant = Participant::find($request->participant_id);

            if (empty($participant->facebook_access_token)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Facebook not connected'
                ], 400);
            }

            // Verify post using Facebook Graph API
            $response = Http::get("https://graph.facebook.com/v19.0/{$request->post_id}", [
                'fields' => 'id,message,created_time,privacy,is_published',
                'access_token' => $participant->facebook_access_token
            ]);

            $postData = $response->json();

            if (isset($postData['error'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Post not found: ' . $postData['error']['message']
                ], 404);
            }

            // Check if post is public
            $isPublic = isset($postData['privacy']['value']) &&
                $postData['privacy']['value'] === 'EVERYONE';

            $isPublished = $postData['is_published'] ?? false;

            // Update participant status if post is verified
            if ($isPublished) {
                $participant->update(['status' => 'verified']);
            }

            Log::info('Facebook post verification', [
                'participant_id' => $participant->id,
                'post_id' => $request->post_id,
                'is_public' => $isPublic,
                'is_published' => $isPublished
            ]);

            return response()->json([
                'success' => true,
                'post' => $postData,
                'is_public' => $isPublic,
                'is_published' => $isPublished,
                'verification_status' => $isPublished ? 'verified' : 'pending'
            ]);
        } catch (\Exception $e) {
            Log::error('Post verification failed', [
                'participant_id' => $request->participant_id,
                'post_id' => $request->post_id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Verification failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store Facebook access token for participant (from frontend JS SDK)
     */
    public function storeAccessToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'participant_id' => 'required|exists:participants,id',
            'access_token' => 'required|string',
            'user_id' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $participant = Participant::find($request->participant_id);

            // Validate the access token by making a simple API call
            $validationResponse = Http::get('https://graph.facebook.com/v19.0/me', [
                'fields' => 'id,name',
                'access_token' => $request->access_token
            ]);

            if (!$validationResponse->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid access token'
                ], 400);
            }

            $userData = $validationResponse->json();

            // Store the access token and user info
            $participant->update([
                'facebook_access_token' => $request->access_token,
                'facebook_user_id' => $userData['id'],
                'name' => $userData['name'] ?? $participant->name,
                'status' => 'connected'
            ]);

            Log::info('Facebook access token stored', [
                'participant_id' => $participant->id,
                'facebook_user_id' => $userData['id']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Facebook connected successfully!',
                'user' => $userData
            ]);
        } catch (\Exception $e) {
            Log::error('Error storing Facebook access token', [
                'participant_id' => $request->participant_id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to connect Facebook: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get participant's Facebook connection status
     */
    public function getConnectionStatus($participantId)
    {
        try {
            $participant = Participant::find($participantId);

            if (!$participant) {
                return response()->json([
                    'success' => false,
                    'message' => 'Participant not found'
                ], 404);
            }

            $isConnected = !empty($participant->facebook_access_token) &&
                !empty($participant->facebook_user_id);

            $status = [
                'connected' => $isConnected,
                'facebook_user_id' => $participant->facebook_user_id,
                'participant_status' => $participant->status,
                'has_posted' => !empty($participant->facebook_post_id)
            ];

            return response()->json([
                'success' => true,
                'data' => $status
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting connection status', [
                'participant_id' => $participantId,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to get connection status'
            ], 500);
        }
    }

    /**
     * Manual share confirmation (when auto-post fails)
     */
    public function confirmManualShare(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'participant_id' => 'required|exists:participants,id',
            'post_url' => 'required|url',
            'screenshot' => 'nullable|image|mimes:jpeg,png,jpg|max:5120'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $participant = Participant::find($request->participant_id);

            $screenshotPath = null;
            if ($request->hasFile('screenshot')) {
                $screenshotPath = $request->file('screenshot')->store('screenshots', 'public');
            }

            // Extract post ID from URL if possible
            $postId = $this->extractPostIdFromUrl($request->post_url);

            // Update participant with manual share info
            $updateData = [
                'status' => 'completed',
                'facebook_post_url' => $request->post_url,
                'manual_share' => true
            ];

            if ($postId) {
                $updateData['facebook_post_id'] = $postId;
            }

            if ($screenshotPath) {
                $updateData['screenshot_path'] = $screenshotPath;
            }

            $participant->update($updateData);

            Log::info('Manual share confirmed', [
                'participant_id' => $participant->id,
                'post_url' => $request->post_url
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Manual share confirmed successfully!',
                'data' => [
                    'screenshot_url' => $screenshotPath ? asset('storage/' . $screenshotPath) : null,
                    'post_url' => $request->post_url
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error confirming manual share', [
                'participant_id' => $request->participant_id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to confirm manual share: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Extract post ID from Facebook URL
     */
    private function extractPostIdFromUrl($url)
    {
        // Handle different Facebook URL formats
        $patterns = [
            '/facebook\.com\/.+\/posts\/(\d+)/',
            '/facebook\.com\/.+\/activity\/(\d+)/',
            '/facebook\.com\/photo\.php\?fbid=(\d+)/',
            '/facebook\.com\/permalink\.php\?story_fbid=(\d+)&/'
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }
}
