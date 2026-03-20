<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Agent;
use App\Models\AgentProfile;
use App\Models\AgentPerformanceStat;
use App\Models\AgentFamilyLicense;
use App\Models\AgentInsuranceSegment;
use App\Models\AgentPortfolio;
use App\Models\AgentAchievementPhoto;
use App\Models\AgentLeadPreference;
use App\Models\City;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AgentProfileController extends Controller
{
    public function edit()
    {
        $agent = auth()->user()->agent->load([
            'profile',
            'performanceStats',
            'familyLicenses',
            'insuranceSegments',
            'portfolios',
            'achievementPhotos',
            'leadPreferences',
            'serviceableCities'
        ]);
        return view('agent.edit-profile', compact('agent'));
    }

    public function update(Request $request)
    {
        Log::info('Agent profile update started', [
            'agent_id' => auth()->user()->agent->id,
            'step' => $request->current_step
        ]);

        $stepRules = [
            1 => [
                'full_name' => 'required|string|max:255',
                'display_name' => 'nullable|string|max:255',
                'mobile' => 'required|string|max:20',
                'whatsapp' => 'nullable|string|max:20',
                'email' => 'required|email|max:255',
                'languages' => 'required|string',
                'address' => 'required|string',
                'profile_photo' => 'nullable|image|max:5120', // Max 5MB
            ],
            2 => [
                'pan' => 'nullable|string|size:10',
                'license' => 'nullable|string|max:100',
                'agency_name' => 'nullable|string|max:255',
                'office_address' => 'nullable|string',
                'service_pincode' => 'required|string|size:6',
                'serviceable_cities' => 'required|array|min:1',
                'experience_years' => 'required|numeric|min:0',
                'client_base' => 'required|string|max:100',
            ],
            3 => [
                'segments' => 'required|array|min:1',
            ],
            4 => [
                'portfolio' => 'required|array',
            ],
            5 => [
                'website' => 'nullable|url',
                'google_business' => 'nullable|url',
                'linkedin_url' => 'nullable|url',
                'instagram_url' => 'nullable|url',
                'facebook_url' => 'nullable|url',
                'youtube_url' => 'nullable|url',
            ],
            6 => [
                'lead_types' => 'required|array',
            ],
            7 => [
                 'final_declaration' => 'accepted'
            ]
        ];

        // determine if this is a step save or full save
        $currentStep = $request->input('current_step');

        if ($currentStep) {
            // Partial Validation
            $rules = $stepRules[$currentStep] ?? [];
        } else {
            // Full Validation (Merge all rules)
            $rules = [];
            foreach ($stepRules as $step => $r) {
                $rules = array_merge($rules, $r);
            }
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $agent = auth()->user()->agent;
            $profile = $agent->profile ?: new AgentProfile(['agent_id' => $agent->id]);

            // Helper to check if we should process a block
            $shouldProcess = function($step) use ($currentStep) {
                return !$currentStep || $currentStep == $step;
            };

            // Step 1: Basic Info
            if ($shouldProcess(1)) {
                $agent->update([
                    'fullname' => $request->full_name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                ]);
                
                $profile->fill([
                    'display_name' => $request->display_name,
                    'whatsapp' => $request->whatsapp,
                    'languages' => $request->languages,
                    'address' => $request->address,
                ]);
                
                if ($request->hasFile('profile_photo')) {
                    // Delete old photo if it exists
                    if ($profile->profile_photo_path && Storage::disk('public')->exists($profile->profile_photo_path)) {
                        Storage::disk('public')->delete($profile->profile_photo_path);
                    }
                    
                    // Store new photo
                    $file = $request->file('profile_photo');
                    // Generate a unique filename to prevent caching issues or conflicts
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('agent/profiles', $filename, 'public');
                    
                    $profile->profile_photo_path = $path;
                }
                
                $profile->save();
            }

            // Step 2: Professional
            if ($shouldProcess(2)) {
                $profile->fill([
                    'pan_number' => $request->pan,
                    'license_number' => $request->license,
                    'agency_name' => $request->agency_name,
                    'office_address' => $request->office_address,
                    'service_pincode' => $request->service_pincode,
                    'has_pos_license' => $request->has('has_pos_license') ? 1 : 0,
                ]);
                $profile->save();

                // Update Agent table for Experience and Client Base
                $agent->update([
                    'experience_range' => $request->experience_years,
                    'client_base' => $request->client_base,
                ]);

                // Family Licenses
                if ($request->has('family_members')) {
                    $agent->familyLicenses()->delete();
                    foreach ($request->family_members as $member) {
                        if (!empty($member['name'])) {
                            $agent->familyLicenses()->create([
                                'name' => $member['name'],
                                'relationship' => $member['relationship'],
                                'license_number' => $member['license'],
                            ]);
                        }
                    }
                }
                
                // Performance Stats
                AgentPerformanceStat::updateOrCreate(
                    ['agent_id' => $agent->id],
                    [
                        'claims_processed' => $request->claims_processed,
                        'claims_settled' => $request->claims_settled,
                        'claims_amount' => $request->claims_amount,
                        'success_rate' => $request->success_rate,
                        'response_time' => $request->response_time,
                    ]
                );

                // Serviceable Cities
                $cityIds = [];
                if ($request->has('serviceable_cities')) {
                    foreach ($request->serviceable_cities as $cityName) {
                        $city = City::firstOrCreate(['name' => $cityName]);
                        $cityIds[] = $city->id;
                    }
                     $agent->serviceableCities()->sync($cityIds);
                }
            }

            // Step 3: Insurance Segments
            if ($shouldProcess(3) && $request->has('segments')) {
                $agent->insuranceSegments()->delete();
                foreach ($request->segments as $segmentType) {
                    $agent->insuranceSegments()->create(['segment_type' => $segmentType]);
                }
            }

            // Step 4: Portfolios
            if ($shouldProcess(4) && $request->has('portfolio')) {
                $agent->portfolios()->delete();
                foreach ($request->portfolio as $segmentType => $portfolioData) {
                    if (!empty($portfolioData['primary_company'])) {
                        $agent->portfolios()->create([
                            'segment_type' => $segmentType,
                            'primary_companies' => [
                                'name' => $portfolioData['primary_company'],
                                'percentage' => $portfolioData['primary_percent']
                            ],
                            'secondary_companies' => [
                                'name' => $portfolioData['secondary_company'],
                                'percentage' => $portfolioData['secondary_percent'],
                                'others' => $portfolioData['other_companies'] ?? ''
                            ]
                        ]);
                    }
                }
            }

            // Step 5: Additional
            if ($shouldProcess(5)) {
                $profile->fill([
                    'website_url' => $request->website,
                    'social_links' => [
                        'google_business' => $request->google_business,
                        'linkedin' => $request->linkedin_url,
                        'instagram' => $request->instagram_url,
                        'facebook' => $request->facebook_url,
                        'youtube' => $request->youtube_url,
                    ],
                    'career_highlights' => $request->career_highlights,
                ]);
                $profile->save();

                 // Handle Achievement Photos
                if ($request->has('remove_photos')) {
                    foreach ($request->remove_photos as $photoId) {
                        $photo = AgentAchievementPhoto::where('agent_id', $agent->id)->find($photoId);
                        if ($photo) {
                            Storage::disk('public')->delete($photo->photo_path);
                            $photo->delete();
                        }
                    }
                }

                if ($request->hasFile('achievement_photos')) {
                    foreach ($request->file('achievement_photos') as $photoFile) {
                        $path = $photoFile->store('agent/achievements', 'public');
                        $agent->achievementPhotos()->create(['photo_path' => $path]);
                    }
                }
            }

            // Step 6: Lead Preferences
            if ($shouldProcess(6)) {
                AgentLeadPreference::updateOrCreate(
                    ['agent_id' => $agent->id],
                    [
                        'leads_new_business' => in_array('new_business', $request->lead_types ?? []),
                        'leads_portfolio_analysis' => in_array('portfolio_analysis', $request->lead_types ?? []),
                        'portfolio_charging' => $request->portfolio_charging,
                        'portfolio_fee' => in_array($request->portfolio_charging, ['conditional', 'paid']) 
                            ? ($request->portfolio_charging == 'conditional' ? $request->portfolio_fee_conditional : $request->portfolio_fee_paid)
                            : 0,
                        'leads_claims_support' => in_array('claims_support', $request->lead_types ?? []),
                        'claims_charging' => $request->claims_charging,
                        'claims_fee_amount' => $request->claims_charging == 'fee' ? $request->claims_fee_amount : 0,
                        'claims_percent' => $request->claims_charging == 'percentage' ? $request->claims_percent : 0,
                    ]
                );
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => $currentStep ? 'Progress saved' : 'Profile updated successfully!',
                'redirect' => $currentStep ? null : route('agent.dashboard')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Profile update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating your profile: ' . $e->getMessage()
            ], 500);
        }
    }
}
