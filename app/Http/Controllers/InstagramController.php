<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class InstagramController extends Controller
{
    public function showForm()
    {
        //phpinfo();

        // $response = Http::withoutVerifying()->get("https://graph.facebook.com/v20.0/865788953282510", [
        //     'fields' => 'connected_instagram_account,instagram_business_account',
        //     'access_token' => env('FB_ACCESS_TOKEN'),
        // ]);

        // dd($response->json());

        return view('instagram_form');
    }

    public function publish(Request $request)
    {
        $request->validate([
            'caption' => 'nullable|string|max:2200',
            'image' => 'required|image|max:10240', // Max 10MB
        ]);

        $caption = $request->input('caption');

        // Store uploaded image publicly
        $path = $request->file('image')->store('uploads', 'public');
        $publicUrl = asset('storage/' . $path);

        // Read from .env
        $accessToken = env('FB_ACCESS_TOKEN');
        $instagramBusinessId = env('IG_BUSINESS_ID');
        $facebookPageId = env('FB_PAGE_ID');
        $apiVersion = 'v20.0';

        // Check required configs
        if (!$accessToken || !$instagramBusinessId || !$facebookPageId) {
            return back()->with('error', 'Missing required environment variables (FB_ACCESS_TOKEN, FB_PAGE_ID, IG_BUSINESS_ID)');
        }

        // Optional: Verify Page–Instagram connection before posting
        $verifyResp = Http::withoutVerifying()->get("https://graph.facebook.com/{$apiVersion}/865788953282510", [
            'fields' => 'instagram_business_account',
            'access_token' => $accessToken,
        ]);

        if ($verifyResp->failed()) {
            return back()->with('error', 'Failed to verify Page-Instagram connection: ' . $verifyResp->body());
        }

        $verifyJson = $verifyResp->json();
        $linkedIgId = $verifyJson['instagram_business_account']['id'] ?? null;

        if ($linkedIgId && $linkedIgId !== $instagramBusinessId) {
            return back()->with('error', 'Configured IG_BUSINESS_ID does not match the account linked to this Page.');
        }

        // Step 1: Create media container
        // $createResp = Http::asForm()->post("https://graph.facebook.com/{$apiVersion}/{$instagramBusinessId}/media", [
        //     'image_url' => $publicUrl,
        //     'caption' => $caption,
        //     'access_token' => $accessToken,
        // ]);

        // $createResp = Http::withoutVerifying()
        //     ->asForm()
        //     ->post("https://graph.facebook.com/{$apiVersion}/{$instagramBusinessId}/media", [
        //         'image_url' => $publicUrl,
        //         'caption' => $caption,
        //         'access_token' => $accessToken,
        //     ]);

        $createResp = Http::withoutVerifying()
            ->asForm()
            ->post("https://graph.facebook.com/{$apiVersion}/{$instagramBusinessId}/media", [
                'image_url' => 'https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d',
                'caption' => 'Testing Instagram upload!',
                'access_token' => $accessToken,
            ]);


        if ($createResp->failed()) {
            return back()->with('error', 'Failed to create media container: ' . $createResp->body());
        }

        $createJson = $createResp->json();
        $creationId = $createJson['id'] ?? null;

        if (!$creationId) {
            return back()->with('error', 'No creation_id returned from Facebook: ' . json_encode($createJson));
        }

        // Step 2: Publish media
        // $publishResp = Http::asForm()->post("https://graph.facebook.com/{$apiVersion}/{$instagramBusinessId}/media_publish", [
        //     'creation_id' => $creationId,
        //     'access_token' => $accessToken,
        // ]);
        $publishResp = Http::withoutVerifying()
            ->asForm()
            ->post("https://graph.facebook.com/{$apiVersion}/{$instagramBusinessId}/media_publish", [
                'creation_id' => $creationId,
                'access_token' => $accessToken,
            ]);

        if ($publishResp->failed()) {
            return back()->with('error', 'Failed to publish media: ' . $publishResp->body());
        }

        $publishJson = $publishResp->json();

        return back()->with('success', 'Post published successfully! Response: ' . json_encode($publishJson));
    }
}
