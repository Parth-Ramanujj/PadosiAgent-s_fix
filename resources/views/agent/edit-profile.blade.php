@extends('layouts.app')

@section('content')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Agent Dashboard Styles -->
<link rel="stylesheet" href="{{ asset('css/agent-dashboard.css') }}">
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@include('layouts.header')
<div class="edit-profile-wrapper">
    <div class="container py-4">
        <!-- Progress Steps Header -->
        <div class="steps-header mb-4">
            <div class="step-item active" data-step="1">
                <div class="step-number">1</div>
                <div class="step-label">Basic Details</div>
            </div>
            <div class="step-item" data-step="2">
                <div class="step-number">2</div>
                <div class="step-label">Professional</div>
            </div>
            <div class="step-item" data-step="3">
                <div class="step-number">3</div>
                <div class="step-label">Insurance Segments</div>
            </div>
            <div class="step-item" data-step="4">
                <div class="step-number">4</div>
                <div class="step-label">Product Portfolio</div>
            </div>
            <div class="step-item" data-step="5">
                <div class="step-number">5</div>
                <div class="step-label">Additional</div>
            </div>
            <div class="step-item" data-step="6">
                <div class="step-number">6</div>
                <div class="step-label">Lead Preferences</div>
            </div>
            <div class="step-item" data-step="7">
                <div class="step-number">7</div>
                <div class="step-label">Declarations</div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card edit-profile-card">
            <div class="card-body p-4 p-md-5">
                <form id="edit-profile-form">
                    @csrf

                    <!-- Step 1: Basic Details -->
                    <div class="form-step active" id="step-1">
                        <div class="step-header mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="step-title mb-1"><i class="fas fa-user mr-2"></i>Basic Details</h4>
                                    <p class="step-subtitle text-muted mb-0">Your basic contact and identity information</p>
                                </div>
                                <span class="badge badge-primary">Mandatory</span>
                            </div>
                        </div>

                        <!-- Profile Photo Upload -->
                        <div class="text-center mb-5">
                            <div class="profile-photo-upload">
                                <label for="profile-photo" class="photo-circle mb-0 {{ ($agent->profile?->profile_photo_path ?? '') ? 'has-image' : '' }}" style="{{ ($agent->profile?->profile_photo_path ?? '') ? 'border-style: solid; background-color: white;' : '' }}">
                                    @if($agent->profile?->profile_photo_path ?? '')
                                        <img src="{{ $agent->profile?->profile_photo_url }}" alt="Profile Photo" onerror="this.onerror=null;this.src='{{ asset('img/avatar-icon.jpg') }}';">
                                    @else
                                        <i class="fas fa-camera fa-2x"></i>
                                    @endif
                                    <input type="file" id="profile-photo" name="profile_photo" accept="image/*" hidden>
                                </label>
                                <label for="profile-photo" class="upload-btn mt-3 d-block">
                                    <i class="fas fa-upload mr-2"></i>Upload professional photo
                                </label>
                                <small class="text-muted d-block mt-1">Max 5MB, JPG/PNG</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Your Full Name <span class="text-danger">*</span> <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Enter your legal name as it appears on your identity documents" style="font-size: 12px; cursor: help;"></i></label>
                                <input type="text" class="form-control" name="full_name" value="{{ $agent->fullname }}" placeholder="Enter your full name" maxlength="70" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '');">
                                <small class="text-muted">As per PAN</small>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Display Name (Public Profile) <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Provide the name you'd like customers to see on your public profile" style="font-size: 12px; cursor: help;"></i></label>
                                <input type="text" class="form-control" name="display_name" value="{{ $agent->profile->display_name ?? '' }}" placeholder="Name shown to customers" maxlength="35" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '');">
                                <small class="text-muted">This name will be shown to customers</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Mobile Number (Calling) <span class="text-danger">*</span> <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Your primary contact number for customer calls" style="font-size: 12px; cursor: help;"></i></label>
                                <input type="tel" class="form-control" name="mobile" value="{{ $agent->mobile }}" placeholder="9876543210" oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 10) this.value = this.value.slice(0, 10);">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">WhatsApp Number <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Your WhatsApp contact for chat inquiries" style="font-size: 12px; cursor: help;"></i></label>
                                <input type="tel" class="form-control" name="whatsapp" value="{{ $agent->profile->whatsapp ?? '' }}" placeholder="9876543210" oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 10) this.value = this.value.slice(0, 10);">
                                <div class="mt-3 d-flex align-items-center" style="gap: 8px;">
                                    <input type="checkbox" id="same-as-mobile" style="width: 16px; height: 16px; cursor: pointer;">
                                    <label for="same-as-mobile" class="mb-0 small text-muted" style="cursor: pointer; user-select: none;">Same as mobile number</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="form-label">Email ID <span class="text-danger">*</span> <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Your official email for account notifications and inquiries" style="font-size: 12px; cursor: help;"></i></label>
                                <input type="email" class="form-control" name="email" value="{{ $agent->email }}" placeholder="demo.agent@padosiagent.com">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="form-label">Languages You Speak <span class="text-danger">*</span> <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Select the languages you can fluently communicate in with customers" style="font-size: 12px; cursor: help;"></i></label>
                                
                                <!-- Selected Language Tags (Hidden when empty) -->
                                <div class="language-tags-display mb-0" id="selected-languages" style="display: none;">
                                    <!-- Tags will appear here when languages are selected -->
                                </div>

                                <!-- Custom Dropdown -->
                                <div class="custom-language-dropdown">
                                    <div class="dropdown-toggle-custom" id="language-dropdown-toggle">
                                        <span id="selected-count">0 selected</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                    <div class="dropdown-menu-custom" id="language-dropdown-menu">
                                        <div class="language-option">
                                            <input type="checkbox" id="lang-english" value="english">
                                            <label for="lang-english">
                                                <i class="far fa-circle"></i>
                                                <span>English</span>
                                            </label>
                                        </div>
                                        <div class="language-option">
                                            <input type="checkbox" id="lang-hindi" value="hindi">
                                            <label for="lang-hindi">
                                                <i class="far fa-circle"></i>
                                                <span>Hindi</span>
                                            </label>
                                        </div>
                                        <div class="language-option">
                                            <input type="checkbox" id="lang-gujarati" value="gujarati">
                                            <label for="lang-gujarati">
                                                <i class="far fa-circle"></i>
                                                <span>Gujarati</span>
                                            </label>
                                        </div>
                                        <div class="language-option">
                                            <input type="checkbox" id="lang-marathi" value="marathi">
                                            <label for="lang-marathi">
                                                <i class="far fa-circle"></i>
                                                <span>Marathi</span>
                                            </label>
                                        </div>
                                        <div class="language-option">
                                            <input type="checkbox" id="lang-tamil" value="tamil">
                                            <label for="lang-tamil">
                                                <i class="far fa-circle"></i>
                                                <span>Tamil</span>
                                            </label>
                                        </div>
                                        <div class="language-option">
                                            <input type="checkbox" id="lang-telugu" value="telugu">
                                            <label for="lang-telugu">
                                                <i class="far fa-circle"></i>
                                                <span>Telugu</span>
                                            </label>
                                        </div>
                                        <div class="language-option">
                                            <input type="checkbox" id="lang-kannada" value="kannada">
                                            <label for="lang-kannada">
                                                <i class="far fa-circle"></i>
                                                <span>Kannada</span>
                                            </label>
                                        </div>
                                        <div class="language-option">
                                            <input type="checkbox" id="lang-bengali" value="bengali">
                                            <label for="lang-bengali">
                                                <i class="far fa-circle"></i>
                                                <span>Bengali</span>
                                            </label>
                                        </div>
                                        <div class="language-option">
                                            <input type="checkbox" id="lang-punjabi" value="punjabi">
                                            <label for="lang-punjabi">
                                                <i class="far fa-circle"></i>
                                                <span>Punjabi</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Hidden input to store selected languages for form submission -->
                                <input type="hidden" name="languages" id="languages-input" value="{{ $agent->profile->languages ?? '' }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="form-label">Residence Address <span class="text-danger">*</span> <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Your current home/residential address" style="font-size: 12px; cursor: help;"></i></label>
                                <textarea class="form-control" name="address" rows="3" placeholder="Society/Building Name, Area, City, Pincode">{{ $agent->profile->address ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Professional Details -->
                    <div class="form-step" id="step-2">
                        <div class="step-header mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="step-title mb-1"><i class="fas fa-briefcase mr-2"></i>Professional</h4>
                                    <p class="step-subtitle text-muted mb-0">Your professional credentials and expertise</p>
                                </div>
                                <span class="badge badge-primary">Mandatory</span>
                            </div>
                        </div>

                        <!-- Info Alert -->
                        <div class="alert alert-info mb-4" style="background-color: #e0f2fe; border: 1px solid #bae6fd; border-radius: 10px;">
                            <i class="fas fa-info-circle mr-2"></i>
                            <small>Provide PAN Number for IRDAI Verified Badge on your Profile</small>
                        </div>

                        <!-- PAN and License -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">PAN Number <span class="text-danger">*</span> <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="For IRDAI Agency License verification purpose only." style="font-size: 12px; cursor: help;"></i></label>
                                <input type="text" class="form-control" name="pan" id="pan_number" value="{{ $agent->profile->pan_number ?? '' }}" placeholder="ABCDE1234F" maxlength="10" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">IRDAI License Number <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Backoffice will update this after PAN verification." style="font-size: 12px; cursor: help;"></i></label>
                                <input type="text" class="form-control" id="license_number" value="{{ $agent->profile->license_number ?? '' }}" placeholder="Will be updated by backoffice after verification" disabled>
                            </div>
                        </div>

                        <!-- Agency Name -->
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="form-label">Agency Name (If Any) <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="The name of your registered insurance agency or partnership" style="font-size: 12px; cursor: help;"></i></label>
                                <input type="text" class="form-control" name="agency_name" value="{{ $agent->profile->agency_name ?? '' }}" placeholder="Your agency/company name">
                            </div>
                        </div>

                        <!-- Office Address -->
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="form-label">Office Address (If Available) <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Complete address of your physical office location" style="font-size: 12px; cursor: help;"></i></label>
                                <textarea class="form-control" name="office_address" rows="2" placeholder="Office address">{{ $agent->profile->office_address ?? '' }}</textarea>
                            </div>
                        </div>

                        <!-- Service Pincode -->
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="form-label">Service Pincode <span class="text-danger">*</span> <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Pincode where service is available" style="font-size: 12px; cursor: help;"></i></label>
                                <input type="text" class="form-control" name="service_pincode" value="{{ $agent->profile->service_pincode ?? ($agent->profile->service_pincodes[0] ?? '') }}" placeholder="e.g., 380001" maxlength="6" pattern="\d{6}">
                                <small class="text-muted">Enter the 6-digit pincode where you provide services.</small>
                            </div>
                        </div>

                         <!-- Serviceable Cities and Experience -->
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="form-label">Serviceable Cities <span class="text-danger">*</span> <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Cities where you can provide in-person or localized insurance services" style="font-size: 12px; cursor: help;"></i></label>
                                
                                <style>
                                    /* Fix Select2 search input alignment and styling */
                                    .select2-container {
                                        direction: ltr !important;
                                    }

                                    .select2-container--default .select2-search--dropdown .select2-search__field {
                                        text-align: left !important;
                                        padding-left: 12px !important;
                                        padding-right: 12px !important;
                                        direction: ltr !important;
                                        border: 1px solid #e2e8f0 !important;
                                        border-radius: 8px !important;
                                        height: 38px !important;
                                        margin-top: 5px !important;
                                    }
                                    
                                    /* Inline search (inside the selection box) */
                                    .select2-container--default .select2-selection--multiple .select2-search--inline {
                                        float: left !important;
                                    }

                                    .select2-container--default .select2-selection--multiple .select2-search--inline .select2-search__field {
                                        text-align: left !important;
                                        margin-left: 5px !important;
                                        padding-left: 5px !important;
                                        direction: ltr !important;
                                    }

                                    .select2-container--default .select2-search--dropdown {
                                        padding: 8px 12px !important;
                                        background-color: #f8fafc;
                                    }

                                    .select2-container--default .select2-results__option--highlighted[aria-selected] {
                                        background-color: #0d9488 !important;
                                    }

                                    .select2-container--default .select2-selection--multiple {
                                        border: 1px solid #ced4da !important;
                                        border-radius: 10px !important;
                                        padding: 5px !important;
                                        min-height: 45px !important;
                                        display: flex !important;
                                        align-items: center !important;
                                        flex-wrap: wrap !important;
                                    }

                                    .select2-container--default.select2-container--focus .select2-selection--multiple {
                                        border-color: #0d9488 !important;
                                        box-shadow: 0 0 0 0.2rem rgba(13, 148, 136, 0.15) !important;
                                    }
                                </style>

                                <select class="form-control" name="serviceable_cities[]" id="serviceable-cities" multiple="multiple">
                                    @php
                                        $agentCities = $agent->serviceableCities->pluck('name')->toArray();
                                        $mainCities = [
                                            'Ahmedabad', 'Mumbai', 'Delhi', 'Bangalore', 'Hyderabad', 'Chennai', 'Kolkata', 'Pune', 'Surat', 
                                            'Jaipur', 'Lucknow', 'Kanpur', 'Nagpur', 'Indore', 'Thane', 'Bhopal', 'Visakhapatnam', 'Pimpri-Chinchwad', 
                                            'Patna', 'Vadodara', 'Ghaziabad', 'Ludhiana', 'Coimbatore', 'Agra', 'Madurai', 'Nashik', 'Vijayawada', 
                                            'Faridabad', 'Meerut', 'Rajkot', 'Kalyan-Dombivli', 'Vasai-Virar', 'Varanasi', 'Srinagar', 'Aurangabad', 
                                            'Dhanbad', 'Amritsar', 'Navi Mumbai', 'Allahabad', 'Howrah', 'Ranchi', 'Gwalior', 'Jabalpur', 
                                            'Coimbatore', 'Vijayawada', 'Jodhpur', 'Madurai', 'Raipur', 'Chandigarh', 'Guntur', 'Guwahati', 
                                            'Solapur', 'Noida', 'Mysuru', 'Gurgaon', 'Bhubaneswar', 'Thiruvananthapuram', 'Dehradun', 'Jammu', 
                                            'Jamnagar', 'Ujjain', 'Jhansi', 'Kochi', 'Mangalore', 'Udaipur', 'Ajmer', 'Tiruppur', 'Nellore', 
                                            'Kurnool', 'Gaya', 'Ujjain', 'Hoshiarpur', 'Muzaffarpur', 'Vellore', 'Shimla', 'Rohtak', 'Ambala', 
                                            'Gandhinagar', 'Pondicherry', 'Siliguri', 'Raurkela', 'Durgapur', 'Asansol'
                                        ];
                                        sort($mainCities);
                                    @endphp
                                    @foreach($mainCities as $city)
                                        <option value="{{ $city }}" {{ in_array($city, $agentCities) ? 'selected' : '' }}>{{ $city }}</option>
                                    @endforeach
                                    @foreach($agentCities as $city)
                                        @if(!in_array($city, $mainCities))
                                            <option value="{{ $city }}" selected>{{ $city }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <small class="text-muted">Type to search your city. You can also type and add a location if not listed.</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Years of Experience <span class="text-danger">*</span> <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Total number of years you have been active in the insurance industry" style="font-size: 12px; cursor: help;"></i></label>
                                <input type="number" class="form-control experience-trigger" name="experience_years" id="experience-input" value="{{ $agent->experience_range ?? '' }}" placeholder="15" min="0" max="60" value="{{ $agent->experience_range ?? '' }}"
                                        onkeydown="return event.keyCode !== 187 && event.keyCode !== 107 && event.keyCode !== 189 && event.keyCode !== 109 && event.keyCode !== 69" 
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 2) this.value = this.value.slice(0, 2);">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Approx Active Client Base <span class="text-danger">*</span> <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Estimated number of active customers you are currently serving" style="font-size: 12px; cursor: help;"></i></label>
                                <input type="number" class="form-control" name="client_base" value="{{ $agent->client_base ?? '' }}" placeholder="500" min="0" onkeydown="return event.keyCode !== 187 && event.keyCode !== 107 && event.keyCode !== 189 && event.keyCode !== 109 && event.keyCode !== 69" 
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 5) this.value = this.value.slice(0, 5);">
                            </div>
                        </div>

                        <!-- Family / Additional Licenses Section -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <label class="form-label mb-0">
                                    <i class="fas fa-users mr-2"></i>Family / Additional Licenses 
                                    <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Add family members who also hold insurance licenses to highlight your collective expertise" style="font-size: 12px; cursor: help;"></i>
                                </label>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="add-family-member">
                                    <i class="fas fa-plus mr-1"></i> Add Member
                                </button>
                            </div>

                            <!-- Column Headers -->
                            <div class="family-member-headers mb-2" style="display: none;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label font-weight-bold small mb-0">Full Name</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label font-weight-bold small mb-0">Relationship</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label font-weight-bold small mb-0">PAN / IRDAI License #</label>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                            </div>

                            <!-- Family Members Container -->
                            <div id="family-members-container">
                                <!-- Family member rows will be added here dynamically -->
                            </div>
                        </div>

                        <!-- POS License Selection -->
                        <div class="mb-4">
                            <label class="form-label d-block mb-2">Do you have POS License with any Broker? <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Whether you are registered as a Point of Sales Person (POSP) with any insurance broker" style="font-size: 12px; cursor: help;"></i></label>
                            <div class="d-flex align-items-center">
                                <div class="custom-control custom-radio custom-control-inline mr-4">
                                    <input type="radio" id="pos-yes" name="has_pos_license" class="custom-control-input" value="1" {{ ($agent->profile->has_pos_license ?? 0) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="pos-yes">Yes</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="pos-no" name="has_pos_license" class="custom-control-input" value="0" {{ !($agent->profile->has_pos_license ?? 0) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="pos-no">No</label>
                                </div>
                            </div>
                        </div>

                        <!-- Performance Statistics Section -->
                        <div class="performance-stats-section">
                            <h5 class="mb-3">
                                <i class="fas fa-chart-line mr-2"></i>Performance Statistics 
                                <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Your track record and success metrics to build trust with customers" style="font-size: 12px; cursor: help;"></i>
                            </h5>
                            <p class="text-muted small mb-4">Share your track record to help customers understand your experience and expertise.</p>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Claims Processed <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Total number of claims you have assisted customers with" style="font-size: 12px; cursor: help;"></i></label>
                                    <input type="number" class="form-control" name="claims_processed" id="claims_processed" value="{{ $agent->performanceStats->claims_processed ?? '' }}" placeholder="e.g., 150" min="0">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Claims Settled <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Number of claims successfully settled for your clients" style="font-size: 12px; cursor: help;"></i></label>
                                    <input type="number" class="form-control" name="claims_settled" id="claims_settled" value="{{ $agent->performanceStats->claims_settled ?? '' }}" placeholder="e.g., 145" min="0">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Total Claims Amount Settled <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="The total monetary value of claims settled through your assistance" style="font-size: 12px; cursor: help;"></i></label>
                                    <input type="text" class="form-control" name="claims_amount" id="claims_amount" value="{{ $agent->performanceStats->claims_amount ?? '' }}" placeholder="e.g., 25000000" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 10) this.value = this.value.slice(0, 10); updateClaimsAmountWords(this.value);">
                                    <div id="claims_amount_words" class="text-success small font-weight-bold mt-2" style="min-height: 18px;"></div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Claim Success Rate <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Percentage of claims successfully settled" style="font-size: 12px; cursor: help;"></i></label>
                                    <input type="text" class="form-control bg-light" name="success_rate" id="success_rate" value="{{ $agent->performanceStats->success_rate ?? '' }}" placeholder="Auto-calculated" readonly>
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label class="form-label">Typical Response Time <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Average time you take to respond to customer inquiries" style="font-size: 12px; cursor: help;"></i></label>
                                    <input type="text" class="form-control" name="response_time" value="{{ $agent->performanceStats->response_time ?? '' }}" placeholder="e.g., < 2 hours">
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <!-- Step 3: Insurance Segments -->
                    <div class="form-step" id="step-3">
                        <div class="step-header mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="step-title mb-1"><i class="fas fa-shield-alt mr-2"></i>Insurance Segments</h4>
                                    <p class="step-subtitle text-muted mb-0">Select the insurance types you specialize in</p>
                                </div>
                                <span class="badge badge-primary">Mandatory</span>
                            </div>
                        </div>

                        <div class="row">
                            @php
                                $agentSegments = $agent->insuranceSegments->pluck('segment_type')->map(function($item) {
                                    return strtolower($item);
                                })->toArray();
                            @endphp
                            <div class="col-md-6 mb-3">
                                <div class="segment-checkbox">
                                    <input type="checkbox" id="health" name="segments[]" value="health" {{ in_array('health', $agentSegments) ? 'checked' : '' }}>
                                    <label for="health">
                                        <i class="fas fa-heartbeat"></i>
                                        <span>Health Insurance</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="segment-checkbox">
                                    <input type="checkbox" id="life" name="segments[]" value="life" {{ in_array('life', $agentSegments) ? 'checked' : '' }}>
                                    <label for="life">
                                        <i class="fas fa-user-shield"></i>
                                        <span>Life Insurance</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="segment-checkbox">
                                    <input type="checkbox" id="motor" name="segments[]" value="motor" {{ in_array('motor', $agentSegments) ? 'checked' : '' }}>
                                    <label for="motor">
                                        <i class="fas fa-car"></i>
                                        <span>Motor Insurance</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="segment-checkbox">
                                    <input type="checkbox" id="sme" name="segments[]" value="sme" {{ in_array('sme', $agentSegments) ? 'checked' : '' }}>
                                    <label for="sme">
                                        <i class="fas fa-building"></i>
                                        <span>SME Insurance</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Expertise Rating Cards -->
                        <div id="expertise-containers" class="mt-4">
                            <!-- Health Expertise Card -->
                            <div class="expertise-card segment-expertise-card" id="expertise-health" style="display: {{ in_array('health', $agentSegments) ? 'block' : 'none' }};">
                                <div class="expertise-header">
                                    <i class="fas fa-heartbeat mr-2 text-danger"></i>
                                    <h6>Health Insurance</h6>
                                </div>
                                <p class="expertise-subtitle">Rate your expertise for each product (1 = Basic, 5 = Expert)</p>
                                
                                <div class="products-list" data-segment="health">
                                    @php $healthProducts = ['Mediclaim', 'Personal Accident', 'Critical Illness', 'Super Top-Up']; @endphp
                                    @foreach($healthProducts as $product)
                                        @include('agent.partials.product_rating_row', ['segment' => 'health', 'product' => $product])
                                    @endforeach
                                </div>

                                <div class="add-product-inline-container mt-3" id="add-container-health" style="display: none;">
                                    <div class="row align-items-center">
                                        <div class="col-md-9 mb-2 mb-md-0">
                                            <input type="text" class="form-control" placeholder="Enter product name..." id="new-product-input-health">
                                        </div>
                                        <div class="col-md-3 d-flex align-items-center">
                                            <button type="button" class="btn btn-teal mr-2" onclick="confirmAddProductInline('health')">Add</button>
                                            <button type="button" class="btn btn-link text-dark font-weight-bold" onclick="hideAddProductInline('health')">Cancel</button>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-sm btn-outline-secondary add-other-product-btn" id="add-btn-health" onclick="showAddProductInline('health')">
                                    <i class="fas fa-plus mr-1"></i> Add Other Product
                                </button>

                                @include('agent.partials.expertise_rating_guide')
                            </div>

                            <!-- Life Expertise Card -->
                            <div class="expertise-card segment-expertise-card" id="expertise-life" style="display: {{ in_array('life', $agentSegments) ? 'block' : 'none' }};">
                                <div class="expertise-header">
                                    <i class="fas fa-user-shield mr-2 text-primary"></i>
                                    <h6>Life Insurance</h6>
                                </div>
                                <p class="expertise-subtitle">Rate your expertise for each product (1 = Basic, 5 = Expert)</p>
                                
                                <div class="products-list" data-segment="life">
                                    @php $lifeProducts = ['Term Plan', 'Pension Plan', 'Guaranteed Plan', 'Saving Plan', 'ULIP Plan']; @endphp
                                    @foreach($lifeProducts as $product)
                                        @include('agent.partials.product_rating_row', ['segment' => 'life', 'product' => $product])
                                    @endforeach
                                </div>

                                <div class="add-product-inline-container mt-3" id="add-container-life" style="display: none;">
                                    <div class="row align-items-center">
                                        <div class="col-md-9 mb-2 mb-md-0">
                                            <input type="text" class="form-control" placeholder="Enter product name..." id="new-product-input-life">
                                        </div>
                                        <div class="col-md-3 d-flex align-items-center">
                                            <button type="button" class="btn btn-teal mr-2" onclick="confirmAddProductInline('life')">Add</button>
                                            <button type="button" class="btn btn-link text-dark font-weight-bold" onclick="hideAddProductInline('life')">Cancel</button>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-sm btn-outline-secondary add-other-product-btn" id="add-btn-life" onclick="showAddProductInline('life')">
                                    <i class="fas fa-plus mr-1"></i> Add Other Product
                                </button>

                                @include('agent.partials.expertise_rating_guide')
                            </div>

                            <!-- Motor Expertise Card -->
                            <div class="expertise-card segment-expertise-card" id="expertise-motor" style="display: {{ in_array('motor', $agentSegments) ? 'block' : 'none' }};">
                                <div class="expertise-header">
                                    <i class="fas fa-car mr-2 text-info"></i>
                                    <h6>Motor Insurance</h6>
                                </div>
                                <p class="expertise-subtitle">Rate your expertise for each product (1 = Basic, 5 = Expert)</p>
                                
                                <div class="products-list" data-segment="motor">
                                    @php $motorProducts = ['Private Car', 'Two Wheeler', 'Commercial Vehicle', '3 Wheeler']; @endphp
                                    @foreach($motorProducts as $product)
                                        @include('agent.partials.product_rating_row', ['segment' => 'motor', 'product' => $product])
                                    @endforeach
                                </div>

                                <div class="add-product-inline-container mt-3" id="add-container-motor" style="display: none;">
                                    <div class="row align-items-center">
                                        <div class="col-md-9 mb-2 mb-md-0">
                                            <input type="text" class="form-control" placeholder="Enter product name..." id="new-product-input-motor">
                                        </div>
                                        <div class="col-md-3 d-flex align-items-center">
                                            <button type="button" class="btn btn-teal mr-2" onclick="confirmAddProductInline('motor')">Add</button>
                                            <button type="button" class="btn btn-link text-dark font-weight-bold" onclick="hideAddProductInline('motor')">Cancel</button>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-sm btn-outline-secondary add-other-product-btn" id="add-btn-motor" onclick="showAddProductInline('motor')">
                                    <i class="fas fa-plus mr-1"></i> Add Other Product
                                </button>

                                @include('agent.partials.expertise_rating_guide')
                            </div>

                            <!-- SME Expertise Card -->
                            <div class="expertise-card segment-expertise-card" id="expertise-sme" style="display: {{ in_array('sme', $agentSegments) ? 'block' : 'none' }};">
                                <div class="expertise-header">
                                    <i class="fas fa-building mr-2 text-warning"></i>
                                    <h6>SME / Commercial</h6>
                                </div>
                                <p class="expertise-subtitle">Rate your expertise for each product (1 = Basic, 5 = Expert)</p>
                                
                                <div class="products-list" data-segment="sme">
                                    @php $smeProducts = ['Fire', 'Marine / Transport', 'Workmen Compensation', 'GPA / GMC', 'Group Term Insurance', 'Liability', 'Cyber']; @endphp
                                    @foreach($smeProducts as $product)
                                        @include('agent.partials.product_rating_row', ['segment' => 'sme', 'product' => $product])
                                    @endforeach
                                </div>

                                <div class="add-product-inline-container mt-3" id="add-container-sme" style="display: none;">
                                    <div class="row align-items-center">
                                        <div class="col-md-9 mb-2 mb-md-0">
                                            <input type="text" class="form-control" placeholder="Enter product name..." id="new-product-input-sme">
                                        </div>
                                        <div class="col-md-3 d-flex align-items-center">
                                            <button type="button" class="btn btn-teal mr-2" onclick="confirmAddProductInline('sme')">Add</button>
                                            <button type="button" class="btn btn-link text-dark font-weight-bold" onclick="hideAddProductInline('sme')">Cancel</button>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-sm btn-outline-secondary add-other-product-btn" id="add-btn-sme" onclick="showAddProductInline('sme')">
                                    <i class="fas fa-plus mr-1"></i> Add Other Product
                                </button>

                                @include('agent.partials.expertise_rating_guide')
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Product Portfolio -->
                    <div class="form-step" id="step-4">
                        <div class="step-header mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="step-title mb-1"><i class="fas fa-box-open mr-2"></i>Product Portfolio</h4>
                                    <p class="step-subtitle text-muted mb-0">Your company partnerships for each segment</p>
                                </div>
                                <span class="badge badge-primary">Mandatory</span>
                            </div>
                        </div>

                        <!-- Empty State -->
                        <div class="portfolio-empty-state" id="portfolio-empty-state">
                            <div class="empty-icon">
                                <i class="far fa-shield"></i>
                            </div>
                            <h5>Please select at least one insurance segment first</h5>
                            <button type="button" class="btn btn-outline-secondary" onclick="goToStep(3)">
                                Go to Segments
                            </button>
                        </div>

                        <!-- Portfolio Content (Hidden by default) -->
                        <div id="portfolio-content" style="display: none;">
                            <div class="mb-4">
                                <h4 class="segment-title mb-2">
                                    <i class="fas fa-briefcase"></i>
                                    Product Portfolio (Segment-wise)
                                    <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Specify your primary and secondary company tie-ups for each selected segment" style="font-size: 14px; cursor: help;"></i>
                                </h4>
                                <p class="text-muted small">For each segment, specify your primary and secondary company partnerships</p>
                            </div>

                            <!-- Dynamic Segment Containers -->
                            <div id="segment-portfolios">
                                <!-- Health, Life, etc. cards will be injected here -->
                            </div>

                        </div>
                    </div>

                    <!-- Step 5: Additional Information -->
                    <div class="form-step" id="step-5">
                        <div class="step-header mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="step-title mb-1"><i class="fas fa-plus mr-2"></i>Additional</h4>
                                    <p class="step-subtitle text-muted mb-0">Profile branding and digital presence</p>
                                </div>
                            </div>
                        </div>

                        <!-- Achievement Photos Section -->
                        <div class="achievement-photos-section mb-5">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <h5 class="mb-0 mr-3"><i class="far fa-images mr-2"></i>Achievement Photos</h5>
                                    <span class="badge badge-pill badge-primary-soft text-primary px-3 py-2" id="photo-count-badge" style="background-color: #e0f2fe; border: 1px solid #bae6fd;">0 uploaded</span>
                                    <i class="fas fa-info-circle text-muted ml-2" data-toggle="tooltip" title="Upload achievement photos, awards, recognitions, etc. (Max 5MB each)" style="font-size: 14px; cursor: help;"></i>
                                </div>
                                <button type="button" class="btn btn-outline-primary btn-upload-achievements" id="trigger-achievement-upload">
                                    <i class="fas fa-upload mr-2"></i>Upload
                                </button>
                                <input type="file" id="achievement-photos-input" name="achievement_photos[]" multiple accept="image/*" style="display: none;">
                            </div>
                            
                            <!-- Photos Preview Area -->
                            <div class="photos-preview-grid d-flex gap-3 flex-wrap" id="achievement-photos-preview">
                                <!-- Placeholders if needed, or dynamically added -->
                            </div>
                        </div>

                        <!-- Digital Presence Section -->
                        <div class="digital-presence-section mb-5">
                            <h5 class="mb-4"><i class="fas fa-globe mr-2"></i>Digital Presence (Optional) <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Links to your professional profiles to help customers find you online" style="font-size: 14px; cursor: help;"></i></h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Website</label>
                                    <input type="text" class="form-control" name="website" value="{{ $agent->profile->website_url ?? '' }}" placeholder="www.vimsmak.com">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Google Business Profile</label>
                                    <input type="url" class="form-control" name="google_business" value="{{ $agent->profile->social_links['google_business'] ?? '' }}" placeholder="Google Maps URL">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">LinkedIn</label>
                                    <input type="url" class="form-control" name="linkedin_url" value="{{ $agent->profile->social_links['linkedin'] ?? '' }}" placeholder="LinkedIn profile URL">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Instagram</label>
                                    <input type="url" class="form-control" name="instagram_url" value="{{ $agent->profile->social_links['instagram'] ?? '' }}" placeholder="Instagram profile URL">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Facebook</label>
                                    <input type="url" class="form-control" name="facebook_url" value="{{ $agent->profile->social_links['facebook'] ?? '' }}" placeholder="Facebook page URL">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">YouTube</label>
                                    <input type="url" class="form-control" name="youtube_url" value="{{ $agent->profile->social_links['youtube'] ?? '' }}" placeholder="YouTube channel URL">
                                </div>
                            </div>
                        </div>




                        <!-- Career Timeline Section -->
                        <div class="career-timeline-section mb-5">
                            <h5 class="mb-3"><i class="fas fa-history mr-2"></i>Career Timeline <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Add key milestones in your career" style="font-size: 14px; cursor: help;"></i></h5>
                            
                            <!-- Quick Start -->
                            <div class="card bg-light border-0 mb-4">
                                <div class="card-body">
                                    <h6 class="text-success mb-2"><i class="fas fa-magic mr-2"></i>Quick Start</h6>
                                    <p class="text-muted small mb-3">We recommend starting with when you began your insurance career:</p>
                                    <div class="d-flex flex-wrap">
                                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill mr-2 mb-2 quick-start-btn" data-type="Career Event" data-text="Started Insurance Career">Started Insurance Career</button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill mr-2 mb-2 quick-start-btn" data-type="Certification" data-text="Obtained IRDAI License">Obtained IRDAI License</button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill mb-2 quick-start-btn" data-type="Achievement" data-text="Top Performer Award">Top Performer Award</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Add Entry Form -->
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body p-3">
                                    <div class="row align-items-end">
                                        <div class="col-md-2 mb-3 mb-md-0">
                                            <label class="form-label small text-muted">Month</label>
                                            <select class="form-control" id="timeline-month" style="width: 100%;">
                                                @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                                    <option value="{{ $month }}">{{ $month }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 mb-3 mb-md-0">
                                            <label class="form-label small text-muted">Year</label>
                                            <select class="form-control" id="timeline-year" style="width: 100%;">
                                                @for($y = date('Y'); $y >= 1980; $y--)
                                                    <option value="{{ $y }}">{{ $y }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3 mb-md-0">
                                            <label class="form-label small text-muted">Type</label>
                                            <select class="form-control" id="timeline-type" style="width: 100%;">
                                                <option value="Career Event">Career Event</option>
                                                <option value="Achievement">Achievement</option>
                                                <option value="Certification">Certification</option>
                                                <option value="Milestone">Milestone</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3 mb-md-0">
                                            <label class="form-label small text-muted">Event / Achievement</label>
                                            <input type="text" class="form-control" id="timeline-text" placeholder="e.g., Started Insurance Career">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-success btn-block" id="add-timeline-btn">
                                                <i class="fas fa-plus mr-1"></i> Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Timeline List -->
                            <div class="timeline-container px-2" id="timeline-list">
                                @if(isset($agent->careerTimelines) && $agent->careerTimelines->count() > 0)
                                    @foreach($agent->careerTimelines as $index => $timeline)
                                        <div class="timeline-item-row mb-3 p-3 bg-white border rounded shadow-sm position-relative" id="timeline-row-{{ $index }}">
                                            <button type="button" class="btn btn-sm text-danger position-absolute top-0 right-0 mt-2 mr-2" onclick="removeTimelineItem({{ $index }})" style="right: 10px; top: 10px; z-index: 10;">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            <div class="d-flex align-items-center">
                                                <div class="timeline-date mr-4 text-center" style="min-width: 80px;">
                                                    <span class="d-block font-weight-bold text-dark">{{ $timeline->year }}</span>
                                                    <small class="text-muted">{{ $timeline->month }}</small>
                                                </div>
                                                <div class="timeline-content border-left pl-4 border-primary">
                                                    <span class="badge badge-pill badge-light mb-1 border">{{ $timeline->event_type }}</span>
                                                    <h6 class="mb-0 text-dark">{{ $timeline->event_text }}</h6>
                                                </div>
                                            </div>
                                            <input type="hidden" name="career_timelines[{{ $index }}][month]" value="{{ $timeline->month }}">
                                            <input type="hidden" name="career_timelines[{{ $index }}][year]" value="{{ $timeline->year }}">
                                            <input type="hidden" name="career_timelines[{{ $index }}][type]" value="{{ $timeline->event_type }}">
                                            <input type="hidden" name="career_timelines[{{ $index }}][event_text]" value="{{ $timeline->event_text }}">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-5 text-muted empty-state">
                                        <i class="far fa-calendar-alt fa-3x mb-3 text-light-gray" style="opacity: 0.3;"></i>
                                        <p class="mb-1">No timeline entries yet</p>
                                        <small>Start by adding when you began your insurance career</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Career Highlights Section -->
                        <div class="career-highlights-section mb-4">
                            <h5 class="mb-3"><i class="fas fa-ribbon mr-2"></i>Professional Bio <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Share notable achievements, awards (like MDRT/COT/TOT), and milestones" style="font-size: 14px; cursor: help;"></i></h5>
                            <textarea class="form-control" name="career_highlights" rows="5" maxlength="500" placeholder="Share your achievements, recognitions, and career milestones..." oninput="document.getElementById('bio-counter').innerText = this.value.length + '/500 characters'">{{ $agent->profile->career_highlights ?? '' }}</textarea>
                            <small class="text-muted d-block text-right mt-1" id="bio-counter">{{ strlen($agent->profile->career_highlights ?? '') }}/500 characters</small>
                        </div>
                    </div>

                    <!-- Step 6: Lead Preferences -->
                    <div class="form-step" id="step-6">
                        <div class="step-header mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0 text-muted small"><i class="fas fa-magic mr-2"></i>Lead Preferences</h5>
                                    <p class="step-subtitle text-muted mb-0">Configure your lead preferences</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h4 class="step-title mb-2">
                                <i class="fas fa-chart-line text-success mr-2"></i>Lead Preferences
                                <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Choose the customer leads you want to receive. Higher tier leads require verified experience." style="font-size: 14px; cursor: help;"></i>
                            </h4>
                            <p class="text-muted small">Configure the types of leads you want to receive. Some lead types require minimum experience.</p>
                        </div>

                        <div class="lead-preferences-container">
                            <!-- New Business Leads (All Agents) -->
                            <div class="lead-preference-card" id="lead-new-business">
                                <div class="lead-info">
                                    <div class="lead-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="lead-content">
                                        <h6>
                                            New Business Leads 
                                            <span class="lead-badge badge-all">All Agents</span>
                                            <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Inquiries from new customers looking for insurance policies" style="font-size: 13px; cursor: help;"></i>
                                        </h6>
                                        <p class="lead-desc">Receive leads from customers looking for new insurance policies</p>
                                    </div>
                                </div>
                                <div class="lead-switch">
                                    <label class="lead-toggle">
                                        <input type="checkbox" name="lead_types[]" value="new_business" {{ ($agent->leadPreferences->leads_new_business ?? false) ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
                            </div>

                            <!-- Portfolio Analysis Leads (5+ Years) -->
                            <div class="lead-preference-card locked flex-column align-items-stretch" id="lead-portfolio">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <div class="lead-info">
                                        <div class="lead-icon">
                                            <i class="fas fa-chart-line"></i>
                                        </div>
                                        <div class="lead-content">
                                            <h6>
                                                Portfolio Analysis Leads 
                                                <span class="lead-badge badge-experience-locked">5+ Years Experience</span>
                                                <i class="fas fa-lock text-muted mx-1" style="font-size: 13px;"></i>
                                                <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="Requests for comprehensive insurance portfolio reviews and gap analysis" style="font-size: 13px; cursor: help;"></i>
                                            </h6>
                                            <p class="lead-desc">Receive leads from customers seeking portfolio review services</p>
                                            <div class="lock-requirement experience-needed-text">
                                                <i class="fas fa-lock"></i> Requires <span class="years-left">5</span> more year(s) of experience to unlock
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lead-switch">
                                        <label class="lead-toggle">
                                            <input type="checkbox" name="lead_types[]" value="portfolio_analysis" class="lead-type-toggle" {{ ($agent->leadPreferences->leads_portfolio_analysis ?? false) ? 'checked' : '' }} {{ ($agent->profile->experience_years ?? 0) < 5 ? 'disabled' : '' }}>
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Portfolio Charging Preference -->
                                <div class="lead-charging-details" id="portfolio-charging" style="display: none;">
                                    <p class="charging-title">Charging Preference</p>
                                    <div class="charging-options">
                                        <label class="charging-option mb-0">
                                            <input type="radio" name="portfolio_charging" value="free" {{ ($agent->leadPreferences->portfolio_charging ?? 'free') == 'free' ? 'checked' : '' }}>
                                            <span>Free consultation</span>
                                        </label>
                                        <div>
                                            <label class="charging-option mb-0">
                                                <input type="radio" name="portfolio_charging" value="conditional" {{ ($agent->leadPreferences->portfolio_charging ?? '') == 'conditional' ? 'checked' : '' }}>
                                                <span>Free if policy purchased (Otherwise Consultation Fee)</span>
                                            </label>
                                            <div class="inline-input-group mt-2 portfolio-fee-input" style="display: none;">
                                                <span>Consultation Fee: ₹</span>
                                                <input type="number" class="charging-input" name="portfolio_fee_conditional" value="{{ ($agent->leadPreferences->portfolio_charging ?? '') == 'conditional' ? $agent->leadPreferences->portfolio_fee : '' }}" placeholder="Enter amount" min="0" oninput="if(this.value < 0) this.value = 0;">
                                            </div>
                                        </div>
                                        <div>
                                            <label class="charging-option mb-0">
                                                <input type="radio" name="portfolio_charging" value="paid" {{ ($agent->leadPreferences->portfolio_charging ?? '') == 'paid' ? 'checked' : '' }}>
                                                <span>Paid consultation</span>
                                            </label>
                                            <div class="inline-input-group mt-2 portfolio-fee-input" style="display: none;">
                                                <span>Consultation Fee: ₹</span>
                                                <input type="number" class="charging-input" name="portfolio_fee_paid" value="{{ ($agent->leadPreferences->portfolio_charging ?? '') == 'paid' ? $agent->leadPreferences->portfolio_fee : '' }}" placeholder="Enter amount" min="0" oninput="if(this.value < 0) this.value = 0;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Claims Support Leads (10+ Years) -->
                            <div class="lead-preference-card locked flex-column align-items-stretch" id="lead-claims">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <div class="lead-info">
                                        <div class="lead-icon">
                                            <i class="fas fa-shield-alt"></i>
                                        </div>
                                        <div class="lead-content">
                                            <h6>
                                                Claims Support Leads 
                                                <span class="lead-badge badge-experience-locked">10+ Years Experience</span>
                                                <i class="fas fa-lock text-muted mx-1" style="font-size: 13px;"></i>
                                                <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="High-priority leads for customers needing help with insurance claim settlements" style="font-size: 13px; cursor: help;"></i>
                                            </h6>
                                            <p class="lead-desc">Receive leads from customers needing claims assistance</p>
                                            <div class="lock-requirement experience-needed-text">
                                                <i class="fas fa-lock"></i> Requires <span class="years-left">10</span> more year(s) of experience to unlock
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lead-switch">
                                        <label class="lead-toggle">
                                            <input type="checkbox" name="lead_types[]" value="claims_support" class="lead-type-toggle" {{ ($agent->leadPreferences->leads_claims_support ?? false) ? 'checked' : '' }} {{ ($agent->profile->experience_years ?? 0) < 10 ? 'disabled' : '' }}>
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Claims Charging Preference -->
                                <div class="lead-charging-details" id="claims-charging" style="display: none;">
                                    <p class="charging-title">Charging Preference</p>
                                    <div class="charging-options">
                                        <label class="charging-option mb-0">
                                            <input type="radio" name="claims_charging" value="free" {{ ($agent->leadPreferences->claims_charging ?? 'free') == 'free' ? 'checked' : '' }}>
                                            <span>Free consultation</span>
                                        </label>
                                        <div>
                                            <label class="charging-option mb-0">
                                                <input type="radio" name="claims_charging" value="fee" {{ ($agent->leadPreferences->claims_charging ?? '') == 'fee' ? 'checked' : '' }}>
                                                <span>Consultation Fee</span>
                                            </label>
                                            <div class="inline-input-group mt-2" id="claims-fee-input" style="display: none;">
                                                <span>Consultation Fee: ₹</span>
                                                <input type="number" class="charging-input" name="claims_fee_amount" value="{{ ($agent->leadPreferences->claims_charging ?? '') == 'fee' ? $agent->leadPreferences->claims_fee_amount : '' }}" placeholder="Enter amount" min="0" oninput="if(this.value < 0) this.value = 0;">
                                            </div>
                                        </div>
                                        <div>
                                            <label class="charging-option mb-0">
                                                <input type="radio" name="claims_charging" value="percentage" {{ ($agent->leadPreferences->claims_charging ?? '') == 'percentage' ? 'checked' : '' }}>
                                                <span>% of Claim Amount</span>
                                            </label>
                                            <div class="inline-input-group mt-2" id="claims-percentage-input" style="display: none;">
                                                <input type="number" class="charging-input" name="claims_percent" value="{{ ($agent->leadPreferences->claims_charging ?? '') == 'percentage' ? $agent->leadPreferences->claims_percent : '' }}" placeholder="Enter %" min="0" max="10" oninput="if(this.value < 0) this.value = 0; if(this.value > 10) this.value = 10;">
                                                <span>% (max 10%)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-5">

                        
                    </div>

                    <!-- Step 7: Declarations -->
                    <div class="form-step" id="step-7">
                        <div class="step-header mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="step-title mb-1"><i class="far fa-check-circle mr-2"></i>Declarations</h4>
                                    <p class="step-subtitle text-muted mb-0">Review and accept the terms</p>
                                </div>
                                <span class="badge badge-pill border px-3 py-2" style="background: white; color: #475569; font-weight: 500;">Mandatory</span>
                            </div>
                        </div>

                        <div class="declarations-container">
                            <h5 class="mb-3 d-flex align-items-center" style="font-weight: 700; color: #1e293b;">
                                <i class="far fa-shield-check mr-2" style="color: #0d9488; font-size: 20px;"></i>
                                Declarations & Consent
                            </h5>
                            <p class="text-muted small mb-4">Please review and accept the following declarations to complete your profile</p>

                            <div class="declaration-warning mb-4">
                                <i class="fas fa-exclamation-triangle"></i>
                                <span>By proceeding, you acknowledge that you have read and understood all the terms below.</span>
                            </div>

                            <div class="declaration-list mb-5">
                                <div class="declaration-pill">
                                    <div class="dot"></div>
                                    <span>All information provided is self-declared and accurate to the best of my knowledge</span>
                                </div>
                                <div class="declaration-pill">
                                    <div class="dot"></div>
                                    <span>Leads are not guaranteed and depend on customer preferences and search criteria</span>
                                </div>
                                <div class="declaration-pill">
                                    <div class="dot"></div>
                                    <span>PadosiAgent is a facilitation platform only and does not guarantee any business</span>
                                </div>
                                <div class="declaration-pill">
                                    <div class="dot"></div>
                                    <span>PadosiAgent does not charge any commission on policies sold or claims processed</span>
                                </div>
                                <div class="declaration-pill">
                                    <div class="dot"></div>
                                    <span>Any disputes shall be subject to the jurisdiction of courts in Ahmedabad, Gujarat</span>
                                </div>
                            </div>

                            <hr class="mb-0" style="border-top: 1px solid #e2e8f0; margin: 0 -30px;">

                            <label class="agree-checkbox-wrapper mb-0" for="final-agree">
                                <input type="checkbox" id="final-agree" name="final_declaration" style="display: none;" {{ in_array($agent->status, ['pending', 'active']) ? 'checked' : '' }}>
                                <div class="custom-checkbox {{ in_array($agent->status, ['pending', 'active']) ? 'checked' : '' }}"></div>
                                <span class="agree-text">
                                    I have read, understood, and agree to all the above declarations and the 
                                    <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                                </span>
                            </label>
                            <div id="declaration-error" class="text-danger small mt-2" style="display: none; padding-left: 36px; font-weight: 500;">
                                <i class="fas fa-exclamation-circle mr-1"></i> Please check the agreement to continue.
                            </div>
                        </div>

                        <div class="mt-4 p-3 rounded-lg" style="background: #f0fdf4; border: 1px solid #bbf7d0;">
                            <p class="text-success small mb-0 d-flex align-items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                Your profile will be reviewed by our team within 24-48 hours. You will be notified via email once approved.
                            </p>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="form-navigation mt-5 d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary btn-prev" id="prev-btn" style="display: none;">
                            <i class="fas fa-arrow-left mr-2"></i>Previous
                        </button>
                        <div class="ml-auto d-flex gap-2">
                            <!-- <button type="button" class="btn btn-outline-primary btn-preview mr-2" id="preview-btn">
                                <i class="fas fa-eye mr-2"></i>Preview
                            </button> -->
                            <button type="button" class="btn btn-primary btn-next" id="next-btn">
                                Next<i class="fas fa-arrow-right ml-2"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-submit" id="submit-btn" style="display: none;">
                                <i class="fas fa-check mr-2"></i>Submit Profile
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    let currentStep = 1;
    const totalSteps = 7;
    
    const prevBtn = $('#prev-btn');
    const nextBtn = $('#next-btn');
    const submitBtn = $('#submit-btn');
    const previewBtn = $('#preview-btn');

    // Profile Photo Upload Preview and Validation
    const profilePhotoInput = $('#profile-photo');
    const photoCircle = $('.photo-circle');

    profilePhotoInput.on('change', function(e) {
        const file = e.target.files[0];
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        const maxSize = 5 * 1024 * 1024; // 5MB

        if (!file) return;

        // Validation
        if (!allowedTypes.includes(file.type)) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid File Type',
                    text: 'Please upload a professional photo in JPG or PNG format.',
                    confirmButtonColor: '#0d9488'
                });
            } else {
                alert('Please upload a professional photo in JPG or PNG format.');
            }
            $(this).val('');
            return;
        }

        if (file.size > maxSize) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: 'The image size should not exceed 5MB.',
                    confirmButtonColor: '#0d9488'
                });
            } else {
                alert('The image size should not exceed 5MB.');
            }
            $(this).val('');
            return;
        }

        // Preview
        const reader = new FileReader();
        reader.onload = function(event) {
            // Remove icon if exists
            photoCircle.find('i').hide();
            // Remove old image if exists
            photoCircle.find('img').remove();
            // Add new image
            photoCircle.append(`<img src="${event.target.result}" alt="Profile Photo" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`);
            photoCircle.addClass('has-image');
            photoCircle.css('border-style', 'solid'); // Change from dashed to solid
            photoCircle.css('background-color', 'white');
        };
        reader.readAsDataURL(file);
    });

    // Lead Preferences Unlock Logic
    function updateLeadLocks() {
        const experience = parseInt($('#experience-input').val()) || 0;
        
        // Portfolio Analysis (5+ Years)
        const portfolioCard = $('#lead-portfolio');
        const portfolioSwitch = portfolioCard.find('input');
        const portfolioYearsLeft = portfolioCard.find('.years-left');
        
        if (experience >= 5) {
            portfolioCard.removeClass('locked');
            portfolioSwitch.prop('disabled', false);
            portfolioCard.find('.lock-requirement').html('<i class="fas fa-unlock text-success"></i> Unlocked');
            portfolioCard.find('.fa-lock').removeClass('fa-lock').addClass('fa-unlock').addClass('text-success');
        } else {
            portfolioCard.addClass('locked');
            portfolioSwitch.prop('disabled', true).prop('checked', false);
            const needed = 5 - experience;
            portfolioCard.find('.lock-requirement').html('<i class="fas fa-lock"></i> Requires ' + needed + ' more year(s) of experience to unlock');
            portfolioCard.find('.fa-unlock').removeClass('fa-unlock').addClass('fa-lock').removeClass('text-success');
        }

        // Claims Support (10+ Years)
        const claimsCard = $('#lead-claims');
        const claimsSwitch = claimsCard.find('input');
        
        if (experience >= 10) {
            claimsCard.removeClass('locked');
            claimsSwitch.prop('disabled', false);
            claimsCard.find('.lock-requirement').html('<i class="fas fa-unlock text-success"></i> Unlocked');
            claimsCard.find('.fa-lock').removeClass('fa-lock').addClass('fa-unlock').addClass('text-success');
        } else {
            claimsCard.addClass('locked');
            claimsSwitch.prop('disabled', true).prop('checked', false);
            const needed = 10 - experience;
            claimsCard.find('.lock-requirement').html('<i class="fas fa-lock"></i> Requires ' + needed + ' more year(s) of experience to unlock');
            claimsCard.find('.fa-unlock').removeClass('fa-unlock').addClass('fa-lock').removeClass('text-success');
        }
    }

    $('#experience-input').on('input change', updateLeadLocks);
    
    // Initial check
    updateLeadLocks();

    // Lead Charging Details Toggle
    $('.lead-type-toggle').on('change', function() {
        const type = $(this).val();
        const chargingDiv = type === 'portfolio_analysis' ? $('#portfolio-charging') : $('#claims-charging');
        
        if ($(this).is(':checked')) {
            chargingDiv.slideDown();
        } else {
            chargingDiv.slideUp();
        }
    });

    // Portfolio Charging Option Toggle
    $('input[name="portfolio_charging"]').on('change', function() {
        const val = $(this).val();
        // Hide all portfolio fee inputs first
        $('.portfolio-fee-input').hide();
        
        // Show specific one based on value
        if (val === 'conditional' || val === 'paid') {
            $(this).closest('div').find('.portfolio-fee-input').show();
        }
    });

    // Claims Charging Option Toggle
    $('input[name="claims_charging"]').on('change', function() {
        const val = $(this).val();
        $('#claims-fee-input, #claims-percentage-input').hide();
        
        if (val === 'fee') {
            $('#claims-fee-input').show();
        } else if (val === 'percentage') {
            $('#claims-percentage-input').show();
        }
    });

    // Initial check for charging details
    $('.lead-type-toggle').each(function() {
        const type = $(this).val();
        const chargingDiv = type === 'portfolio_analysis' ? $('#portfolio-charging') : $('#claims-charging');
        if ($(this).is(':checked') && !$(this).is(':disabled')) {
            chargingDiv.show();
        } else {
            chargingDiv.hide();
        }
    });

    // Initial check for charging options
    $('input[name="portfolio_charging"]:checked').trigger('change');
    $('input[name="claims_charging"]:checked').trigger('change');

    function showStep(step) {
        // Hide all steps
        $('.form-step').removeClass('active');
        
        // Show current step
        $(`#step-${step}`).addClass('active');
        
        // Update step indicators
        $('.step-item').removeClass('active');
        $(`#step-${step}`).addClass('active'); // This is already done by step-item logic usually, but let's be safe
        
        // Refresh checkmarks based on actual data
        $('.step-item').removeClass('completed');
        checkStepCompletion();
        
        // Ensure current step is active and NOT marked completed even if it has data (to show we are on it)
        const currentStepIndicator = $(`.step-item[data-step="${step}"]`);
        currentStepIndicator.addClass('active').removeClass('completed');
        
        // Update buttons
        if (prevBtn.length) prevBtn.toggle(step !== 1);
        if (nextBtn.length) nextBtn.toggle(step !== totalSteps);
        if (submitBtn.length) submitBtn.toggle(step === totalSteps);
        
        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });

        // Fix Select2 layout if entering Step 2
        if (parseInt(step) === 2) {
            if ($.fn.select2) {
                $('#serviceable-cities').select2({
                    placeholder: "Search or add cities...",
                    tags: true,
                    width: '100%'
                });
            }
        }

        // Fix Select2 layout if entering Step 5 (Career Timeline)
        if (parseInt(step) === 5) {
            if ($.fn.select2) {
                $('#timeline-month, #timeline-year, #timeline-type').select2({
                    minimumResultsForSearch: Infinity,
                    width: '100%'
                });
            }
        }
    }

    function validateStep(step) {
        let isValid = true;
        const currentStepEl = $(`#step-${step}`);
        
        // Clear previous errors
        currentStepEl.find('.is-invalid').removeClass('is-invalid');
        currentStepEl.find('.invalid-feedback').remove();

        const addError = (field, message) => {
            const input = currentStepEl.find(`[name="${field}"]`);
            input.addClass('is-invalid');
            input.after(`<div class="invalid-feedback">${message}</div>`);
            isValid = false;
        };

        if (step === 1) {
            if (!$('[name="full_name"]').val()) addError('full_name', 'Full Name is required');
            if (!$('[name="mobile"]').val()) addError('mobile', 'Mobile Number is required');
            if (!$('[name="email"]').val()) addError('email', 'Email is required');
            if (!$('[name="languages"]').val()) {
                $('#language-dropdown-toggle').addClass('is-invalid');
                $('#language-dropdown-toggle').after('<div class="invalid-feedback">At least one language is required</div>');
                isValid = false;
            }
            if (!$('[name="address"]').val()) addError('address', 'Residence Address is required');
        } else if (step === 2) {
            if (!$('[name="service_pincode"]').val()) addError('service_pincode', 'Service Pincode is required');
            if (!$('[name="serviceable_cities[]"]').val() || $('[name="serviceable_cities[]"]').val().length === 0) {
                const select2 = $('#serviceable-cities').next('.select2-container');
                select2.addClass('is-invalid-select2'); // Custom class for select2
                if (select2.next('.invalid-feedback').length === 0) {
                    select2.after('<div class="invalid-feedback d-block">At least one city is required</div>');
                }
                isValid = false;
            }
            if (!$('[name="experience_years"]').val()) addError('experience_years', 'Years of Experience is required');
            if (!$('[name="client_base"]').val()) addError('client_base', 'Client Base is required');

            // PAN Validation
            const pan = $('[name="pan"]').val().trim();

            if (!pan) {
                isValid = false;
                $('[name="pan"]').addClass('is-invalid');
                if ($('#step-2 .pan-license-error').length === 0) {
                    $('[name="pan"]').after('<div class="invalid-feedback d-block pan-license-error">PAN Number is required for IRDAI verification</div>');
                }
            } else {
                // Validate PAN Format
                const panRegex = /[A-Z]{5}[0-9]{4}[A-Z]{1}/;
                if (!panRegex.test(pan)) {
                    addError('pan', 'Please enter a valid PAN Number format (e.g., ABCDE1234F)');
                    isValid = false;
                }
            }
            
            // Validate Claim Stats
            const processed = parseInt($('#claims_processed').val()) || 0;
            const settled = parseInt($('#claims_settled').val()) || 0;
            if (settled > processed && processed > 0) {
                addError('claims_settled', 'Settled claims cannot exceed processed claims');
                $('#success_rate').addClass('is-invalid');
            } else if (settled > 0 && processed === 0) {
                addError('claims_processed', 'Processed claims are required if claims were settled');
                $('#success_rate').addClass('is-invalid');
            }

            // Final check on the calculated rate itself
            if ($('#success_rate').val() === 'Error') {
                isValid = false;
                $('#success_rate').addClass('is-invalid');
                if ($('#success_rate').next('.invalid-feedback').length === 0) {
                    $('#success_rate').after('<div class="invalid-feedback">Cannot proceed with invalid claim statistics.</div>');
                }
            }
        } else if (step === 3) {
            if ($('input[name="segments[]"]:checked').length === 0) {
                if ($('#step-3 .invalid-feedback').length === 0) {
                    $('#step-3 .row').after('<div class="invalid-feedback d-block mt-3">Please select at least one insurance segment</div>');
                }
                isValid = false;
            }
        } else if (step === 4) {
            // Validate that each selected segment has a primary company
            $('input[name="segments[]"]:checked').each(function() {
                const segment = $(this).val();
                const primaryCompany = $(`[name="portfolio[${segment}][primary_company]"]`).val();
                if (!primaryCompany) {
                    $(`[name="portfolio[${segment}][primary_company]"]`).addClass('is-invalid');
                    isValid = false;
                }
            });
            if (!isValid) {
                if ($('#step-4 .invalid-feedback-main').length === 0) {
                    $('#portfolio-content').prepend('<div class="alert alert-danger invalid-feedback-main">Please select a primary company for each segment</div>');
                }
            } else {
                $('.invalid-feedback-main').remove();
            }
        } else if (step === 6) {
            if ($('input[name="lead_types[]"]:checked').length === 0) {
                if ($('#step-6 .invalid-feedback').length === 0) {
                    $('.lead-preferences-container').after('<div class="invalid-feedback d-block">Please select at least one lead preference</div>');
                }
                isValid = false;
            }
        } else if (step === 7) {
            if (!$('#final-agree').is(':checked')) {
                $('#declaration-error').fadeIn();
                isValid = false;
            } else {
                $('#declaration-error').hide();
            }
        }

        if (!isValid) {
            const firstError = currentStepEl.find('.is-invalid, .is-invalid-select2').first();
            if (firstError.length) {
                $('html, body').animate({
                    scrollTop: firstError.offset().top - 100
                }, 500);
            }
        }

        return isValid;
    }

    function saveStepData(step) {
        return new Promise((resolve) => {
            const btn = $('#next-btn');
            const originalText = btn.html();
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');

            const formData = new FormData($('#edit-profile-form')[0]);
            formData.append('current_step', step);
            
            // Add achievement photos if we have any pending in memory
            if (selectedAchievementPhotos.length > 0) {
                 selectedAchievementPhotos.forEach((file, index) => {
                    formData.append(`achievement_photos[${index}]`, file);
                });
            }

            $.ajax({
                url: "{{ route('agent.update-profile') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    btn.prop('disabled', false).html(originalText);

                    if (step === 1 && response.profile_photo_url) {
                        const photoUrl = `${response.profile_photo_url}?v=${Date.now()}`;
                        photoCircle.find('i').hide();
                        photoCircle.find('img').remove();
                        photoCircle.append(`<img src="${photoUrl}" alt="Profile Photo" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`);
                        photoCircle.addClass('has-image').css('border-style', 'solid').css('background-color', 'white');
                    }

                    if (step === 5) {
                        // Clear the temporary array after successful save to prevent duplicates
                        selectedAchievementPhotos = [];
                        if (typeof renderAchievementPhotos === 'function') {
                            renderAchievementPhotos();
                        }
                    }

                    resolve(true);
                },
                error: function(xhr) {
                    btn.prop('disabled', false).html(originalText);
                    
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        let errorMsg = 'Please fix the validation errors.';
                        
                        // If we have specific error messages, use the first one
                        const firstError = Object.values(errors)[0];
                        if (firstError) {
                            errorMsg = Array.isArray(firstError) ? firstError[0] : firstError;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Failed',
                            text: errorMsg,
                            confirmButtonColor: '#0d9488'
                        });
                        
                        // Highlight fields
                        Object.keys(errors).forEach(field => {
                            $(`[name="${field}"]`).addClass('is-invalid');
                        });
                        
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Failed to save progress.',
                            confirmButtonColor: '#0d9488'
                        });
                    }
                    resolve(false);
                }
            });
        });
    }

    nextBtn.on('click', function() {
        if (validateStep(currentStep)) {
            // Save data before moving to next step
            saveStepData(currentStep).then(function(success) {
                if (success) {
                    // Mark current step as completed in header
                    $(`.step-item[data-step="${currentStep}"]`).addClass('completed');
                    
                    if (currentStep < totalSteps) {
                        currentStep++;
                        showStep(currentStep);
                    }
                }
            });
        }
    });

    prevBtn.on('click', function() {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });

    // Step item click navigation with restriction
    $('.step-item').on('click', function() {
        const targetStep = parseInt($(this).attr('data-step'));
        
        // Allow going back or staying on same step
        if (targetStep <= currentStep) {
            currentStep = targetStep;
            showStep(currentStep);
            return;
        }

        // Check if all MANDATORY steps between current and target are completed
        // Mandatory steps: 1, 2, 3, 4, 6 (Step 5 is optional)
        const mandatorySteps = [1, 2, 3, 4, 6];
        let blockedStep = null;

        for (let s = 1; s < targetStep; s++) {
            // If it's a mandatory step and NOT completed
            if (mandatorySteps.includes(s) && !$(`.step-item[data-step="${s}"]`).hasClass('completed')) {
                blockedStep = s;
                break;
            }
        }

        if (blockedStep === null) {
            // If jumping to the VERY NEXT step, try to save current first
            if (targetStep === currentStep + 1) {
                nextBtn.trigger('click');
            } else {
                currentStep = targetStep;
                showStep(currentStep);
            }
        } else {
            const stepName = $(`.step-item[data-step="${blockedStep}"] .step-label`).text();
            Swal.fire({
                icon: 'warning',
                title: 'Mandatory Section Incomplete',
                text: `Please complete and save the "${stepName}" section before proceeding to Step ${targetStep}.`,
                confirmButtonColor: '#0d9488'
            });
        }
    });

    // WhatsApp "Same as Mobile" Logic
    $('#same-as-mobile').on('change', function() {
        const mobileInput = $('input[name="mobile"]');
        const whatsappInput = $('input[name="whatsapp"]');
        
        if($(this).is(':checked')) {
            whatsappInput.val(mobileInput.val());
            whatsappInput.prop('readonly', true);
        } else {
            whatsappInput.prop('readonly', false);
        }
    });

    // Update WhatsApp if mobile changes while checkbox is checked
    $('input[name="mobile"]').on('input', function() {
        if($('#same-as-mobile').is(':checked')) {
            $('input[name="whatsapp"]').val($(this).val());
        }
    });

    // Preview button
    previewBtn.on('click', function() {
        alert('Profile preview functionality will be implemented here');
    });

    // Submit Profile Action
    $('#submit-btn').on('click', function(e) {
        e.preventDefault();
        
        // Final Declaration Check
        if (!$('#final-agree').is(':checked')) {
            // Show small toast
            if (typeof Swal !== 'undefined') {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    width: 'auto'
                });
                Toast.fire({
                    icon: 'error',
                    title: 'Please agree to the declarations'
                });
            } else {
                alert('Please check the agreement to continue.');
            }
            
            // Show inline error
            $('#declaration-error').fadeIn();
            
            // Highlight and shake the checkbox
            const wrapper = $('.agree-checkbox-wrapper');
            wrapper.addClass('shake-element');
            setTimeout(() => wrapper.removeClass('shake-element'), 500);
            
            return false;
        }

        // Performance Stats Validation Check
        if ($('#claims_processed').hasClass('is-invalid') || $('#claims_settled').hasClass('is-invalid')) {
             if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Statistics',
                    text: 'Please correct the Claims Processed and Settled values before submitting.'
                });
            } else {
                alert('Please correct the Claims Processed and Settled values before submitting.');
            }
            return false;
        }

        $('#declaration-error').hide();

        // Show Loading State
        const btn = $(this);
        const originalText = btn.html();
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Submitting...');

        // Prepare Form Data
        const formData = new FormData($('#edit-profile-form')[0]);
        formData.append('current_step', 7);

        // Add achievement photos
        selectedAchievementPhotos.forEach((file, index) => {
            formData.append(`achievement_photos[${index}]`, file);
        });

        // AJAX Submission
        $.ajax({
            url: "{{ route('agent.update-profile') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status === 'success') {
                    if (response.profile_photo_url) {
                        const photoUrl = `${response.profile_photo_url}?v=${Date.now()}`;
                        photoCircle.find('i').hide();
                        photoCircle.find('img').remove();
                        photoCircle.append(`<img src="${photoUrl}" alt="Profile Photo" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`);
                        photoCircle.addClass('has-image').css('border-style', 'solid').css('background-color', 'white');
                    }

                    // Mark step 7 as completed
                    $(`.step-item[data-step="7"]`).addClass('completed');
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Profile Under Review!',
                        text: response.message,
                        confirmButtonColor: '#0d9488'
                    }).then(() => {
                        window.location.href = response.redirect || "{{ route('agent.dashboard') }}";
                    });
                }
            },
            error: function(xhr) {
                btn.prop('disabled', false).html(originalText);
                let message = 'Something went wrong. Please try again.';
                
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    message = 'Please fix the validation errors.';
                    const firstError = errors ? Object.values(errors)[0] : null;
                    if (firstError) {
                        message = Array.isArray(firstError) ? firstError[0] : firstError;
                    }
                    // Highlight errors on specific steps if possible
                    console.log('Validation Errors:', errors);
                    
                    // Show general error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Failed',
                        text: message,
                        confirmButtonColor: '#0d9488'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON ? xhr.responseJSON.message : message,
                        confirmButtonColor: '#0d9488'
                    });
                }
            }
        });
    });

    // Hide error when user checks the box
    $('#final-agree').on('change', function() {
        const customCheck = $(this).siblings('.custom-checkbox');
        if ($(this).is(':checked')) {
            $('#declaration-error').fadeOut();
            $(`.step-item[data-step="7"]`).addClass('completed');
            customCheck.addClass('checked');
        } else {
            $(`.step-item[data-step="7"]`).removeClass('completed');
            customCheck.removeClass('checked');
        }
    });

    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Initialize
    showStep(currentStep);

    // Global navigation function for empty state button
    window.goToStep = function(step) {
        currentStep = step;
        showStep(currentStep);
    };

    // Segment Change Logic for Step 4
    const segmentPortfoliosContainer = $('#segment-portfolios');
    const portfolioEmptyState = $('#portfolio-empty-state');
    const portfolioContent = $('#portfolio-content');

    const segmentLabels = {
        'health': 'Health Insurance',
        'life': 'Life Insurance',
        'motor': 'Motor Insurance',
        'sme': 'SME Insurance'
    };

    /* const segmentCompanies = {
        'health': ['Star Health', 'HDFC ERGO', 'ICICI Lombard', 'Niva Bupa', 'Care Health'],
        'life': ['LIC', 'HDFC Life', 'ICICI Prudential', 'SBI Life', 'Max Life'],
        'motor': ['ICICI Lombard', 'Bajaj Allianz', 'HDFC ERGO', 'Tata AIG', 'Reliance General'],
        'sme': ['ICICI Lombard', 'HDFC ERGO', 'New India Assurance', 'United India', 'Oriental Insurance']
    }; */

    const companiesHealth = [
        'Aditya Birla Health Insurance Co. Limited',
        'Care Health Insurance Ltd. (formerly Religare Health Insurance)',
        'Galaxy Health and Allied Insurance Company Limited',
        'ManipalCigna Health Insurance Company Limited',
        'Niva Bupa Health Insurance Company Limited (formerly Max Bupa)',
        'Reliance Health Insurance Ltd.',
        'Star Health & Allied Insurance Co. Ltd. (India\'s first standalone health insurer)',
        'Narayana Health Insurance Company Limited',
        'Acko General Insurance Limited',
        'Agriculture Insurance Company of India Limited',
        'Bajaj General Insurance Limited',
        'Cholamandalam MS General Insurance Company Limited',
        'ECGC Limited',
        'Generali Central Insurance Company Limited',
        'Go Digit General Insurance Limited',
        'HDFC ERGO General Insurance Company Limited',
        'ICICI LOMBARD General Insurance Company Limited',
        'IFFCO TOKIO General Insurance Company Limited',
        'Zurich Kotak General Insurance Company Limited',
        'Kshema General Insurance Limited',
        'Liberty General Insurance Limited',
        'Magma General Insurance Limited',
        'National Insurance Company Limited',
        'Navi General Insurance Limited',
        'Raheja QBE General Insurance Co. Ltd.',
        'Reliance General Insurance Company Limited',
        'Royal Sundaram General Insurance Company Limited',
        'SBI General Insurance Company Limited',
        'Shriram General Insurance Company Limited',
        'Tata AIG General Insurance Company Limited',
        'The New India Assurance Company Limited',
        'The Oriental Insurance Company Limited',
        'United India Insurance Company Limited',
        'Universal Sompo General Insurance Company Limited',
        'Zuna General Insurance Ltd.'
    ];

    const companiesLife = [
        'Life Insurance Corporation of India',
        'Axis Max Life Insurance Limited',
        'HDFC Life Insurance Company Limited',
        'ICICI Prudential Life Insurance Company Limited',
        'Kotak Mahindra Life Insurance Company Limited',
        'Aditya Birla SunLife Insurance Company Limited',
        'TATA AIA Life Insurance Company Limited',
        'SBI Life Insurance Company Limited',
        'Bajaj Life Insurance Limited',
        'PNB MetLife India Insurance Company Limited',
        'Reliance Nippon Life Insurance Company Limited',
        'Aviva Life Insurance Company India Limited',
        'Sahara India Life Insurance Company Limited',
        'Shriram Life Insurance Company Limited',
        'Bharti AXA Life Insurance Company Limited',
        'Generali Central Life Insurance Company Limited',
        'Ageas Federal Life Insurance Company Limited',
        'Canara HSBC Life Insurance Company Limited',
        'Bandhan Life Insurance Limited',
        'Pramerica Life Insurance Company Limited',
        'Star Union Dai-Ichi Life Insurance Company Limited',
        'IndiaFirst Life Insurance Company Limited',
        'Edelweiss Life Insurance Company Limited',
        'CreditAccess Life Insurance Limited',
        'Acko Life Insurance Limited',
        'Go Digit Life Insurance Limited'
    ];

    const companiesGeneral = [
        'Acko General Insurance Limited',
        'Agriculture Insurance Company of India Limited',
        'Bajaj General Insurance Limited',
        'Cholamandalam MS General Insurance Company Limited',
        'ECGC Limited',
        'Generali Central Insurance Company Limited',
        'Go Digit General Insurance Limited',
        'HDFC ERGO General Insurance Company Limited',
        'ICICI LOMBARD General Insurance Company Limited',
        'IFFCO TOKIO General Insurance Company Limited',
        'Zurich Kotak General Insurance Company Limited',
        'Kshema General Insurance Limited',
        'Liberty General Insurance Limited',
        'Magma General Insurance Limited',
        'National Insurance Company Limited',
        'Navi General Insurance Limited',
        'Raheja QBE General Insurance Co. Ltd.',
        'Reliance General Insurance Company Limited',
        'Royal Sundaram General Insurance Company Limited',
        'SBI General Insurance Company Limited',
        'Shriram General Insurance Company Limited',
        'Tata AIG General Insurance Company Limited',
        'The New India Assurance Company Limited',
        'The Oriental Insurance Company Limited',
        'United India Insurance Company Limited',
        'Universal Sompo General Insurance Company Limited',
        'Zuna General Insurance Ltd.'
    ];

    const segmentCompanies = {
        health: companiesHealth,
        life: companiesLife,
        motor: companiesGeneral,
        sme: companiesGeneral
    };

    function updatePortfolioStep() {
        const selectedSegments = $('input[name="segments[]"]:checked');
        
        if (selectedSegments.length === 0) {
            portfolioEmptyState.show();
            portfolioContent.hide();
        } else {
            portfolioEmptyState.hide();
            portfolioContent.show();
            
            // For each selected segment, ensure a card exists
            selectedSegments.each(function() {
                const segmentValue = $(this).val();
                if ($(`#portfolio-card-${segmentValue}`).length === 0) {
                    addPortfolioCard(segmentValue);
                }
            });
            
            // Remove cards for unselected segments
            $('.portfolio-card').each(function() {
                const cardId = $(this).attr('id');
                const segmentValue = cardId.replace('portfolio-card-', '');
                if (!$(`input[name="segments[]"][value="${segmentValue}"]:checked`).length) {
                    $(this).remove();
                }
            });
        }
    }

    function addPortfolioCard(segment) {
        segment = segment.toLowerCase();
        const label = segmentLabels[segment] || segment.toUpperCase();
        const companies = segmentCompanies[segment] || [];
        const options = companies.map(c => `<option value="${c}">${c}</option>`).join('');

        const cardHtml = `
            <div class="portfolio-card" id="portfolio-card-${segment}">
                <h6>${label}</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Primary Company Name *</label>
                        <select class="form-control" name="portfolio[${segment}][primary_company]">
                            <option value="">Select company...</option>
                            ${options}
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Approx % of Business</label>
                        <input type="text" class="form-control" name="portfolio[${segment}][primary_percent]" placeholder="e.g., 60">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Secondary Company Name</label>
                        <select class="form-control" name="portfolio[${segment}][secondary_company]">
                            <option value="">Select company...</option>
                            ${options}
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Approx % of Business</label>
                        <input type="text" class="form-control" name="portfolio[${segment}][secondary_percent]" placeholder="e.g., 25">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label">Other Companies (Optional)</label>
                        <input type="text" class="form-control" name="portfolio[${segment}][other_companies]" placeholder="e.g., SBI Life, Max Life">
                    </div>
                </div>
            </div>
        `;
        segmentPortfoliosContainer.append(cardHtml);
    }

    // Listen for segment changes
    $(document).on('change', 'input[name="segments[]"]', function() {
        const segment = $(this).val();
        const card = $(`#expertise-${segment}`);
        
        if ($(this).is(':checked')) {
            card.slideDown(400, function() {
                // Scroll to the card after slideDown starts/completes
                $('html, body').animate({
                    scrollTop: card.offset().top - 100
                }, 600);
            });
        } else {
            card.slideUp();
        }
        
        updatePortfolioStep();
    });

    // Populate Custom Products Expertise
    @foreach($agent->productExpertise->where('is_custom', true) as $expertise)
        (function(segment, product, level) {
            const container = $(`.products-list[data-segment="${segment}"]`);
            if (container.length) {
                const newRow = `
                    <div class="product-rating-row" data-product="${product}">
                        <div class="product-name-wrapper">
                            <span class="product-name">${product}</span>
                            <i class="fas fa-times remove-custom-product-inline" onclick="removeCustomProduct(this)" title="Remove product"></i>
                            <input type="hidden" name="custom_products[${segment}][${product}]" value="1">
                        </div>
                        <div class="star-rating" data-segment="${segment}" data-product="${product}">
                            <i class="fas fa-star ${level >= 1 ? 'active' : ''}" data-value="1" onclick="setProductRating('${segment}', '${product}', 1, this)"></i>
                            <i class="fas fa-star ${level >= 2 ? 'active' : ''}" data-value="2" onclick="setProductRating('${segment}', '${product}', 2, this)"></i>
                            <i class="fas fa-star ${level >= 3 ? 'active' : ''}" data-value="3" onclick="setProductRating('${segment}', '${product}', 3, this)"></i>
                            <i class="fas fa-star ${level >= 4 ? 'active' : ''}" data-value="4" onclick="setProductRating('${segment}', '${product}', 4, this)"></i>
                            <i class="fas fa-star ${level >= 5 ? 'active' : ''}" data-value="5" onclick="setProductRating('${segment}', '${product}', 5, this)"></i>
                            <input type="hidden" name="expertise[${segment}][${product}]" value="${level}">
                        </div>
                    </div>
                `;
                container.append(newRow);
            }
        })({!! json_encode($expertise->segment_type) !!}, {!! json_encode($expertise->product_name) !!}, {{ $expertise->expertise_level }});
    @endforeach

    // Run once on load
    updatePortfolioStep();

    // Language Dropdown Functionality
    const languageDropdownToggle = $('#language-dropdown-toggle');
    const languageDropdownMenu = $('#language-dropdown-menu');

    // Toggle dropdown
    languageDropdownToggle.on('click', function(e) {
        e.stopPropagation();
        languageDropdownMenu.toggleClass('show');
        $(this).toggleClass('active');
    });

    // Close dropdown when clicking outside
    $(document).on('click', function(e) {
        if (languageDropdownToggle.length && !languageDropdownToggle.is(e.target) && languageDropdownToggle.has(e.target).length === 0 && 
            languageDropdownMenu.length && !languageDropdownMenu.is(e.target) && languageDropdownMenu.has(e.target).length === 0) {
            languageDropdownMenu.removeClass('show');
            languageDropdownToggle.removeClass('active');
        }
    });

    // Add event listeners to all language checkboxes
    $(document).on('change', '.language-option input[type="checkbox"]', function() {
        toggleLanguage(this);
    });

    // Family Member Add/Remove Functionality - VERSION 3.0 (jQuery)
    let familyMemberCount = 0;

    // Use event delegation for Add Member button
    $(document).on('click', '#add-family-member', function(e) {
        e.preventDefault();
        
        familyMemberCount++;
        
        const container = $('#family-members-container');
        const headers = $('.family-member-headers');
        
        // Show headers when first member is added
        if (container.children().length === 0) {
            headers.fadeIn();
        }
        
        const memberRow = createFamilyMemberRow(familyMemberCount);
        const $row = $(memberRow).hide();
        
        if (container.length) {
            container.append($row);
            $row.fadeIn(400);
            
            // Scroll to the new row if it's not the first one
            if (container.children().length > 1) {
                $('html, body').animate({
                    scrollTop: $row.offset().top - 150
                }, 500);
            }
        }
    });

    function createFamilyMemberRow(index) {
        return `
            <div class="family-member-row mb-3" data-index="${index}" style="background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; padding: 15px; transition: all 0.3s ease;">
                <div class="row align-items-center">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label class="form-label d-md-none small font-weight-bold">Full Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0"><i class="fas fa-user text-muted"></i></span>
                            </div>
                            <input type="text" class="form-control border-left-0" name="family_members[${index}][name]" placeholder="Name as per license">
                        </div>
                    </div>
                    <div class="col-md-3 mb-3 mb-md-0">
                        <label class="form-label d-md-none small font-weight-bold">Relationship</label>
                        <select class="form-control" name="family_members[${index}][relationship]">
                            <option value="">Select...</option>
                            <option value="father">Father</option>
                            <option value="mother">Mother</option>
                            <option value="spouse">Spouse</option>
                            <option value="son">Son</option>
                            <option value="daughter">Daughter</option>
                            <option value="brother">Brother</option>
                            <option value="sister">Sister</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label class="form-label d-md-none small font-weight-bold">PAN / License #</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0"><i class="fas fa-id-card text-muted"></i></span>
                            </div>
                            <input type="text" class="form-control border-left-0" name="family_members[${index}][license]" placeholder="License number or PAN">
                        </div>
                    </div>
                    <div class="col-md-1 text-right text-md-center">
                        <button type="button" class="btn btn-sm btn-light text-danger shadow-sm remove-family-member" onclick="removeFamilyMember(${index})" style="width: 38px; height: 38px; border-radius: 10px;">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
    }
    // Achievement Photos Functionality
    const achievementPhotosInput = $('#achievement-photos-input');
    const triggerAchievementUpload = $('#trigger-achievement-upload');
    const photosPreviewGrid = $('#achievement-photos-preview');
    const photoCountBadge = $('#photo-count-badge');
    let selectedAchievementPhotos = [];

    if (triggerAchievementUpload.length) {
        triggerAchievementUpload.on('click', function() {
            achievementPhotosInput.click();
        });
    }

    if (achievementPhotosInput.length) {
        achievementPhotosInput.on('change', function(e) {
            const files = Array.from(e.target.files);

            files.forEach(file => {
                if (!file.type.startsWith('image/')) return;
                
                // Check file size (5MB = 5 * 1024 * 1024 bytes)
                if (file.size > 5 * 1024 * 1024) {
                    alert(`File "${file.name}" exceeds 5MB limit and will be skipped.`);
                    return;
                }
                
                selectedAchievementPhotos.push(file);
                const reader = new FileReader();
                
                reader.onload = function(event) {
                    const previewItem = `
                        <div class="photo-preview-item" data-name="${file.name}">
                            <img src="${event.target.result}" alt="Achievement Photo">
                            <button type="button" class="remove-photo" onclick="removeAchievementPhoto('${file.name}')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    `;
                    photosPreviewGrid.append(previewItem);
                    updatePhotoCount();
                };
                
                reader.readAsDataURL(file);
            });
            
            // Reset input so same file can be chosen again if removed
            achievementPhotosInput.val('');
        });
    }

    window.removeAchievementPhoto = function(fileName) {
        selectedAchievementPhotos = selectedAchievementPhotos.filter(f => f.name !== fileName);
        $(`.photo-preview-item[data-name="${fileName}"]`).remove();
        updatePhotoCount();
    };

    function updatePhotoCount() {
        if (photoCountBadge.length) {
            const count = photosPreviewGrid.find('.photo-preview-item').length;
            photoCountBadge.text(`${count} uploaded`);
            photoCountBadge.removeClass('text-danger').addClass('text-primary');
            photoCountBadge.css({ 'background-color': '#e0f2fe', 'border-color': '#bae6fd' });
        }
    }
    // Safety: ensure loader mask is hidden
    if (typeof $ !== 'undefined') {
        $('.loader-mask').fadeOut();
    }

    // Select2 Initialization is now also handled in showStep to fix layout issues
    if ($.fn.select2) {
        $('#serviceable-cities').select2({
            placeholder: "Search or add cities...",
            tags: true, 
            tokenSeparators: [',', ' '],
            width: '100%'
        });
    }


    // Initialize complex fields with existing data
    if ($('#languages-input').val()) {
        const selectedLangs = $('#languages-input').val().split(',');
        selectedLangs.forEach(lang => {
            const checkbox = $(`#lang-${lang}`);
            if (checkbox.length) {
                checkbox.prop('checked', true);
                toggleLanguage(checkbox[0]);
            }
        });
    }

    // Populate Family Members
    @if($agent->familyLicenses->count() > 0)
        @foreach($agent->familyLicenses as $member)
            familyMemberCount++;
            (function(index, name, rel, lic) {
                if (index === 1) $('.family-member-headers').show();
                const row = createFamilyMemberRow(index);
                const $row = $(row);
                $row.find('[name^="family_members"][name$="[name]"]').val(name);
                $row.find('[name^="family_members"][name$="[relationship]"]').val(rel);
                $row.find('[name^="family_members"][name$="[license]"]').val(lic);
                $('#family-members-container').append($row);
            })({{ $loop->iteration }}, {!! json_encode($member->full_name) !!}, {!! json_encode($member->relationship) !!}, {!! json_encode($member->license_number) !!});
        @endforeach
    @endif

    // Populate Achievement Photos
    @if($agent->achievementPhotos->count() > 0)
        @foreach($agent->achievementPhotos as $photo)
            (function(url, id) {
                const previewItem = `
                    <div class="photo-preview-item" data-id="${id}">
                        <img src="${url}" alt="Achievement Photo" onerror="this.onerror=null;this.src='{{ asset('img/avatar-icon.jpg') }}';">
                        <button type="button" class="remove-photo" onclick="removeExistingPhoto(${id}, this)">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
                photosPreviewGrid.append(previewItem);
            })({!! json_encode($photo->photo_url) !!}, {{ $photo->id }});
        @endforeach
        updatePhotoCount();
    @endif

    window.removeExistingPhoto = function(id, btn) {
        if (confirm('Are you sure you want to remove this photo?')) {
            $(btn).closest('.photo-preview-item').remove();
            // We'll need a way to tell the backend to delete this photo
            // For now, let's just append an input
            $('#edit-profile-form').append(`<input type="hidden" name="remove_photos[]" value="${id}">`);
            updatePhotoCount();
        }
    };

    // Populate Portfolios (Wait for updatePortfolioStep to be defined or call it after)
    @if($agent->portfolios->count() > 0)
        @foreach($agent->portfolios as $portfolio)
            (function(segment, primary, primary_p, secondary, secondary_p, others) {
                segment = segment.toLowerCase();
                if ($(`#portfolio-card-${segment}`).length === 0) {
                    addPortfolioCard(segment);
                }
                const card = $(`#portfolio-card-${segment}`);
                card.find(`[name="portfolio[${segment}][primary_company]"]`).val(primary);
                card.find(`[name="portfolio[${segment}][primary_percent]"]`).val(primary_p);
                card.find(`[name="portfolio[${segment}][secondary_company]"]`).val(secondary);
                card.find(`[name="portfolio[${segment}][secondary_percent]"]`).val(secondary_p);
                card.find(`[name="portfolio[${segment}][other_companies]"]`).val(others);
            })({!! json_encode($portfolio->segment_type) !!}, {!! json_encode($portfolio->primary_companies['name'] ?? '') !!}, {!! json_encode($portfolio->primary_companies['percentage'] ?? '') !!}, {!! json_encode($portfolio->secondary_companies['name'] ?? '') !!}, {!! json_encode($portfolio->secondary_companies['percentage'] ?? '') !!}, {!! json_encode($portfolio->secondary_companies['others'] ?? '') !!});
        @endforeach
    @endif


    // Check for completed steps on load
    // Check for completed steps on load
    function checkStepCompletion() {
        // Step 1: Basic Info (Mandatory: Full Name, Mobile, Email, Languages, Address)
        if ($('[name="full_name"]').val() && $('[name="mobile"]').val() && $('[name="email"]').val() && 
            $('[name="languages"]').val() && $('[name="address"]').val()) {
            markStepComplete(1);
        }

        // Step 2: Professional (Mandatory: Pincode, Cities, Experience, Client Base)
        if ($('[name="service_pincode"]').val() && 
            ($('[name="serviceable_cities[]"]').val() && $('[name="serviceable_cities[]"]').val().length > 0) && 
            $('[name="experience_years"]').val() && $('[name="client_base"]').val()) {
            markStepComplete(2);
        }

        // Step 3: Segments (Mandatory: At least one segment checked)
        if ($('input[name="segments[]"]:checked').length > 0) {
            markStepComplete(3);
        }

        // Step 4: Portfolio (Mandatory: If segments selected, portfolios must exist)
        let step4Complete = false;
        const portfolioCards = $('.portfolio-card');
        if (portfolioCards.length > 0) {
             let allFilled = true;
             portfolioCards.each(function() {
                 if (!$(this).find('[name$="[primary_company]"]').val()) {
                     allFilled = false;
                 }
             });
             if (allFilled) step4Complete = true;
        } 
        if(step4Complete) markStepComplete(4);

        // Step 5: Additional (Optional - marked complete if it has any data)
        const hasTimelines = $('#timeline-list .timeline-item-row').length > 0;
        const hasHighlights = $('[name="career_highlights"]').val() && $('[name="career_highlights"]').val().trim().length > 0;
        const hasPhotos = $('.photo-preview-item').length > 0;
        const hasSocial = $('[name="website"]').val() || $('[name="google_business"]').val() || 
                           $('[name="linkedin_url"]').val() || $('[name="instagram_url"]').val();
        
        if (hasTimelines || hasHighlights || hasPhotos || hasSocial) {
            markStepComplete(5);
        }

        // Step 6: Lead Preferences (Mandatory: At least one type checked)
        if ($('input[name="lead_types[]"]:checked').length > 0) {
            markStepComplete(6);
        }

        // Step 7: Declaration (Mandatory: Checkbox)
        // Only mark step 7 as complete if previous mandatory steps (1-4, 6) are also complete
        const mandatoryStepsDone = $(`.step-item[data-step="1"]`).hasClass('completed') && 
                                  $(`.step-item[data-step="2"]`).hasClass('completed') && 
                                  $(`.step-item[data-step="3"]`).hasClass('completed') && 
                                  $(`.step-item[data-step="4"]`).hasClass('completed') && 
                                  $(`.step-item[data-step="6"]`).hasClass('completed');

        if ($('#final-agree').is(':checked') && mandatoryStepsDone) {
            markStepComplete(7);
        } else if (!$('#final-agree').is(':checked')) {
            $(`.step-item[data-step="7"]`).removeClass('completed');
        }
    }

    function markStepComplete(step) {
        $(`.step-item[data-step="${step}"]`).addClass('completed');
    }

    // Run completion check
    checkStepCompletion();
});
</script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
// Language selection functions (global scope for onclick handlers)
function toggleLanguage(checkbox) {
    const lang = checkbox.value;
    const label = checkbox.nextElementSibling;
    const langName = label.querySelector('span').textContent;
    const selectedLanguagesContainer = document.getElementById('selected-languages');
    const icon = label.querySelector('i');

    if (checkbox.checked) {
        // Add language tag
        const tag = document.createElement('span');
        tag.className = 'language-tag';
        tag.setAttribute('data-lang', lang);
        tag.innerHTML = `${langName} <i class="fas fa-times" onclick="removeLanguage('${lang}')"></i>`;
        selectedLanguagesContainer.appendChild(tag);
        
        // Change icon to checked
        icon.className = 'fas fa-check-circle';
    } else {
        // Remove language tag
        const tag = selectedLanguagesContainer.querySelector(`[data-lang="${lang}"]`);
        if (tag) {
            tag.remove();
        }
        
        // Change icon to unchecked
        icon.className = 'far fa-circle';
    }

    updateLanguageCount();
}

function removeLanguage(lang) {
    const checkbox = document.getElementById(`lang-${lang}`);
    if (!checkbox) return;
    
    const label = checkbox.nextElementSibling;
    const tag = document.querySelector(`[data-lang="${lang}"]`);
    const icon = label.querySelector('i');
    
    checkbox.checked = false;
    icon.className = 'far fa-circle';
    
    if (tag) {
        tag.remove();
    }
    
    updateLanguageCount();
}

function updateLanguageCount() {
    const selectedLanguagesContainer = document.getElementById('selected-languages');
    const selectedCountSpan = document.getElementById('selected-count');
    const languagesInput = document.getElementById('languages-input');
    
    const tags = selectedLanguagesContainer.querySelectorAll('.language-tag');
    const count = tags.length;
    
    selectedCountSpan.textContent = `${count} selected`;
    
    // Show/Hide container based on selection to manage gap
    if (count > 0) {
        selectedLanguagesContainer.style.display = 'flex';
        selectedLanguagesContainer.classList.add('mb-2');
    } else {
        selectedLanguagesContainer.style.display = 'none';
        selectedLanguagesContainer.classList.remove('mb-2');
    }
    
    // Update hidden input with comma-separated values
    const languages = Array.from(tags).map(tag => tag.getAttribute('data-lang'));
    languagesInput.value = languages.join(',');
}

// Remove family member function (global scope for onclick handlers)
function removeFamilyMember(index) {
    const $memberRow = $(`.family-member-row[data-index="${index}"]`);
    if ($memberRow.length) {
        $memberRow.fadeOut(300, function() {
            $(this).remove();
            
            // Hide headers if no members remain
            const $remainingMembers = $('.family-member-row');
            const $familyMemberHeaders = $('.family-member-headers');
            if ($remainingMembers.length === 0 && $familyMemberHeaders.length) {
                $familyMemberHeaders.fadeOut();
            }
        });
    }
}

// Product Expertise Functions
function setProductRating(segment, product, value, el) {
    const container = $(el).parent();
    container.find('i').removeClass('active');
    
    // Fill stars up to value
    container.find('i').each(function() {
        if ($(this).data('value') <= value) {
            $(this).addClass('active');
        }
    });
    
    // Update hidden input
    container.find('input[type="hidden"]').val(value);
}

function showAddProductInline(segment) {
    const container = $(`#add-container-${segment}`);
    const input = $(`#new-product-input-${segment}`);
    
    $(`#add-btn-${segment}`).hide();
    container.fadeIn();
    input.focus();
    
    // Add Enter key listener if not already added
    if (!input.data('enter-listener')) {
        input.on('keyup', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                confirmAddProductInline(segment);
            }
        });
        // Also prevent Enter from submitting the main form
        input.on('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });
        input.data('enter-listener', true);
    }
}

function hideAddProductInline(segment) {
    $(`#add-container-${segment}`).hide();
    $(`#add-btn-${segment}`).fadeIn();
    $(`#new-product-input-${segment}`).val('');
}

function confirmAddProductInline(segment) {
    const input = $(`#new-product-input-${segment}`);
    const name = input.val().trim();
    
    if (!name) {
        return;
    }

    const container = $(`.products-list[data-segment="${segment}"]`);
    
    // Check if already exists in this segment
    if (container.find(`.product-rating-row[data-product="${name}"]`).length > 0) {
        alert('This product is already listed.');
        return;
    }

    // Create new row
    const newRow = `
        <div class="product-rating-row" data-product="${name}">
            <div class="product-name-wrapper">
                <span class="product-name">${name}</span>
                <i class="fas fa-times remove-custom-product-inline" onclick="removeCustomProduct(this)" title="Remove product"></i>
                <input type="hidden" name="custom_products[${segment}][${name}]" value="1">
            </div>
            <div class="star-rating" data-segment="${segment}" data-product="${name}">
                <i class="fas fa-star" data-value="1" onclick="setProductRating('${segment}', '${name}', 1, this)"></i>
                <i class="fas fa-star" data-value="2" onclick="setProductRating('${segment}', '${name}', 2, this)"></i>
                <i class="fas fa-star" data-value="3" onclick="setProductRating('${segment}', '${name}', 3, this)"></i>
                <i class="fas fa-star" data-value="4" onclick="setProductRating('${segment}', '${name}', 4, this)"></i>
                <i class="fas fa-star" data-value="5" onclick="setProductRating('${segment}', '${name}', 5, this)"></i>
                <input type="hidden" name="expertise[${segment}][${name}]" value="0">
            </div>
        </div>
    `;
    
    const $newRow = $(newRow).hide();
    container.append($newRow);
    $newRow.fadeIn();
    
    hideAddProductInline(segment);
    
    // Smooth scroll to the new row if needed
    container.animate({
        scrollTop: container.prop("scrollHeight")
    }, 500);
}

function removeCustomProduct(btn) {
    $(btn).closest('.product-rating-row').fadeOut(300, function() {
        $(this).remove();
    });
}

// Career Timeline Logic
let timelineIndex = {{ isset($agent->careerTimelines) ? $agent->careerTimelines->count() : 0 }};

$(document).ready(function() {
    // Initialize Select2 for timelines if available
    if ($.fn.select2) {
        $('#timeline-month, #timeline-year, #timeline-type').select2({
            minimumResultsForSearch: Infinity, // Disable search for small lists
            width: '100%'
        });
    }

    // Quick Start Buttons
    $('.quick-start-btn').on('click', function() {
        const type = $(this).data('type');
        const text = $(this).data('text');
        
        // Update value and trigger change for Select2
        $('#timeline-type').val(type).trigger('change');
        $('#timeline-text').val(text);
        
        // Highlight/Focus the text input
        $('#timeline-text').focus().select();
    });

    // Career Timeline Date Validation Logic
    function updateTimelineMonthState() {
        const selectedYear = parseInt($('#timeline-year').val());
        const currentYear = new Date().getFullYear();
        const currentMonth = new Date().getMonth(); // 0-indexed
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        
        const $monthSelect = $('#timeline-month');
        const selectedMonth = $monthSelect.val();
        let firstAvailableMonth = null;

        $monthSelect.find('option').each(function(index) {
            if (selectedYear === currentYear && index > currentMonth) {
                $(this).prop('disabled', true);
            } else {
                $(this).prop('disabled', false);
                if (firstAvailableMonth === null) firstAvailableMonth = $(this).val();
            }
        });

        // If current selected month is now disabled, switch to first available
        if (selectedYear === currentYear && months.indexOf(selectedMonth) > currentMonth) {
            $monthSelect.val(firstAvailableMonth).trigger('change');
        }
        
        // Refresh Select2 if it's being used
        if ($.fn.select2 && $monthSelect.data('select2')) {
            $monthSelect.select2({
                minimumResultsForSearch: Infinity,
                width: '100%'
            });
        }
    }

    $(document).on('change', '#timeline-year', function() {
        updateTimelineMonthState();
    });

    // Run once on load
    setTimeout(updateTimelineMonthState, 500);

    // Add Timeline Event
    $('#add-timeline-btn').on('click', function() {
        const month = $('#timeline-month').val();
        const year = $('#timeline-year').val();
        const type = $('#timeline-type').val();
        const text = $('#timeline-text').val().trim();

        if (!text) {
            Swal.fire({
                icon: 'warning',
                title: 'Required',
                text: 'Please enter an event or achievement description.',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            return;
        }

        // Validate date (no future dates)
        const currentYear = new Date().getFullYear();
        const currentMonth = new Date().getMonth();
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const selectedMonthIndex = months.indexOf(month);
        
        if (parseInt(year) > currentYear || (parseInt(year) === currentYear && selectedMonthIndex > currentMonth)) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Date',
                text: 'You cannot select a future date for your career timeline.',
                confirmButtonColor: '#0d9488'
            });
            return;
        }

        // Remove empty state if present
        $('#timeline-list .empty-state').hide();

        const index = timelineIndex++;
        
        const newItem = `
            <div class="timeline-item-row mb-3 p-3 bg-white border rounded shadow-sm position-relative" id="timeline-row-${index}" style="display:none;">
                <button type="button" class="btn btn-sm text-danger position-absolute top-0 right-0 mt-2 mr-2" onclick="removeTimelineItem(${index})" style="right: 10px; top: 10px; z-index: 10;">
                    <i class="fas fa-times"></i>
                </button>
                <div class="d-flex align-items-center">
                    <div class="timeline-date mr-4 text-center" style="min-width: 80px;">
                        <span class="d-block font-weight-bold text-dark">${year}</span>
                        <small class="text-muted">${month}</small>
                    </div>
                    <div class="timeline-content border-left pl-4 border-primary">
                        <span class="badge badge-pill badge-light mb-1 border">${type}</span>
                        <h6 class="mb-0 text-dark">${text}</h6>
                    </div>
                </div>
                <input type="hidden" name="career_timelines[${index}][month]" value="${month}">
                <input type="hidden" name="career_timelines[${index}][year]" value="${year}">
                <input type="hidden" name="career_timelines[${index}][type]" value="${type}">
                <input type="hidden" name="career_timelines[${index}][event_text]" value="${text}">
            </div>
        `;

        const $newItem = $(newItem);
        $('#timeline-list').prepend($newItem); // Add to top for chronological effect (or append if preferred)
        $newItem.slideDown();

        // Reset text input
        $('#timeline-text').val('');
        
        updateTimelineButtonState();
    });
    
    // Initial check
    updateTimelineButtonState();

    // Number to Words (Indian System)
    window.numToWordsIndian = function(number) {
        if (number === "" || number === null) return "";
        number = parseInt(number);
        if (isNaN(number) || number === 0) return "";
        if (number > 99999999999) return "Amount too large to display";
        
        const units = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];
        const tens = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];
        
        function convert_less_than_thousand(n) {
            let res = "";
            if (n >= 100) {
                res += units[Math.floor(n / 100)] + " Hundred ";
                n %= 100;
            }
            if (n >= 20) {
                res += tens[Math.floor(n / 10)] + (n % 10 !== 0 ? " " + units[n % 10] : "");
            } else if (n > 0) {
                res += units[n];
            }
            return res.trim();
        }

        let res = "";
        
        // Handle Crores (can be more than 99)
        const crore = Math.floor(number / 10000000);
        number %= 10000000;
        
        if (crore > 0) {
            if (crore >= 100) {
                res += convert_less_than_thousand(crore) + " Crore ";
            } else {
                res += convert_less_than_thousand(crore) + " Crore ";
            }
        }

        const lakh = Math.floor(number / 100000);
        number %= 100000;
        if (lakh > 0) res += convert_less_than_thousand(lakh) + " Lakh ";

        const thousand = Math.floor(number / 1000);
        number %= 1000;
        if (thousand > 0) res += convert_less_than_thousand(thousand) + " Thousand ";

        const remaining = number;
        if (remaining > 0) {
            if (res !== "") res += "and ";
            res += convert_less_than_thousand(remaining);
        }
        
        return res.trim() + " Rupees Only";
    };

    window.updateClaimsAmountWords = function(value) {
        const display = document.getElementById('claims_amount_words');
        if (!display) return;
        if (!value) {
            display.innerText = '';
            return;
        }
        display.innerText = window.numToWordsIndian(value);
    };

    // Auto-calculate Claim Success Rate
    $('#claims_processed, #claims_settled').on('input', function() {
        const processed = parseInt($('#claims_processed').val()) || 0;
        const settled = parseInt($('#claims_settled').val()) || 0;
        const successRateField = $('#success_rate');

        if (settled > processed && processed > 0) {
            $(this).addClass('is-invalid');
            successRateField.val('Error').addClass('is-invalid');
        } else {
            $('#claims_processed, #claims_settled, #success_rate').removeClass('is-invalid');
            $('#claims_processed, #claims_settled, #success_rate').next('.invalid-feedback').remove();
            
            if (processed > 0) {
                const rate = ((settled / processed) * 100).toFixed(2);
                successRateField.val(rate + '%');
            } else {
                if (settled > 0) {
                    successRateField.val('Error').addClass('is-invalid');
                    $('#claims_settled').addClass('is-invalid');
                } else {
                    successRateField.val('0%');
                }
            }
        }
    });

    // Run calculation once on load if values exist
    if ($('#claims_processed').val() || $('#claims_settled').val()) {
        $('#claims_processed').trigger('input');
    }

    // Initialize claims amount words on load
    if ($('#claims_amount').val()) {
        updateClaimsAmountWords($('#claims_amount').val());
    }
});

function removeTimelineItem(index) {
    $(`#timeline-row-${index}`).slideUp(300, function() {
        $(this).remove();
        if ($('#timeline-list .timeline-item-row').length === 0) {
            $('#timeline-list .empty-state').fadeIn();
        }
        updateTimelineButtonState();
    });
}

function updateTimelineButtonState() {
    const btn = $('#add-timeline-btn');
    btn.prop('disabled', false);
    btn.html('<i class="fas fa-plus mr-1"></i> Add');
}

</script>
@endsection
