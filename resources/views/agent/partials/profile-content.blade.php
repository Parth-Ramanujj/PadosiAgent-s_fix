@php
    $profile = $agent->profile;
    $performanceStats = $agent->performanceStats;
    $leadPreferences = $agent->leadPreferences;
    $socialLinks = is_array($profile?->social_links) ? $profile->social_links : [];
    $reviewSlug = $profile?->slug ?: $agent->id;
@endphp

<div class="profile-main-card mb-4">
    <div class="profile-header-flex">
        <div class="profile-left-col">
            <div class="profile-img-container">
                <div class="profile-img-wrapper">
                    @if($profile && $profile->profile_photo_path)
                        <img src="{{ $profile->profile_photo_url }}" alt="{{ $agent->fullname }}" onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\"d-flex align-items-center justify-content-center h-100 bg-secondary text-white\" style=\"font-size: 48px;\">{{ strtoupper(substr($agent->fullname, 0, 1)) }}</div>';">
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
                @if(!empty($socialLinks['linkedin']))
                    <a href="{{ auth()->check() ? $socialLinks['linkedin'] : '#' }}" target="_blank" class="social-icon {{ auth()->check() ? '' : 'guest-requires-info' }}" data-url-direct="{{ $socialLinks['linkedin'] }}"><i class="fab fa-linkedin-in"></i></a>
                @endif
                @if(!empty($socialLinks['facebook']))
                    <a href="{{ auth()->check() ? $socialLinks['facebook'] : '#' }}" target="_blank" class="social-icon {{ auth()->check() ? '' : 'guest-requires-info' }}" data-url-direct="{{ $socialLinks['facebook'] }}"><i class="fab fa-facebook-f"></i></a>
                @endif
                @if(!empty($socialLinks['instagram']))
                    <a href="{{ auth()->check() ? $socialLinks['instagram'] : '#' }}" target="_blank" class="social-icon {{ auth()->check() ? '' : 'guest-requires-info' }}" data-url-direct="{{ $socialLinks['instagram'] }}"><i class="fab fa-instagram"></i></a>
                @endif
                @if(!empty($socialLinks['youtube']))
                    <a href="{{ auth()->check() ? $socialLinks['youtube'] : '#' }}" target="_blank" class="social-icon {{ auth()->check() ? '' : 'guest-requires-info' }}" data-url-direct="{{ $socialLinks['youtube'] }}"><i class="fab fa-youtube"></i></a>
                @endif
                @if(!empty($socialLinks['google_business']))
                    <a href="{{ auth()->check() ? $socialLinks['google_business'] : '#' }}" target="_blank" class="social-icon {{ auth()->check() ? '' : 'guest-requires-info' }}" data-url-direct="{{ $socialLinks['google_business'] }}"><i class="fab fa-google"></i></a>
                @endif
            </div>

            <div class="action-btns">
                @php
                    $whatsappUrl = "https://wa.me/" . preg_replace('/[^0-9]/', '', $profile?->whatsapp ?? $agent->mobile);
                @endphp
                <a href="{{ auth()->check() ? $whatsappUrl : '#' }}" target="_blank" class="btn btn-whatsapp {{ auth()->check() ? '' : 'guest-requires-info' }}" data-url-direct="{{ $whatsappUrl }}">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                <a href="{{ auth()->check() ? 'tel:'.$agent->mobile : '#' }}" class="btn btn-call {{ auth()->check() ? '' : 'guest-requires-info' }}" data-url-direct="tel:{{ $agent->mobile }}">
                    <i class="fa-solid fa-phone"></i> Call Now
                </a>
            </div>
        </div>

        <div class="profile-right-col">
            <h1 class="agent-name">
                <div class="d-flex align-items-center flex-wrap gap-3">
                    {{ $profile?->display_name ?? $agent->fullname }}
                    
                    @php
                        $isFavorited = auth()->check() && auth()->user()->favoriteAgents->contains('agent_id', $agent->id);
                    @endphp
                    <!-- <button 
                        class="favorite-btn p-2 rounded-circle border-0 bg-light shadow-sm d-inline-flex align-items-center justify-content-center {{ $isFavorited ? 'is-favorited text-red-500' : 'text-muted' }}"
                        onclick="toggleFavoriteAgent(this, {{ $agent->id }})"
                        style="width: 40px; height: 40px; transition: all 0.3s ease;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            viewBox="0 0 24 24" fill="{{ $isFavorited ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-heart">
                            <path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"></path>
                        </svg>
                    </button> -->
                </div>
                
                <div class="mt-2 d-flex align-items-center">
                    <span class="badge-verified-txt"><i class="fas fa-check-circle mr-1"></i> Verified</span>
                    @php
                        $rawPlan = $agent->activeSubscription?->selected_plan ?? '';
                        $decodedPlan = json_decode($rawPlan, true);
                        $planLabel = (json_last_error() === JSON_ERROR_NONE && is_array($decodedPlan) && isset($decodedPlan['name']))
                            ? $decodedPlan['name']
                            : (string) $rawPlan;
                        $isTrusted = stripos($planLabel, 'professional') !== false;
                        $isApprovedByAdmin = strtolower((string) ($agent->status ?? '')) === 'active';
                    @endphp
                    @if($isApprovedByAdmin)
                        <span class="badge-irdai" style="margin-left: 12px;">IRDAI</span>
                    @endif
                    @if($isTrusted)
                        <span style="margin-left: 12px; background: #eefbf6; color: #0f766e; border: 1px solid #99f6e4; border-radius: 12px; padding: 2px 8px; font-size: 11px; font-weight: 600;">Trusted</span>
                    @endif
                </div>
            </h1>

            <p class="agent-bio">
                {{ $profile?->career_highlights ?? 'Experienced insurance professional with a proven track record of helping clients find the right coverage.' }}
            </p>

            <div class="quick-stats-row">
                <div class="quick-stat-pill">
                    <i class="fas fa-briefcase"></i> {{ $agent->experience_range ?? '0' }} years
                </div>
                <div class="quick-stat-pill">
                    <i class="fas fa-users"></i> {{ $agent->client_base ?? '0+' }} clients
                </div>
                <div class="quick-stat-pill">
                    <i class="fas fa-language"></i> {{ $profile && $profile->languages ? implode(', ', array_map('ucfirst', array_map('trim', explode(',', $profile->languages)))) : 'English, Hindi' }}
                </div>
            </div>

            <div class="insurance-types">
                @php
                    $segmentValues = $agent->insuranceSegments
                        ? $agent->insuranceSegments->map(function ($segment) {
                            return strtolower(trim($segment->segment_type ?? $segment->name ?? ''));
                        })->filter(function ($value) {
                            return !empty($value) && $value !== '-';
                        })->unique()->values()->all()
                        : [];

                    $priorityOrder = ['health', 'life', 'motor', 'sme'];
                    $orderedSegments = [];

                    foreach ($priorityOrder as $priority) {
                        if (in_array($priority, $segmentValues, true)) {
                            $orderedSegments[] = $priority;
                        }
                    }

                    foreach ($segmentValues as $value) {
                        if (!in_array($value, $orderedSegments, true)) {
                            $orderedSegments[] = $value;
                        }
                    }
                @endphp
                @foreach($orderedSegments as $type)
                    @php
                        $icon = 'fa-shield-alt';
                        if (strpos($type, 'life') !== false) $icon = 'fa-user-shield';
                        elseif (strpos($type, 'health') !== false) $icon = 'fa-heartbeat';
                        elseif (strpos($type, 'motor') !== false) $icon = 'fa-car';
                        elseif (strpos($type, 'sme') !== false) $icon = 'fa-store';

                        $tagLabel = $type === 'sme' ? 'SME' : ucfirst($type);
                    @endphp
                    <div class="insurance-pill">
                        <i class="fas {{ $icon }}"></i> {{ $tagLabel }}
                    </div>
                @endforeach
                @if(empty($orderedSegments))
                    <div class="text-muted small">No segments listed</div>
                @endif
            </div>

            <div class="reviews-summary" style="cursor: pointer;" onclick="document.getElementById('reviews-section').scrollIntoView({behavior: 'smooth'})">
                <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= round($agent->averageRating))
                            <i class="fas fa-star text-warning"></i>
                        @else
                            <i class="far fa-star text-warning"></i>
                        @endif
                    @endfor
                </div>
                {{ number_format($agent->averageRating, 1) }} ({{ $agent->reviewCount }} reviews) <i class="fas fa-arrow-up-right-from-square ml-2" style="font-size: 10px;"></i>
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
            @if($profile && $profile->license_number)
                <div class="icon-list-item">
                    <i class="fas fa-certificate item-icon"></i>
                    <div class="item-text">IRDAI Certified Agent (License: {{ $profile->license_number }})</div>
                </div>
            @else
                    <div class="text-muted small">No Certifications recorded.</div>
            @endif
            <!-- <div class="icon-list-item">
                <i class="fas fa-certificate item-icon"></i>
                <div class="item-text">Insurance Institute of India Member</div>
            </div>
            <div class="icon-list-item">
                <i class="fas fa-certificate item-  icon"></i>
                <div class="item-text">Life Insurance Specialist</div>
            </div> -->
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
                    <div class="stat-value">{{ $performanceStats?->claims_processed ?? '0' }}</div>
                    <div class="stat-label">Claims Processed</div>
                </div>
                <div class="stat-box">
                    <div class="stat-value">{{ $performanceStats?->success_rate ?? '98' }}</div>
                    <div class="stat-label">Success Rate</div>
                </div>
                <div class="stat-box">
                    <div class="stat-value">₹{{ number_format($performanceStats?->claims_settled ?? 15000000 / 10000000, 1) }} Cr</div>
                    <div class="stat-label">Claims Settled</div>
                </div>
                <div class="stat-box">
                    <div class="stat-value">< {{ $performanceStats?->response_time ?? '2' }} hours</div>
                    <div class="stat-label">Response Time</div>
                </div>
                <div class="stat-box">
                    <div class="stat-value">{{ number_format($agent->averageRating, 1) }}</div>
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
                
                @if($leadPreferences && $leadPreferences->leads_claims_support)
                <div class="fee-box">
                    @php
                        $claimFee = 'Free';
                        if($leadPreferences->claims_charging == 'fee') {
                            $claimFee = '₹' . $leadPreferences->claims_fee_amount;
                        } elseif($leadPreferences->claims_charging == 'percentage') {
                            $claimFee = $leadPreferences->claims_percent . '%';
                        }
                    @endphp
                    <div class="fee-value">{{ $claimFee }}</div>
                    <div class="fee-label">Claim Help</div>
                </div>
                @endif

                @if($leadPreferences && $leadPreferences->leads_portfolio_analysis)
                <div class="fee-box">
                    @php
                        $auditFee = 'Free';
                        if($leadPreferences->portfolio_charging != 'free') {
                            $auditFee = '₹' . $leadPreferences->portfolio_fee;
                        }
                    @endphp
                    <div class="fee-value">{{ $auditFee }}</div>
                    <div class="fee-label">Review</div>
                </div>
                @endif
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
                           <img src="{{ $photo->photo_url }}" alt="Achievement" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('img/avatar-icon.jpg') }}';">
                    </div>
                @empty
                    <div class="col-12 text-center py-4 bg-light rounded text-muted">
                        No achievement photos uploaded.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Reviews -->
        <div class="section-card" id="reviews-section">
            <div class="reviews-header">
                <h2 class="section-title mb-0"><i class="far fa-star"></i> Reviews</h2>
                <span class="total-reviews">{{ $agent->reviewCount }} total</span>
            </div>

            {{-- Only show "Write a Review" if it's NOT the agent's own profile --}}
            @php
                $isOwnerView = (auth()->check() && auth()->user()->agent && auth()->user()->agent->id == $agent->id);
                $existingReview = null;
                if(auth()->check()) {
                    $existingReview = $agent->reviews->where('user_id', auth()->id())->first();
                }
            @endphp
            @if(!$isOwnerView)
            <div class="write-review-box">
                <h3 class="write-review-title">Write a Review</h3>
                <form id="submit-review-form" data-is-guest="{{ auth()->check() ? 'false' : 'true' }}">
                    @csrf
                    <input type="hidden" name="rating" id="review-rating-input" value="{{ $existingReview ? $existingReview->rating : 0 }}">
                    <p class="text-muted small mb-3">Your Rating: 
                        <span class="stars ml-2 review-stars-input" style="font-size: 20px; cursor: pointer;">
                            @for($i = 1; $i <= 5; $i++)
                                @if($existingReview && $i <= $existingReview->rating)
                                    <i class="fas fa-star text-warning" data-rating="{{ $i }}"></i>
                                @else
                                    <i class="far fa-star text-warning" data-rating="{{ $i }}"></i>
                                @endif
                            @endfor
                        </span>
                    </p>
                    <div class="position-relative mb-3">
                        <textarea id="review-text-input" name="review" class="form-control" rows="4" placeholder="Share your experience with this agent (minimum 10 characters)..." required minlength="10" maxlength="500">{{ $existingReview ? $existingReview->review : '' }}</textarea>
                        <div class="text-right small text-muted mt-1">
                            <span id="review-char-count">{{ $existingReview ? strlen($existingReview->review) : 0 }}</span> / 500 characters
                        </div>
                    </div>
                    <button type="submit" class="btn btn-whatsapp px-4" id="submit-review-btn">
                        {{ auth()->check() ? ($existingReview ? 'Update Review' : 'Submit Review') : 'Submit Review' }}
                    </button>
                    @guest
                        <p class="text-muted small mt-2">
                             Note: You will be asked to share your name, email, and mobile number to submit this review.
                        </p>
                    @endguest
                </form>
            </div>
            @endif

            <div class="reviews-list">
                @forelse($agent->reviews->where('is_approved', true)->sortByDesc('created_at') as $review)
                <div class="review-item">
                    <div class="review-top">
                        <div class="reviewer-info">
                            <div class="reviewer-avatar">
                                {{ strtoupper(substr($review->user->fullname ?? $review->reviewer_name ?? 'User', 0, 1)) }}
                            </div>
                            <div class="reviewer-name">{{ $review->user->fullname ?? $review->reviewer_name ?? 'User' }}</div>
                        </div>
                        <div class="stars">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating)
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="far fa-star text-warning"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                    <p class="review-text">{{ strip_tags($review->review) }}</p>
                    <div class="review-date">{{ $review->created_at->format('M d, Y') }}</div>
                </div>
                @empty
                    <p class="text-muted py-4 text-center">No reviews yet. Be the first to review!</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    var currentGuestData = null;

    /**
     * Helper to show guest registration popup and then execute callback
     */
    var showGuestRegistrationPopup = function(title, onRegistered) {
        Swal.fire({
            title: '<h3 style="color: #0d9488; margin-top: 10px;">' + title + '</h3>',
            html: 
                '<div class="text-left" style="padding: 0 10px;">' +
                    '<div id="swal-error-container" class="alert alert-danger d-none" style="font-size: 13px; padding: 10px; border-radius: 8px; margin-bottom: 15px; border: none; background-color: #fef2f2; color: #991b1b;">' +
                        '<i class="fas fa-exclamation-circle mr-2"></i> <span id="swal-error-message"></span>' +
                    '</div>' +

                    '<p style="color: #64748b; font-size: 14px; margin-bottom: 20px;">Please share your details to proceed with this action.</p>' +
                    
                    '<div class="form-group mb-3">' +
                        '<label style="font-size: 13px; font-weight: 600; color: #475569;">Full Name <span class="text-danger">*</span></label>' +
                        '<input type="text" id="swal-fullname" class="form-control" placeholder="Enter your full name" style="border-radius: 8px; padding: 12px;">' +
                    '</div>' +
                    
                    '<div class="form-group mb-3">' +
                        '<label style="font-size: 13px; font-weight: 600; color: #475569;">Email Address <span class="text-danger">*</span></label>' +
                        '<input type="email" id="swal-email" class="form-control" placeholder="name@example.com" style="border-radius: 8px; padding: 12px;">' +
                    '</div>' +
                    
                    '<div class="form-group mb-3">' +
                        '<label style="font-size: 13px; font-weight: 600; color: #475569;">Mobile Number <span class="text-danger">*</span></label>' +
                        '<input type="text" id="swal-mobile" class="form-control" placeholder="10-digit mobile number" maxlength="10" ' +
                            'oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"' +
                            ' style="border-radius: 8px; padding: 12px;">' +
                    '</div>' +
                '</div>',
            showCancelButton: true,
            confirmButtonText: 'Continue',
            confirmButtonColor: '#0d9488',
            cancelButtonText: 'Cancel',
            padding: '2rem',
            width: '450px',
            preConfirm: function() {
                var fullname = $('#swal-fullname').val().trim();
                var email = $('#swal-email').val().trim();
                var mobile = $('#swal-mobile').val().trim();

                var showError = function(msg) {
                    $('#swal-error-message').text(msg);
                    $('#swal-error-container').removeClass('d-none').hide().fadeIn();
                    setTimeout(function() {
                        $('#swal-error-container').fadeOut();
                    }, 3000);
                };

                $('#swal-error-container').addClass('d-none');

                if (!fullname) { showError('Full Name is required'); return false; }
                if (!email) { showError('Email Address is required'); return false; }
                if (!/^\S+@\S+\.\S+$/.test(email)) { showError('Please enter a valid email address'); return false; }
                if (!mobile) { showError('Mobile Number is required'); return false; }
                if (mobile.length < 10) { showError('Please enter a valid mobile number'); return false; }

                return { fullname: fullname, email: email, mobile: mobile };
            },
            allowOutsideClick: false,
            allowEscapeKey: false,
            backdrop: 'rgba(0,0,0,0.6)'
        }).then(function(result) {
            if (result.isConfirmed) {
                currentGuestData = {
                    fullname: result.value.fullname,
                    email: result.value.email,
                    mobile: result.value.mobile
                };

                onRegistered(currentGuestData);
            }
        });
    };

    var proceedToDestination = function(url, target) {
        if (target === '_blank') {
            window.open(url, '_blank');
            return;
        }

        window.location.href = url;
    };

    // Handler for guest actions (WhatsApp/Call/Social)
    $(document).on('click', '.guest-requires-info', function(e) {
        e.preventDefault();
        var url = $(this).data('url-direct');
        var target = $(this).attr('target');
        
        showGuestRegistrationPopup('Connect with Agent', function(guestData) {
            var postData = {
                _token: "{{ csrf_token() }}",
                fullname: guestData.fullname,
                email: guestData.email,
                mobile: guestData.mobile
            };

            Swal.fire({
                title: 'Connecting you...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: function() {
                    Swal.showLoading();
                    $.ajax({
                        url: "{{ route('client.quick-register') }}",
                        type: "POST",
                        data: postData,
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.close();
                                proceedToDestination(url, target);
                            } else {
                                Swal.close();
                                proceedToDestination(url, target);
                            }
                        },
                        error: function(xhr) {
                            // Do not block the user action if optional lead capture fails.
                            Swal.close();
                            proceedToDestination(url, target);
                        }
                    });
                }
            });
        });
    });

    var initReviewForm = function() {
        var form = document.getElementById('submit-review-form');
        if (!form) return;

        // Prevent double initialization
        if (form.dataset.initialized) return;
        form.dataset.initialized = 'true';

        var isGuest = form.dataset.isGuest === 'true';
        var stars = form.querySelectorAll('.review-stars-input i');
        var ratingInput = document.getElementById('review-rating-input');
        var reviewTextInput = document.getElementById('review-text-input');
        var reviewCharCount = document.getElementById('review-char-count');
        var starsContainer = form.querySelector('.review-stars-input');
        var submitBtn = form.querySelector('#submit-review-btn');

        if (reviewTextInput && reviewCharCount) {
            reviewTextInput.addEventListener('input', function() {
                reviewCharCount.textContent = this.value.length;
            });
        }

        var updateStars = function(rating) {
            stars.forEach(function(s) {
                var sRating = parseInt(s.getAttribute('data-rating'));
                if (sRating <= rating) {
                    s.classList.remove('far');
                    s.classList.add('fas');
                } else {
                    s.classList.remove('fas');
                    s.classList.add('far');
                }
            });
        };

        stars.forEach(function(star) {
            star.addEventListener('mouseover', function() {
                updateStars(parseInt(this.getAttribute('data-rating')));
            });

            star.addEventListener('click', function() {
                var rating = parseInt(this.getAttribute('data-rating'));
                ratingInput.value = rating;
                updateStars(rating);
            });
        });

        if (starsContainer) {
            starsContainer.addEventListener('mouseout', function() {
                updateStars(parseInt(ratingInput.value || 0));
            });
        }

        // Initialize stars if there's an existing rating
        if (ratingInput.value !== '0') {
            updateStars(parseInt(ratingInput.value));
        }

        var performSubmit = function(guestData) {
            var originalBtnHtml = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Submitting...';

            var payload = {
                _token: '{{ csrf_token() }}',
                rating: ratingInput.value,
                review: reviewTextInput.value
            };

            var reviewGuestData = guestData || currentGuestData;
            if (reviewGuestData) {
                payload.fullname = reviewGuestData.fullname;
                payload.email = reviewGuestData.email;
                payload.mobile = reviewGuestData.mobile;
            }
            
            $.post('{{ route("agent.store-review", ["slug" => $reviewSlug]) }}', payload, function(data) {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        confirmButtonColor: '#06A441'
                    }).then(function() {
                        window.location.reload();
                    });
                } else {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHtml;
                    var errorMsg = data.message || 'Validation error';
                    if (data.errors) {
                        errorMsg = Object.values(data.errors).flat().join('\n');
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMsg,
                        confirmButtonColor: '#273c8e'
                    });
                }
            }).fail(function(xhr) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;
                
                var errorMsg = 'An error occurred. Please try again later.';
                if (xhr.status === 419) {
                    errorMsg = 'Session expired. Please refresh the page.';
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMsg = Object.values(xhr.responseJSON.errors).flat().join('\n');
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMsg,
                    confirmButtonColor: '#273c8e'
                });
            });
        };

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (ratingInput.value === '0') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Rating Required',
                    text: 'Please select a star rating before submitting your review.',
                    confirmButtonColor: '#273c8e'
                });
                return;
            }

            if (isGuest) {
                showGuestRegistrationPopup('Submit Review', function(guestData) {
                    performSubmit(guestData);
                });
            } else {
                performSubmit();
            }
        });
    };

    // Run initialization
    initReviewForm();
})();
</script>
