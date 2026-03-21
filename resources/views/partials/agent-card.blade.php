<div class="find-agents-list-item">
    <div class="pic-block">
        <figure class="find-agents-list-item-pic dark-blue-bg-pic">
            <img src="{{ $agent->profile?->profile_photo_url ?? asset('img/avatar-icon.jpg') }}" 
                 alt="{{ $agent->profile->display_name ?? $agent->fullname }}" 
                 class="img-fluid">
        </figure>
        <div class="like-buttons">
            @php
                $rawPlan = $agent->activeSubscription->selected_plan ?? '';
                $decodedPlan = json_decode($rawPlan, true);
                $planLabel = (json_last_error() === JSON_ERROR_NONE && is_array($decodedPlan) && isset($decodedPlan['name']))
                    ? $decodedPlan['name']
                    : (string) $rawPlan;
                $isTrusted = stripos($planLabel, 'professional') !== false;
                $isApprovedByAdmin = strtolower((string) ($agent->status ?? '')) === 'active';
            @endphp
            <button
                class="p-1.5 rounded-lg transition-all bg-white hover:bg-muted text-muted-foreground shadow-sm compare-btn"
                onclick="toggleCompareAgent(this)"
                data-agent-id="{{ $agent->id }}"
                data-agent-name="{{ $agent->profile->display_name ?? $agent->fullname }}"
                data-agent-experience="{{ $agent->experience_range ?? 'N/A' }}"
                data-agent-rating="{{ number_format($agent->average_rating, 1) }}"
                data-agent-reviews="{{ $agent->review_count }}"
                data-agent-claims="{{ $agent->performanceStats->claims_processed ?? 0 }}"
                data-agent-settled="₹{{ $agent->performanceStats->claims_amount ?? 0 }}"
                data-agent-clients="{{ $agent->client_base ?? 0 }}"
                data-agent-segments="{{ implode(', ', $agent->insuranceSegments->pluck('segment_type')->filter()->toArray()) }}"
                data-agent-location="{{ $agent->profile && $agent->profile->city ? $agent->profile->city : 'N/A' }}"
                data-agent-image="{{ $agent->profile?->profile_photo_url ?? asset('img/avatar-icon.jpg') }}"
                data-agent-slug="{{ ($agent->profile?->slug) ?: ($agent->id ?? 'agent') }}"
                data-agent-mobile="{{ $agent->mobile }}"
                data-agent-whatsapp="{{ preg_replace('/[^0-9]/', '', $agent->profile->whatsapp ?? $agent->mobile) }}"
                data-agent-approved="{{ $isApprovedByAdmin ? '1' : '0' }}"
                data-agent-trusted="{{ $isTrusted ? '1' : '0' }}"
                title="Compare Agent">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-git-compare h-3.5 w-3.5" aria-hidden="true">
                    <circle cx="18" cy="18" r="3"></circle>
                    <circle cx="6" cy="6" r="3"></circle>
                    <path d="M13 6h3a2 2 0 0 1 2 2v7"></path>
                    <path d="M11 18H8a2 2 0 0 1-2-2V9"></path>
                </svg>
            </button>

            @php
                $isFavorited = auth()->check() && auth()->user()->favoriteAgents->contains('agent_id', $agent->id);
            @endphp
            <button
                class="p-1.5 rounded-lg transition-all bg-white hover:bg-red-50 text-muted-foreground hover:text-red-500 shadow-sm favorite-btn {{ $isFavorited ? 'is-favorited text-red-500' : '' }}"
                onclick="toggleFavoriteAgent(this, {{ $agent->id }})"
                data-agent-id="{{ $agent->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="{{ $isFavorited ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-heart h-3.5 w-3.5" aria-hidden="true">
                    <path
                        d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5">
                    </path>
                </svg>
            </button>
        </div>
    </div>

    <div class="find-agents-list-item-content">
        <div class="agents-name-location d-flex align-items-center mb-2">
            <h3>{{ $agent->profile->display_name ?? $agent->fullname }}</h3>
            @if($isApprovedByAdmin)
            <span style="margin-left: 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-award h-2.5 w-2.5 mr-0.5" aria-hidden="true">
                    <path
                        d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526">
                    </path>
                    <circle cx="12" cy="8" r="6"></circle>
                </svg>
                IRDAI
            </span>
            @endif
            @if($isTrusted)
            <span style="margin-left: 10px; background: #eefbf6; color: #0f766e; border: 1px solid #99f6e4; border-radius: 12px; padding: 2px 8px; font-size: 11px; font-weight: 600;">Trusted</span>
            @endif
        </div>
        <location class="agent-location mb-2"><i class="fa-solid fa-location-dot"></i>
            {{ $agent->profile && $agent->profile->city ? $agent->profile->city . ', ' . ($agent->profile->state ?? 'India') : 'India' }}</location>

        <div class="rating-block mb-2">
            <span class="rating-block-star d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-star h-3.5 w-3.5 text-amber-500 fill-amber-500"
                    aria-hidden="true">
                    <path
                        d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z">
                    </path>
                </svg>
                {{ number_format($agent->average_rating, 1) }} <span>({{ $agent->review_count }})</span>
            </span>
            <span class="rating-block-year d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-briefcase h-3 w-3 text-muted-foreground">
                    <path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                    <rect width="20" height="14" x="2" y="6" rx="2"></rect>
                </svg>
                {{ $agent->experience_range ?? 'N/A' }}
            </span>
        </div>

        <div class="claims-block mb-2">
            <span class="claims-block-claims-item d-flex align-items-center" title="Claims Processed">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-award h-3.5 w-3.5 text-secondary"
                    aria-hidden="true">
                    <path
                        d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526">
                    </path>
                    <circle cx="12" cy="8" r="6"></circle>
                </svg>
                {{ $agent->performanceStats->claims_processed ?? 0 }} <span>Claims</span>
            </span>
            <span class="claims-block-settled-item d-flex align-items-center" title="Claims Settled Amount">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-briefcase h-3 w-3 text-muted-foreground"
                    aria-hidden="true">
                    <path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                    <rect width="20" height="14" x="2" y="6" rx="2"></rect>
                </svg>
                ₹{{ $agent->performanceStats->claims_amount ?? 0 }} <span>Settled</span>
            </span>
            <span class="claims-block-client-base-item d-flex align-items-center" title="Approx Active Client Base">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-users h-3.5 w-3.5 text-blue-500" aria-hidden="true">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                {{ $agent->client_base ?? '0' }} <span>Clients</span>
            </span>
        </div>

        <div class="agent-card-segments">
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
                <div class="insurance-pill card-pill">
                    <i class="fas {{ $icon }}"></i> {{ $tagLabel }}
                </div>
            @endforeach
        </div>

        <div class="bottom-content-card">
            <div class="bottom-content-card-left">
                {{-- Reserved for future use --}}
            </div>
            <div class="bottom-butons">
                @php
                    $serviceType = request('ServiceType');
                    $insuranceType = is_array(request('InsuranceType'))
                        ? implode(', ', request('InsuranceType'))
                        : request('InsuranceType');
                    $insuranceCompany = request('InsuranceCompany');
                @endphp
                <a class="phone-btn" href="tel:{{ $agent->mobile }}"
                    onclick="return handleAgentContactClick(event, this, 'call')"
                    data-agent-id="{{ $agent->id }}"
                    data-service-type="{{ $serviceType }}"
                    data-insurance-type="{{ $insuranceType }}"
                    data-insurance-company="{{ $insuranceCompany }}"
                    class="call-btn text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-phone-call h-4 w-4" aria-hidden="true">
                        <path d="M13 2a9 9 0 0 1 9 9"></path>
                        <path d="M13 6a5 5 0 0 1 5 5"></path>
                        <path
                            d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384">
                        </path>
                    </svg>
                    Call</a>
                @php
                    $whatsappNumber = preg_replace('/[^0-9]/', '', $agent->profile->whatsapp ?? $agent->mobile);
                    if (strlen($whatsappNumber) == 10) {
                        $whatsappNumber = '91' . $whatsappNumber;
                    }
                @endphp
                <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" class="chat-btn" rel="noopener noreferrer"
                    onclick="return handleAgentContactClick(event, this, 'whatsapp')"
                    data-agent-id="{{ $agent->id }}"
                    data-service-type="{{ $serviceType }}"
                    data-insurance-type="{{ $insuranceType }}"
                    data-insurance-company="{{ $insuranceCompany }}">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                        viewBox="0 0 448 512"
                        class="h-4 w-4" height="1em" width="1em"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z">
                        </path>
                    </svg>
                    Chat</a>

                <a href="{{ route('agent.public-profile', ['slug' => ($agent->profile?->slug) ?: ($agent->id ?? 'agent')]) }}" class="view-profile-btn">View Profile</a>

            </div>
        </div>
    </div>
</div>
