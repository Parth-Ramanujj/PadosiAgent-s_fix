
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
                    <i class="fa-solid fa-phone"></i> Call Now
                </a>
            </div>
        </div>

        <div class="profile-right-col">
            <h1 class="agent-name">
                <div class="d-flex align-items-center flex-wrap gap-3">
                    {{ $agent->profile->display_name ?? $agent->fullname }}
                    
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
                    @if($agent->profile && $agent->profile->license_number)
                        <span class="badge-irdai" style="margin-left: 12px;">IRDAI</span>
                    @endif
                </div>
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
                    <i class="fas fa-language"></i> {{ $agent->profile && $agent->profile->languages ? implode(', ', array_map('ucfirst', array_map('trim', explode(',', $agent->profile->languages)))) : 'English, Hindi' }}
                </div>
            </div>

            <div class="insurance-types">
                @foreach($agent->insuranceSegments as $segment)
                    @php
                        $type = strtolower(trim($segment->segment_type ?? $segment->name ?? ''));
                        if(empty($type) || $type === '-') continue;
                        
                        $icon = 'fa-shield-alt';
                        if(strpos($type, 'life') !== false) $icon = 'fa-user-shield';
                        elseif(strpos($type, 'health') !== false) $icon = 'fa-heartbeat';
                        elseif(strpos($type, 'motor') !== false) $icon = 'fa-car';
                        elseif(strpos($type, 'sme') !== false) $icon = 'fa-store';
                    @endphp
                    <div class="insurance-pill">
                        <i class="fas {{ $icon }}"></i> {{ ucfirst($type) }}
                    </div>
                @endforeach
                @if($agent->insuranceSegments->isEmpty())
                    <div class="text-muted small">No segments listed</div>
                @endif
            </div>

            <div class="reviews-summary">
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
            @if($agent->profile && $agent->profile->license_number)
                <div class="icon-list-item">
                    <i class="fas fa-certificate item-icon"></i>
                    <div class="item-text">IRDAI Certified Agent (License: {{ $agent->profile->license_number }})</div>
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
                @auth
                    <form id="submit-review-form">
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
                            {{ $existingReview ? 'Update Review' : 'Submit Review' }}
                        </button>
                    </form>
                @else
                    <p class="text-muted mb-3">Please <a href="{{ route('client.login') }}" class="text-primary font-weight-bold" style="text-decoration: underline;">login</a> to write a review for this agent.</p>
                @endauth
            </div>
            @endif

            <div class="reviews-list">
                @forelse($agent->reviews->where('is_approved', true)->sortByDesc('created_at') as $review)
                <div class="review-item" style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #eee;">
                    <div class="review-top" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <div class="reviewer-info" style="display: flex; align-items: center; gap: 10px;">
                            <div class="reviewer-avatar" style="width: 40px; height: 40px; border-radius: 50%; background: #e0e0e0; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                {{ strtoupper(substr($review->user->fullname ?? 'User', 0, 1)) }}
                            </div>
                            <div class="reviewer-name" style="font-weight: 600;">{{ $review->user->fullname ?? 'User' }}</div>
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
                    <p class="review-text" style="color: #555;">{{ $review->review }}</p>
                    <div class="review-date" style="font-size: 0.85rem; color: #999;">{{ $review->created_at->format('M d, Y') }}</div>
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
    const initReviewForm = () => {
        const form = document.getElementById('submit-review-form');
        if (!form) return;

        // Prevent double initialization
        if (form.dataset.initialized) return;
        form.dataset.initialized = 'true';

        const stars = form.querySelectorAll('.review-stars-input i');
        const ratingInput = document.getElementById('review-rating-input');
        const reviewTextInput = document.getElementById('review-text-input');
        const reviewCharCount = document.getElementById('review-char-count');
        const starsContainer = form.querySelector('.review-stars-input');
        const submitBtn = form.querySelector('#submit-review-btn');

        if (reviewTextInput && reviewCharCount) {
            reviewTextInput.addEventListener('input', function() {
                reviewCharCount.textContent = this.value.length;
            });
        }

        const updateStars = (rating) => {
            stars.forEach(s => {
                const sRating = parseInt(s.getAttribute('data-rating'));
                if (sRating <= rating) {
                    s.classList.remove('far');
                    s.classList.add('fas');
                } else {
                    s.classList.remove('fas');
                    s.classList.add('far');
                }
            });
        };

        stars.forEach(star => {
            star.addEventListener('mouseover', function() {
                updateStars(parseInt(this.getAttribute('data-rating')));
            });

            star.addEventListener('click', function() {
                const rating = parseInt(this.getAttribute('data-rating'));
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

            const originalBtnHtml = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Submitting...';
            
            $.post('{{ route("agent.store-review", ["slug" => $agent->profile->slug ?? $agent->id]) }}', {
                _token: '{{ csrf_token() }}',
                rating: ratingInput.value,
                review: reviewTextInput.value
            }, function(data) {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        confirmButtonColor: '#06A441'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHtml;
                    let errorMsg = data.message || 'Validation error';
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
                
                let errorMsg = 'An error occurred. Please try again later.';
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
        });
    };

    // Run initialization
    initReviewForm();
})();
</script>
