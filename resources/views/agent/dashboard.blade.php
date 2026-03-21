@extends('layouts.app')

@section('content')
<!-- Agent Dashboard Styles -->
<link rel="stylesheet" href="{{ asset('css/agent-dashboard.css') }}">
@stack('styles')

@include('layouts.header')
<div class="agent-dashboard-wrapper">
    <div class="container py-4">
        <!-- Dashboard Header -->
        <div class="dashboard-header-con d-flex justify-content-between align-items-center mb-5 flex-wrap px-2">
            <div class="d-flex align-items-center">
                @php
                    $profile = $agent->profile;
                    $displayName = trim((string) ($profile?->display_name ?? $agent->fullname ?? 'Agent'));
                    $displayInitial = strtoupper(substr($displayName, 0, 1));
                    $dashboardStats = $dashboardStats ?? [
                        'conversionRate' => 0,
                        'monthlyTarget' => 0,
                        'totalPageViews' => 0,
                        'contactRequests' => 0,
                        'monthlyVisits' => 0,
                        'totalLeads' => 0,
                        'monthlyLeads' => 0,
                        'newLeads' => 0,
                        'contactedLeads' => 0,
                        'followUpLeads' => 0,
                        'closedLeads' => 0,
                        'activeLeads' => 0,
                    ];
                    $recentLeads = $recentLeads ?? collect();
                @endphp
                <div class="agent-avatar-circle mr-3">
                    <span class="avatar-letter">{{ $displayInitial }}</span>
                </div>
                <div class="agent-info">
                    @php
                        $rawPlan = $agent->activeSubscription?->selected_plan ?? 'Free Plan';
                        
                        // Handle potential JSON string for plan name
                        $decodedPlan = json_decode($rawPlan, true);
                        if (json_last_error() === JSON_ERROR_NONE && is_array($decodedPlan) && isset($decodedPlan['name'])) {
                            $planName = $decodedPlan['name'];
                        } else {
                            $planName = ucwords(str_replace(['_', '-'], ' ', $rawPlan));
                        }

                        // Calculate profile completion
                        $completion = 15; // Base registration
                        if ($profile) {
                            if ($profile->address && $profile->languages) $completion += 15;
                            if ($profile->service_pincode && $agent->serviceableCities->count() > 0) $completion += 15;
                            if ($agent->insuranceSegments->count() > 0) $completion += 15;
                            if ($agent->portfolios->count() > 0) $completion += 15;
                            if ($profile->profile_photo_path) $completion += 10;
                            if ($agent->leadPreferences) $completion += 15;
                        }
                        
                        // If all mandatory steps are submitted (pending), it's 100%
                        if ($agent->status === 'pending') {
                            $completion = 100;
                        }
                        $completion = min($completion, 100);
                    @endphp
                    <h2 class="mb-0 font-weight-bold agent-name-text">{{ $displayName }} <span class="badge starter-plan-badge ml-2">{{ $planName }}</span></h2>
                    <p class="text-muted mb-0 agent-role-text">Insurance Agent</p>
                </div>
            </div>
            <div class="dashboard-top-actions mt-3 mt-md-0">
                <a href="{{ route('agent.public-profile', ['slug' => ($agent->profile?->slug) ?: ($agent->id ?? 'agent')]) }}" class="btn btn-profile-view mr-3">View My Profile</a>
                <!-- <button class="btn btn-add-lead-top"><i class="fas fa-plus mr-2"></i>Add Lead</button> -->
            </div>
        </div>

        <!-- Tab Navigation Bar -->
        <div class="dashboard-nav-tabs-wrapper mb-4 px-2">
            <ul class="nav dashboard-main-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="far fa-user mr-2"></i>My Profile</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Leads (0)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Clients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Renewals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="far fa-image mr-2"></i>Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Reports</a>
                </li> -->
            </ul>
        </div>

        <!-- Overview Section Grid -->
        <div id="overview-content">
            <div class="row px-2">
                <!-- Performance Card -->
                <div class="col-lg-4 mb-4">
                    <div class="card premium-dashboard-card h-100">
                        <div class="card-body p-4">
                            <h5 class="card-section-title mb-4">Performance Overview</h5>
                            
                            <div class="performance-item mb-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="perf-label">Lead Conversion Rate</span>
                                    <span class="perf-value">{{ $dashboardStats['conversionRate'] }}%</span>
                                </div>
                                <div class="progress perf-progress">
                                    <div class="progress-bar bg-navy" role="progressbar" style="width: {{ $dashboardStats['conversionRate'] }}%"></div>
                                </div>
                            </div>
    
                            <div class="performance-item mb-4 pb-2 border-bottom">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="perf-label">Monthly Target</span>
                                    <span class="perf-value">{{ $dashboardStats['monthlyTarget'] }}%</span>
                                </div>
                                <div class="progress perf-progress">
                                    <div class="progress-bar bg-navy" role="progressbar" style="width: {{ $dashboardStats['monthlyTarget'] }}%"></div>
                                </div>
                            </div>
    
                            <div class="d-flex justify-content-between mb-3 pt-2 stats-item">
                                <span class="stats-label">Total Page Views</span>
                                <span class="stats-value">{{ number_format($dashboardStats['totalPageViews']) }}</span>
                            </div>
                            <div class="d-flex justify-content-between stats-item">
                                <span class="stats-label">Contact Requests</span>
                                <span class="stats-value">{{ number_format($dashboardStats['contactRequests']) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Lead Stats Grid Card -->
                <div class="col-lg-4 mb-4">
                    <div class="card premium-dashboard-card h-100">
                        <div class="card-body p-4">
                            <h5 class="card-section-title mb-4">Lead Stats</h5>
                            <div class="row lead-stats-grid">
                                <div class="col-6 mb-3">
                                    <div class="mini-stat-box box-blue">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <div class="stat-icon-wrap"><i class="fas fa-user-plus"></i></div>
                                            <span class="mini-bubble">{{ $dashboardStats['monthlyLeads'] }}</span>
                                        </div>
                                        <div class="mini-stat-big-num">{{ $dashboardStats['newLeads'] }}</div>
                                        <div class="mini-stat-label">New Leads</div>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="mini-stat-box box-green">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <div class="stat-icon-wrap"><i class="fas fa-users"></i></div>
                                            <span class="mini-bubble">{{ $dashboardStats['contactedLeads'] }}</span>
                                        </div>
                                        <div class="mini-stat-big-num">{{ $dashboardStats['contactedLeads'] }}</div>
                                        <div class="mini-stat-label">Contacted</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mini-stat-box box-teal">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <div class="stat-icon-wrap"><i class="fas fa-wave-square"></i></div>
                                            <span class="mini-bubble">{{ $dashboardStats['followUpLeads'] }}</span>
                                        </div>
                                        <div class="mini-stat-big-num">{{ $dashboardStats['followUpLeads'] }}</div>
                                        <div class="mini-stat-label">Follow-up</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mini-stat-box box-yellow">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <div class="stat-icon-wrap"><i class="fas fa-star"></i></div>
                                            <span class="mini-bubble">{{ $dashboardStats['closedLeads'] }}</span>
                                        </div>
                                        <div class="mini-stat-big-num">{{ $dashboardStats['closedLeads'] }}</div>
                                        <div class="mini-stat-label">Closed</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Sales Insights / Empty State -->
                <div class="col-lg-4 mb-4">
                    <div class="card premium-dashboard-card h-100">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-section-title mb-0">Sales Insights</h5>
                                <i class="fas fa-chart-line text-muted opacity-50"></i>
                            </div>
                            
                            <div class="row mb-5 text-center">
                                <div class="col-4">
                                    <div class="insight-label mb-1">Total Leads</div>
                                    <div class="insight-value">{{ $dashboardStats['totalLeads'] }}</div>
                                </div>
                                <div class="col-4 border-left">
                                    <div class="insight-label mb-1">Active</div>
                                    <div class="insight-value">{{ $dashboardStats['activeLeads'] }}</div>
                                </div>
                                <div class="col-4 border-left">
                                    <div class="insight-label mb-1">Closed</div>
                                    <div class="insight-value">{{ $dashboardStats['closedLeads'] }}</div>
                                </div>
                            </div>

                            <div class="row mb-3 text-center">
                                <div class="col-12">
                                    <div class="insight-label mb-1">Monthly Visits</div>
                                    <div class="insight-value">{{ $dashboardStats['monthlyVisits'] }}</div>
                                </div>
                            </div>
    
                            <div class="spacer flex-grow-1"></div>
    
                            <!-- <div class="empty-state-container text-center py-2">
                                <p class="no-leads-text mb-3">No leads yet</p>
                                <button class="btn btn-add-first-lead">
                                    <i class="fas fa-plus-circle mr-2"></i>Add Your First Lead
                                </button>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Recent Leads List -->
            <div class="px-2 mt-2 pb-5">
                <div class="card premium-dashboard-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="card-section-title mb-1">Recent Leads</h5>
                                <p class="text-muted small mb-0">Your latest potential clients</p>
                            </div>
                            <button class="btn btn-view-all" disabled>View All Leads</button>
                        </div>

                        @if($recentLeads->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <thead>
                                        <tr style="color:#64748b; font-size:13px;">
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Pincode</th>
                                            <th>Requirement</th>
                                            <th>Source</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentLeads as $lead)
                                            <tr>
                                                <td>{{ $lead->customer_name ?? 'Guest User' }}</td>
                                                <td>
                                                    <div>{{ $lead->customer_mobile ?? '-' }}</div>
                                                    <small class="text-muted">{{ $lead->customer_email ?? '-' }}</small>
                                                </td>
                                                <td>{{ $lead->customer_pincode ?? '-' }}</td>
                                                <td>{{ $lead->enquiry_requirements ?? '-' }}</td>
                                                <td style="text-transform: capitalize;">{{ $lead->interaction_type }}</td>
                                                <td>{{ $lead->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-list-display text-center py-5">
                                <div class="empty-icon-wrap mb-4">
                                    <i class="far fa-folder-open fa-3x"></i>
                                </div>
                                <p class="empty-msg-text">No leads found. Start adding leads to see them here.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- My Profile Section -->
        <div id="profile-content" style="display: none;">
            <!-- Profile Completion Card -->
            <div class="card premium-dashboard-card mb-4 mx-2">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="card-section-title mb-0">Profile Completion <span class="badge badge-warning text-white rounded-pill ml-2" style="background-color: #f59e0b; font-size: 11px; padding: 4px 10px;">{{ $completion }}%</span></h5>
                        <a href="{{ route('agent.edit-profile') }}" class="btn btn-add-lead-top"><i class="fas fa-edit mr-2"></i>Edit Profile</a>
                    </div>
                    <p class="text-muted small mb-3">Complete your profile to improve visibility and receive more leads</p>
                    
                    <div class="d-flex justify-content-between mb-1 small text-muted font-weight-bold">
                        <span>Overall Progress</span>
                        <span>{{ $completion }}%</span>
                    </div>
                    <div class="progress mb-4" style="height: 10px; border-radius: 10px; background-color: #f1f5f9;">
                        <div class="progress-bar" role="progressbar" style="width: {{ $completion }}%; background-color: #1a6d6d; border-radius: 10px;"></div>
                    </div>

                    <div class="row">
                    </div>
                </div>
            </div>

            <!-- Your Profile Information Card -->
            <div class="card premium-dashboard-card mx-2 mb-4">
                <div class="card-body p-4">
                    <h5 class="card-section-title mb-1">Your Profile Information</h5>
                    <p class="text-muted small mb-4">Information visible to potential clients</p>

                    <div class="row">
                        <div class="col-lg-6 mb-4 mb-lg-0 border-right-lg">
                            <div class="d-flex align-items-start mb-4">
                                <div class="agent-avatar-circle mr-3" style="width: 80px; height: 80px; font-size: 32px;">
                                    <span class="avatar-letter">{{ $displayInitial }}</span>
                                </div>
                                <div>
                                    <h5 class="font-weight-bold mb-1">{{ $displayName }}</h5>
                                    <p class="text-muted small mb-0">{{ $agent->experience_range ? $agent->experience_range . ' Years Exp.' : 'Experience not set' }}</p>
                                    @php
                                        // Get first city for display or count
                                        $cityDisplay = 'Location not set';
                                        if ($agent->serviceableCities->count() > 0) {
                                            $firstCity = $agent->serviceableCities->first()->name;
                                            $remain = $agent->serviceableCities->count() - 1;
                                            $cityDisplay = $firstCity . ($remain > 0 ? " +$remain more" : "");
                                        }
                                    @endphp
                                    <p class="text-muted small mb-0">{{ $cityDisplay }}</p>
                                </div>
                            </div>

                            <div class="contact-info mb-4">
                                <div class="small font-weight-bold mb-2">Contact</div>
                                <div class="d-flex align-items-center mb-2 text-muted small">
                                    <i class="far fa-envelope mr-3" style="width: 16px;"></i> {{ $agent->email }}
                                </div>
                                <div class="d-flex align-items-center text-muted small">
                                    <i class="fas fa-mobile-alt mr-3" style="width: 16px;"></i> {{ $agent->mobile ?? 'Not set' }}
                                </div>
                            </div>

                            <div class="languages-info">
                                <div class="small font-weight-bold mb-2">Languages</div>
                                <div>
                                    @if(!empty($profile?->languages))
                                        @foreach(explode(',', $profile->languages) as $lang)
                                            <span class="badge badge-primary px-3 py-1 rounded-pill mb-1 mr-1" style="background-color: #1a365d;">{{ trim(ucfirst($lang)) }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted small">Not set</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 pl-lg-4">
                             <div class="mb-4">
                                <div class="small font-weight-bold mb-1">Insurance Segments</div>
                                <div class="text-muted small">
                                    @if($agent->insuranceSegments->count() > 0)
                                        {{ $agent->insuranceSegments->pluck('segment_type')->map(fn($s)=>ucfirst($s))->implode(', ') }}
                                    @else
                                        Not selected
                                    @endif
                                </div>
                             </div>

                             <div class="mb-4">
                                <div class="small font-weight-bold mb-1">Serviceable Cities</div>
                                <div class="text-muted small">
                                    @if($agent->serviceableCities->count() > 0)
                                        {{ $agent->serviceableCities->take(5)->pluck('name')->implode(', ') }}
                                        {{ $agent->serviceableCities->count() > 5 ? '...' : '' }}
                                    @else
                                        Not set
                                    @endif
                                </div>
                             </div>

                             <div class="mb-0">
                                <div class="small font-weight-bold mb-1">Company/Agency</div>
                                          <div class="text-muted small">{{ $profile?->agency_name ?? 'Not set' }}</div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<script>
    // Initialize dashboard tabs
    (function() {
        let tabInitInProgress = false;

        function initializeDashboardTabs() {
            if (tabInitInProgress) return;
            tabInitInProgress = true;

            const dashboardTabs = document.querySelectorAll('.dashboard-main-tabs .nav-link');
            const overviewContent = document.getElementById('overview-content');
            const profileContent = document.getElementById('profile-content');
            const viewProfileBtn = document.querySelector('.btn-profile-view');

            if (!dashboardTabs.length || !overviewContent || !profileContent) {
                // If elements aren't ready, try again shortly
                tabInitInProgress = false;
                setTimeout(initializeDashboardTabs, 100);
                return;
            }

            const overviewLink = dashboardTabs[0];
            const profileLink = dashboardTabs[1];

            function setActiveState(activeId) {
                // Remove active class from all tabs
                dashboardTabs.forEach(link => link.classList.remove('active'));
                
                if (activeId === 'profile') {
                    if(profileLink) profileLink.classList.add('active');
                    if(overviewContent) overviewContent.style.display = 'none';
                    if(profileContent) profileContent.style.display = 'block';
                } else {
                    // Default to overview
                    if(overviewLink) overviewLink.classList.add('active');
                    if(overviewContent) overviewContent.style.display = 'block';
                    if(profileContent) profileContent.style.display = 'none';
                }
                // sessionStorage.setItem('agent_dashboard_tab', activeId); // Disabled for now to ensure default is Overview
            }

            overviewLink.onclick = function(e) {
                e.preventDefault();
                setActiveState('overview');
            };

            if (profileLink) {
                profileLink.onclick = function(e) {
                    e.preventDefault();
                    setActiveState('profile');
                };
            }

            // "View My Profile" button handler is now a direct link to the profile page

            // Force Overview by default on load as requested
            setActiveState('overview');

            tabInitInProgress = false;
            
            // Safety: ensure loader mask is hidden
            if (typeof $ !== 'undefined') {
                $('.loader-mask').fadeOut();
            }
            
            console.log('Dashboard tabs initialized (Default: Overview)');
        }

        // Run on load
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initializeDashboardTabs);
        } else {
            initializeDashboardTabs();
        }

        // Handle HTMX swap
        document.addEventListener('htmx:afterSwap', function(evt) {
            if (evt.detail.target.id === 'app-content' || evt.detail.target.querySelector('.dashboard-main-tabs')) {
                initializeDashboardTabs();
            }
        });

        // Handle Back/Forward Cache
        window.addEventListener('pageshow', function(event) {
            initializeDashboardTabs();
        });
    })();
</script>
@endsection
