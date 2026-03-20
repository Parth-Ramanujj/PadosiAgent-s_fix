<link rel="stylesheet" href="{{ asset('css/agent-profile-view.css') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<div class="profile-main-card mb-4">
    <div class="profile-header-flex">
        <div class="profile-left-col">
            <div class="profile-img-container">
                <div class="profile-img-wrapper">
                    @if($agent->profile && $agent->profile->profile_photo_path)
                        <img src="{{ asset('storage/' . $agent->profile->profile_photo_path) }}" alt="{{ $agent->fullname }}">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100 bg-secondary text-white" style="font-size: 48px;">
                            {{ strtoupper(substr($agent->fullname, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div class="verified-tick">
                    <i class="fas fa-check"></i>
                </div>
            </div>

            <div class="social-links">
                @php
                    $socialLinks = $agent->profile->social_links ?? [];
                @endphp
                @if(!empty($socialLinks['linkedin']))
                    <a href="{{ $socialLinks['linkedin'] }}" target="_blank" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                @endif
                @if(!empty($socialLinks['facebook']))
                    <a href="{{ $socialLinks['facebook'] }}" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                @endif
                @if(!empty($socialLinks['instagram']))
                    <a href="{{ $socialLinks['instagram'] }}" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
                @endif
                @if(!empty($socialLinks['youtube']))
                    <a href="{{ $socialLinks['youtube'] }}" target="_blank" class="social-icon"><i class="fab fa-youtube"></i></a>
                @endif
                @if(!empty($socialLinks['google_business']))
                    <a href="{{ $socialLinks['google_business'] }}" target="_blank" class="social-icon"><i class="fab fa-google"></i></a>
                @endif
            </div>

            <div class="action-btns">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $agent->profile->whatsapp ?? $agent->mobile) }}" target="_blank" class="btn btn-whatsapp">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                <a href="tel:{{ $agent->mobile }}" class="btn btn-call">
                    <i class="fas fa-phone-alt"></i> Call Now
                </a>
            </div>
        </div>

        <div class="profile-right-col">
            <h1 class="agent-name">
                {{ $agent->profile->display_name ?? $agent->fullname }}
                <span class="badge-verified-txt"><i class="fas fa-check-circle mr-1"></i> Verified</span>
                @if($agent->profile && $agent->profile->license_number)
                    <span class="badge-irdai">IRDAI</span>
                @endif
            </h1>

            <p class="agent-bio">
                {{ $agent->profile->career_highlights ?? 'Experienced insurance professional with a proven track record of helping clients find the right coverage.' }}
            </p>

            <div class="quick-stats-row">
                <div class="quick-stat-pill">
                    <i class="fas fa-briefcase"></i> {{ $agent->experience_range ?? '0' }} years
                </div>
                <div class="quick-stat-pill">
                    <i class="fas fa-users"></i> {{ $agent->client_base ?? '0+' }} clients
                </div>
                <div class="quick-stat-pill">
                    <i class="fas fa-language"></i> {{ $agent->profile->languages ?? 'English, Hindi' }}
                </div>
            </div>

            <div class="insurance-types">
                @forelse($agent->insuranceSegments as $segment)
                    <div class="insurance-pill">
                        <i class="fas fa-shield-alt"></i> {{ ucfirst($segment->segment_type) }}
                    </div>
                @empty
                    <div class="text-muted small">No segments listed</div>
                @endforelse
            </div>

            <div class="reviews-summary">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                4.8 (127 reviews) <i class="fas fa-arrow-up-right-from-square ml-2" style="font-size: 10px;"></i>
            </div>
        </div>
    </div>
</div>

<div class="profile-content-grid">
    <div class="left-section">
        <!-- Career Timeline -->
        <div class="section-card">
            <h2 class="section-title"><i class="far fa-calendar-alt"></i> Career Timeline</h2>
            <div class="timeline">
                @php
                    $typeIcons = [
                        'Award' => 'fas fa-trophy',
                        'Achievement' => 'fas fa-medal',
                        'Certification' => 'fas fa-award',
                        'Career Event' => 'fas fa-calendar-check',
                        'Experience' => 'fas fa-briefcase'
                    ];
                @endphp
                @forelse($agent->careerTimelines->sortByDesc('year') as $timeline)
                    <div class="timeline-item">
                        <i class="{{ $typeIcons[$timeline->event_type] ?? 'fas fa-circle' }} timeline-custom-icon"></i>
                        <div class="timeline-year">{{ $timeline->month }} {{ $timeline->year }}</div>
                        <div class="timeline-text">{{ $timeline->event_text }}</div>
                    </div>
                @empty
                    <div class="text-muted small">No timeline events recorded.</div>
                @endforelse
            </div>
        </div>

        <!-- Certifications -->
        <div class="section-card">
            <h2 class="section-title"><i class="fas fa-award"></i> Certifications</h2>
            @if($agent->profile && $agent->profile->license_number)
                <div class="icon-list-item">
                    <i class="fas fa-certificate item-icon"></i>
                    <div class="item-text">IRDAI Certified Agent</div>
                </div>
            @endif
            <div class="icon-list-item">
                <i class="fas fa-certificate item-icon"></i>
                <div class="item-text">Insurance Institute of India Member</div>
            </div>
            <div class="icon-list-item">
                <i class="fas fa-certificate item-icon"></i>
                <div class="item-text">Life Insurance Specialist</div>
            </div>
        </div>

        <!-- Achievements -->
        <div class="section-card">
            <h2 class="section-title"><i class="fas fa-trophy"></i> Achievements</h2>
            <div class="achievements-row">
                <div class="achievement-badge">
                    <i class="fas fa-medal"></i> Top Performer 2023
                </div>
                <div class="achievement-badge">
                    <i class="fas fa-medal"></i> Claim Master
                </div>
                <div class="achievement-badge">
                    <i class="fas fa-star"></i> 5 Star Rating
                </div>
            </div>
        </div>
    </div>

    <div class="right-section">
        <!-- Performance Stats -->
        <div class="section-card">
            <h2 class="section-title"><i class="fas fa-chart-line"></i> Performance Stats</h2>
            <div class="stats-grid">
                <div class="stat-box">
                    <div class="stat-value">{{ $agent->client_base ?? '0' }}</div>
                    <div class="stat-label">Clients Served</div>
                </div>
                <div class="stat-box">
                    <div class="stat-value">{{ $agent->performanceStats->claims_processed ?? '0' }}</div>
                    <div class="stat-label">Claims Processed</div>
                </div>
                <div class="stat-box">
                    <div class="stat-value">{{ $agent->performanceStats->success_rate ?? '98' }}</div>
                    <div class="stat-label">Success Rate</div>
                </div>
                <div class="stat-box">
                    <div class="stat-value">₹{{ number_format($agent->performanceStats->claims_settled ?? 15000000 / 10000000, 1) }} Cr</div>
                    <div class="stat-label">Claims Settled</div>
                </div>
                <div class="stat-box">
                    <div class="stat-value">< {{ $agent->performanceStats->response_time ?? '2' }} hours</div>
                    <div class="stat-label">Response Time</div>
                </div>
                <div class="stat-box">
                    <div class="stat-value">4.8</div>
                    <div class="stat-label">Rating</div>
                </div>
            </div>
        </div>

        <!-- Service Fees -->
        <div class="section-card">
            <h2 class="section-title"><i class="fas fa-hand-holding-usd"></i> Service Fees</h2>
            <div class="fees-grid">
                <div class="fee-box">
                    <div class="fee-value">Free</div>
                    <div class="fee-label">New Policy</div>
                </div>
                <div class="fee-box">
                    @php
                        $claimFee = 'Free';
                        if($agent->leadPreferences && $agent->leadPreferences->claims_charging == 'fee') {
                            $claimFee = '₹' . $agent->leadPreferences->claims_fee_amount;
                        } elseif($agent->leadPreferences && $agent->leadPreferences->claims_charging == 'percentage') {
                            $claimFee = $agent->leadPreferences->claims_percent . '%';
                        }
                    @endphp
                    <div class="fee-value">{{ $claimFee }}</div>
                    <div class="fee-label">Claim Help</div>
                </div>
                <div class="fee-box">
                    @php
                        $auditFee = 'Free';
                        if($agent->leadPreferences && $agent->leadPreferences->portfolio_charging != 'free') {
                            $auditFee = '₹' . $agent->leadPreferences->portfolio_fee;
                        }
                    @endphp
                    <div class="fee-value">{{ $auditFee }}</div>
                    <div class="fee-label">Review</div>
                </div>
            </div>
        </div>

        <!-- Media (Achievement Photos) -->
        <div class="section-card">
            <div class="media-header">
                <h2 class="section-title mb-0"><i class="fas fa-images"></i> Media</h2>
                <span class="max-indicator">10 max</span>
            </div>
            <div class="media-grid">
                @forelse($agent->achievementPhotos as $photo)
                    <div class="media-item">
                        <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Achievement">
                    </div>
                @empty
                    <div class="col-12 text-center py-4 bg-light rounded text-muted">
                        No achievement photos uploaded.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Reviews -->
        <div class="section-card">
            <div class="reviews-header">
                <h2 class="section-title mb-0"><i class="far fa-star"></i> Reviews</h2>
                <span class="total-reviews">127 total</span>
            </div>

            {{-- Only show "Write a Review" if it's NOT the agent's own profile --}}
            @php
                $isOwnerView = (auth()->check() && auth()->user()->agent && auth()->user()->agent->id == $agent->id);
            @endphp
            @if(!$isOwnerView)
            <div class="write-review-box">
                <h3 class="write-review-title">Write a Review</h3>
                <p class="text-muted small mb-3">Your Rating: 
                    <span class="stars ml-2" style="font-size: 20px;">
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                    </span>
                </p>
                <textarea class="form-control mb-3" rows="4" placeholder="Share your experience with this agent (minimum 10 characters)..."></textarea>
                <button class="btn btn-whatsapp px-4">Submit Review</button>
            </div>
            @endif

            <div class="reviews-list">
                <div class="review-item">
                    <div class="review-top">
                        <div class="reviewer-info">
                            <div class="reviewer-avatar">P</div>
                            <div class="reviewer-name">Priya Patel</div>
                        </div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="review-text">Excellent service! Very professional.</p>
                    <div class="review-date">2024-01-10</div>
                </div>

                <div class="review-item">
                    <div class="review-top">
                        <div class="reviewer-info">
                            <div class="reviewer-avatar">A</div>
                            <div class="reviewer-name">Amit Kumar</div>
                        </div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="review-text">Great experience with claim assistance.</p>
                    <div class="review-date">2024-01-05</div>
                </div>
            </div>
        </div>
    </div>
</div>
