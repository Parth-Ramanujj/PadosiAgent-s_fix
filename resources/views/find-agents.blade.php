@extends('layouts.app')

@section('content')
<div class="sub_banner position-relative">
    @include('layouts.header')    
</div>

    <section class="benefit-con find-agents-con position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="find-agents-content">
                        <a href="javascript:void(0)" class="mobile-filter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.95301 2.25C4.96862 2.25 4.98429 2.25 5.00001 2.25L19.047 2.25C19.7139 2.24997 20.2841 2.24994 20.7398 2.30742C21.2231 2.36839 21.6902 2.50529 22.0738 2.86524C22.4643 3.23154 22.6194 3.68856 22.6875 4.16405C22.7501 4.60084 22.7501 5.14397 22.75 5.76358L22.75 6.54012C22.75 7.02863 22.75 7.45095 22.7136 7.80311C22.6743 8.18206 22.5885 8.5376 22.3825 8.87893C22.1781 9.2177 21.9028 9.4636 21.5854 9.68404C21.2865 9.8917 20.9045 10.1067 20.4553 10.3596L17.5129 12.0159C16.8431 12.393 16.6099 12.5288 16.4542 12.6639C16.0966 12.9744 15.8918 13.3188 15.7956 13.7504C15.7545 13.9349 15.75 14.1672 15.75 14.8729L15.75 17.605C15.7501 18.5062 15.7501 19.2714 15.6574 19.8596C15.5587 20.4851 15.3298 21.0849 14.7298 21.4602C14.1434 21.827 13.4975 21.7933 12.8698 21.6442C12.2653 21.5007 11.5203 21.2094 10.6264 20.8599L10.5395 20.826C10.1208 20.6623 9.75411 20.519 9.46385 20.3691C9.1519 20.208 8.8622 20.0076 8.64055 19.6957C8.41641 19.3803 8.32655 19.042 8.28648 18.6963C8.24994 18.381 8.24997 18.0026 8.25 17.5806L8.25 14.8729C8.25 14.1672 8.24555 13.9349 8.20442 13.7504C8.1082 13.3188 7.90342 12.9744 7.54584 12.6639C7.39014 12.5288 7.15692 12.393 6.48714 12.0159L3.54471 10.3596C3.09549 10.1067 2.71353 9.8917 2.41458 9.68404C2.09724 9.4636 1.82191 9.2177 1.61747 8.87893C1.41148 8.5376 1.32571 8.18206 1.28645 7.80311C1.24996 7.45094 1.24998 7.02863 1.25 6.54012L1.25001 5.81466C1.25001 5.79757 1.25 5.78054 1.25 5.76357C1.24996 5.14396 1.24991 4.60084 1.31251 4.16405C1.38064 3.68856 1.53576 3.23154 1.92618 2.86524C2.30983 2.50529 2.77695 2.36839 3.26024 2.30742C3.71592 2.24994 4.28607 2.24997 4.95301 2.25ZM3.44796 3.79563C3.1143 3.83772 3.0082 3.90691 2.95251 3.95916C2.90359 4.00505 2.83904 4.08585 2.79734 4.37683C2.75181 4.69454 2.75001 5.12868 2.75001 5.81466V6.50448C2.75001 7.03869 2.75093 7.38278 2.77846 7.64854C2.8041 7.89605 2.84813 8.01507 2.90174 8.10391C2.9569 8.19532 3.0485 8.298 3.27034 8.45209C3.50406 8.61444 3.82336 8.79508 4.30993 9.06899L7.22296 10.7088C7.25024 10.7242 7.2771 10.7393 7.30357 10.7542C7.86227 11.0685 8.24278 11.2826 8.5292 11.5312C9.12056 12.0446 9.49997 12.6682 9.66847 13.424C9.75036 13.7913 9.75022 14.2031 9.75002 14.7845C9.75002 14.8135 9.75 14.843 9.75 14.8729V17.5424C9.75 18.0146 9.75117 18.305 9.77651 18.5236C9.79942 18.7213 9.83552 18.7878 9.8633 18.8269C9.89359 18.8695 9.95357 18.9338 10.152 19.0363C10.3644 19.146 10.6571 19.2614 11.1192 19.442C12.0802 19.8177 12.7266 20.0685 13.2164 20.1848C13.695 20.2985 13.8527 20.2396 13.9343 20.1885C14.0023 20.146 14.1073 20.0597 14.1757 19.626C14.2478 19.1686 14.25 18.5234 14.25 17.5424V14.8729C14.25 14.843 14.25 14.8135 14.25 14.7845C14.2498 14.2031 14.2496 13.7913 14.3315 13.424C14.5 12.6682 14.8794 12.0446 15.4708 11.5312C15.7572 11.2826 16.1377 11.0685 16.6964 10.7542C16.7229 10.7393 16.7498 10.7242 16.7771 10.7088L19.6901 9.06899C20.1767 8.79508 20.496 8.61444 20.7297 8.45209C20.9515 8.298 21.0431 8.19532 21.0983 8.10391C21.1519 8.01507 21.1959 7.89605 21.2215 7.64854C21.2491 7.38278 21.25 7.03869 21.25 6.50448V5.81466C21.25 5.12868 21.2482 4.69454 21.2027 4.37683C21.161 4.08585 21.0964 4.00505 21.0475 3.95916C20.9918 3.90691 20.8857 3.83772 20.5521 3.79563C20.2015 3.75141 19.727 3.75 19 3.75H5.00001C4.27297 3.75 3.79854 3.75141 3.44796 3.79563Z" fill="#fff"/>
                            </svg>
                        </a>

                        <div class="find-agents-filter-wrapper">
                            <a href="javascript:void(0)" class="close-mobile-filter">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" fill="none">
                                    <circle cx="12" cy="12" r="10" stroke="#1C274C" stroke-width="1.5"/>
                                    <path d="M14.5 9.5L9.5 14.5M9.5 9.5L14.5 14.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            </a>
                            <div class="find-agents-filter">
                                <h3>Filters</h3>
                                <form action="{{ route('find.agents') }}" method="GET"
                                      hx-get="{{ route('find.agents') }}"
                                      hx-target=".find-agents-list"
                                      hx-select=".find-agents-list"
                                      hx-swap="outerHTML show:none"
                                      hx-indicator="#filter-indicator"
                                      hx-push-url="true">
                                    <div class="form-group">
                                        <label for="ServiceType">Service Type</label>
                                        <select class="selectbox" name="ServiceType" id="ServiceType">
                                            <option value="" {{ request('ServiceType') == '' ? 'selected' : '' }}>All Services</option>
                                            <option value="New Policy" {{ request('ServiceType') == 'New Policy' ? 'selected' : '' }}>New Policy</option>
                                            <option value="Claim Assistance" {{ request('ServiceType') == 'Claim Assistance' ? 'selected' : '' }}>Claim Assistance</option>
                                            <option value="Policy Review" {{ request('ServiceType') == 'Policy Review' ? 'selected' : '' }}>Policy Review</option>

                                        </select>
                                    </div>
                                    <div class="form-group" id="InsuranceTypeContainer">
                                        <label for="InsuranceType" id="InsuranceTypeLabel">Insurance Type</label>
                                        <div id="InsuranceTypeField">
                                            <select class="selectbox" name="InsuranceType" id="InsuranceType">
                                                <option value="">All Insurance Types</option>
                                                <option value="Life Insurance">Life Insurance</option>
                                                <option value="Health Insurance">Health Insurance</option>
                                                <option value="Auto Insurance">Auto Insurance</option>
                                                <option value="Home Insurance">Home Insurance</option>
                                                <option value="Travel Insurance">Travel Insurance</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group" id="InsuranceCompanyContainer" style="display: none;">
                                        <label for="InsuranceCompany">Insurance Company</label>
                                        <select class="selectbox" name="InsuranceCompany" id="InsuranceCompany">
                                            <option value="" disabled selected>Insurance Company</option>
                                            <option value="Life Insurance">Life Insurance</option>
                                            <option value="Health Insurance">Health Insurance</option>
                                            <option value="Auto Insurance">Auto Insurance</option>
                                            <option value="Home Insurance">Home Insurance</option>
                                            <option value="Travel Insurance">Travel Insurance</option>
                                        </select>
                                    </div>

                                    <div class="form-group" id="ComplaintTypeContainer" style="display: none;">
                                        <label for="ComplaintType">Complaint Type</label>
                                        <select class="selectbox" name="ComplaintType" id="ComplaintType">
                                            <option value="">All Types</option>
                                            <option value="Claim Rejection" {{ request('ComplaintType') == 'Claim Rejection' ? 'selected' : '' }}>Claim Rejection</option>
                                            <option value="Claim Delay" {{ request('ComplaintType') == 'Claim Delay' ? 'selected' : '' }}>Claim Delay</option>
                                            <option value="Claim Short settled" {{ request('ComplaintType') == 'Claim Short settled' ? 'selected' : '' }}>Claim Short settled</option>
                                            <option value="Mis-selling" {{ request('ComplaintType') == 'Mis-selling' ? 'selected' : '' }}>Mis-selling</option>
                                        </select>
                                    </div>

                                    <div class="filter-action-buttons">
                                        <button type="submit" class="apply-filter-btn no-interceptor">
                                            <span id="filter-indicator" class="htmx-indicator">
                                                <i class="fas fa-spinner fa-spin"></i>
                                            </span>
                                            <span class="btn-text">Apply</span>
                                        </button>
                                        <a href="{{ route('find.agents') }}" 
                                           class="clear-filter-btn no-interceptor text-decoration-none"
                                           hx-get="{{ route('find.agents') }}"
                                           hx-target=".find-agents-list"
                                           hx-select=".find-agents-list"
                                           hx-swap="outerHTML show:none"
                                           hx-push-url="true">Clear All Filters</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="find-agents-list">
                            @if(($shouldGateGuest ?? false) === true)
                            <div class="no-agents-found p-4" style="background-color: #f8f9fa; border-radius: 8px; border: 1px solid #e9ecef; margin-top: 20px;">
                                <h3 style="color: #0f5634; font-size: 20px; font-weight: 600; margin-bottom: 15px;">Complete Your Details to View Agents</h3>
                                <p style="font-size: 15px; color: #495057; margin-bottom: 20px;">Please complete the form popup to see the best matching agents in your area.</p>
                                <button type="button" class="all-btn" onclick="showQuickRegisterPopup()">Complete Details</button>
                            </div>
                            @else
                            <!-- Title -->
                            @if(!(request('ServiceType') == 'Claim Assistance' && !request()->filled('InsuranceCompany')))
                            <div class="find-agents-list-title mb-2">
                                <h3>{{ $agents->total() }} Insurance Agent{{ $agents->total() != 1 ? 's' : '' }} Available</h3>
                            </div>
                            @endif

                            @if(request('ServiceType') == 'Claim Assistance' && !request()->filled('InsuranceCompany'))
                            <div class="no-agents-found p-4" style="background-color: #f8f9fa; border-radius: 8px; border: 1px solid #e9ecef; margin-top: 20px;">
                                <h3 style="color: #d9534f; font-size: 20px; font-weight: 600; margin-bottom: 15px;">Complete Required Filters to View Agents</h3>
                                <p style="font-size: 15px; color: #495057; margin-bottom: 15px;">For Claim Assistance service, please select the following required filters to see matching agents:</p>
                                <ul style="list-style-type: none; padding-left: 0; margin-bottom: 15px;">
                                    <li style="font-size: 15px; color: #212529; font-weight: 600;"><i class="fas fa-building text-secondary me-2"></i> Insurance Company</li>
                                </ul>
                                <p style="font-size: 13px; color: #6c757d; margin-bottom: 0;">* Complaint Type is optional and can be used to further refine your search</p>
                            </div>
                            @elseif($agents->isEmpty())
                            <!-- No Agents found  -->
                            <div class="no-agents-found">
                                <h3>No Agents Found</h3>
                                <p>Try adjusting your filters to find more agents in your area.</p>
                                <a href="{{ route('find.agents') }}" class="all-btn no-interceptor text-decoration-none">Clear All Filters</a>
                            </div>
                            @else
                            <div id="agents-list">
                            <!-- Agents list -->
                            @foreach($agents as $agent)
                                @include('partials.agent-card', ['agent' => $agent])
                            @endforeach

                                <div id="load-more-wrapper" class="w-100">
                                    @if($agents->hasMorePages())
                                    <div class="find-more-agent-btn text-center">
                                        <a href="{{ $agents->nextPageUrl() }}" 
                                           class="all-btn no-interceptor text-decoration-none">
                                           Find More Agents
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Comparison Bar -->
    <div id="compare-bar" class="compare-bar">
        <div class="compare-bar-header w-100 d-flex align-items-center justify-content-between mb-2 d-sm-none">
            <div class="compare-info text-dark">
                <span id="compare-count-mobile">0</span>/3 Selected
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="compare-bar-control-btn text-danger border" onclick="clearComparison()" title="Clear and Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="compare-info d-none d-sm-block">
            <span id="compare-count">0</span>/3 Agents selected
        </div>
        
        <div class="compare-selected-agents" id="compare-selected-agents">
            <!-- Selected agents thumbs will appear here -->
        </div>

        <div class="compare-actions d-flex align-items-center">
            <button id="compare-now-btn" onclick="showComparisonModal()" disabled>Compare Now</button>
            <div class="d-none d-sm-flex" style="margin-left: 30px;">
                <button type="button" class="compare-bar-control-btn shadow-sm text-danger" onclick="clearComparison()" title="Clear and Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Comparison Modal -->
    <div class="modal fade" id="comparisonModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; overflow: hidden; border: none;">
                <div class="modal-header border-0 bg-light p-4">
                    <h5 class="modal-title font-weight-bold" style="font-size: 24px;">Agent Comparison</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" onclick="closeComparisonModal()" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="table-responsive">
                        <table class="comparison-table" id="comparison-table-content">
                            <!-- Content injected via JS -->
                        </table>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal" data-dismiss="modal" onclick="closeComparisonModal()">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    /* Tag Styles */
    .selected-tags-container {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 12px;
    }
    .insurance-tag {
        background-color: #1a56a6;
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 600;
    }
    .insurance-tag .remove-tag {
        cursor: pointer;
        font-size: 16px;
        line-height: 1;
        opacity: 0.8;
    }
    .insurance-tag .remove-tag:hover {
        opacity: 1;
    }

    /* Custom Dropdown Styles */
    .custom-multiselect-container {
        position: relative;
        width: 100%;
    }
    .multiselect-trigger {
        background-color: #1e704d;
        color: white;
        padding: 12px 20px;
        border-radius: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .multiselect-trigger:hover {
        background-color: #1a6344;
    }
    .multiselect-trigger .arrow {
        font-size: 12px;
        transition: transform 0.3s ease;
    }
    .custom-multiselect-container.active .multiselect-trigger .arrow {
        transform: rotate(180deg);
    }

    .multiselect-dropdown {
        position: absolute;
        top: 105%;
        left: 0;
        width: 100%;
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        z-index: 1000;
        display: none;
        max-height: 350px;
        overflow-y: auto;
        padding: 15px;
        border: 1px solid #eee;
    }
    .custom-multiselect-container.active .multiselect-dropdown {
        display: block;
    }

    .multiselect-option {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 10px 5px;
        cursor: pointer;
        transition: background 0.2s;
        border-radius: 8px;
        gap: 0;
    }
    .multiselect-option:hover {
        background-color: #f8fafc;
    }
    .multiselect-option input {
        display: none;
    }
    .multiselect-option .check-circle {
        width: 20px;
        height: 20px;
        border: 2px solid #cbd5e1;
        border-radius: 4px;
        margin-right: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        flex-shrink: 0;
        background-color: white;
    }
    .multiselect-option input:checked + .check-circle {
        border-color: #0d9488;
        background-color: #0d9488;
    }
    .multiselect-option input:checked + .check-circle::after {
        content: '\2713';
        color: white;
        font-size: 14px;
        font-weight: bold;
    }
    .multiselect-option span {
        font-size: 15px;
        color: #334155;
        line-height: 1;
        flex: 1;
    }

    /* Standard Selectbox styles for consistency */
    .filter-action-buttons {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 20px;
        width: 100%;
    }

    .apply-filter-btn {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 18px;
        font-family: "Urbanist", sans-serif;
        font-weight: 600;
        font-size: 16px;
        border-radius: 8px;
        background-color: var(--e-global-color-accent);
        color: white !important;
        border: 2px solid var(--e-global-color-accent);
        transition: all 0.3s ease-in-out;
        cursor: pointer;
        text-decoration: none;
        height: 48px;
    }

    .apply-filter-btn:hover {
        background-color: transparent;
        color: var(--e-global-color-accent) !important;
    }

    .find-agents-filter .clear-filter-btn {
        width: 100% !important;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 12px 18px;
        font-family: "Urbanist", sans-serif;
        font-weight: 600;
        font-size: 16px;
        border-radius: 8px;
        background-color: transparent;
        color: var(--e-global-color-accent) !important;
        border: 2px solid var(--e-global-color-accent) !important;
        transition: all 0.3s ease-in-out;
        cursor: pointer;
        text-decoration: none;
        height: 48px;
        margin-bottom: 0 !important;
    }

    .find-agents-filter .clear-filter-btn:hover {
        background-color: var(--e-global-color-accent);
        color: white !important;
    }

    /* Prevents Filter Overflow & Layout issues */
    .find-agents-con {
        min-height: 800px;
    }
    
    .find-agents-content {
        align-items: flex-start;
    }

    @media (min-width: 1181px) {
        .find-agents-filter-wrapper {
            position: sticky;
            top: 20px;
            z-index: 100;
        }
    }

    .insurance-multi-select {
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-height: 280px;
        overflow-y: auto;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 15px 12px;
        background: #fff;
    }

    /* Scrollbar Optimization */
    .multiselect-dropdown::-webkit-scrollbar {
        width: 6px;
    }
    .multiselect-dropdown::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    .multiselect-dropdown::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    /* HTMX Indicator Styles for Button */
    .htmx-indicator {
        display: none;
    }
    .htmx-request .htmx-indicator {
        display: inline-block;
    }
    .htmx-request.htmx-indicator {
        display: inline-block;
    }
    .htmx-request .btn-text {
        /* Optional: adjust text when loading */
    }

    /* HTMX Indicator Styles for Load More */
    .htmx-indicator-content {
        display: none;
    }
    .htmx-request .htmx-indicator-content {
        display: inline-block;
    }
    .htmx-request .default-content {
        display: none;
    }

    /* Comparison Bar */
    .compare-bar {
        position: fixed;
        bottom: -120px;
        left: 50%;
        transform: translateX(-50%);
        width: 95%;
        max-width: 700px;
        background: #fff;
        box-shadow: 0 -10px 40px rgba(0,0,0,0.12);
        border: 1px solid rgba(0,0,0,0.05);
        border-radius: 16px 16px 0 0;
        z-index: 1030;
        padding: 12px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: bottom 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .compare-bar.show {
        bottom: 0;
    }
    .compare-info {
        font-weight: 700;
        color: #1e293b;
        font-size: 15px;
    }
    .compare-selected-agents {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0 15px;
    }
    .selected-agent-thumb {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border: 2px solid #0d9488;
        position: relative;
        box-shadow: 0 4px 10px rgba(13, 148, 136, 0.2);
    }
    .selected-agent-thumb img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }
    .remove-compare {
        position: absolute;
        top: -4px;
        right: -4px;
        background: #ef4444;
        color: #fff;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: 2px solid #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .compare-actions button#compare-now-btn {
        background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%);
        color: #fff;
        border: none;
        padding: 10px 24px;
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 12px rgba(13, 148, 136, 0.3);
    }
    .compare-actions button#compare-now-btn:not(:disabled):hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(13, 148, 136, 0.4);
    }
    .compare-actions button#compare-now-btn:disabled {
        background: #e2e8f0;
        color: #94a3b8;
        box-shadow: none;
        cursor: not-allowed;
    }
    .compare-bar-control-btn {
        background: #ffffff;
        color: #475569; /* Slate 600 */
        border: 1.5px solid #f1f5f9;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 14px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    }
    .compare-bar-control-btn:hover {
        background: #ffffff;
        border-color: #0d9488;
        color: #0d9488;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .compare-bar-control-btn:active {
        transform: scale(0.92);
    }
    .compare-bar-control-btn.text-danger:hover {
        background: #fff1f2;
        border-color: #fca5a5;
        color: #ef4444;
    }
    .compare-info {
        font-weight: 700;
        color: #1e293b;
        font-size: 15px;
        letter-spacing: -0.01em;
    }

    @media (max-width: 576px) {
        .compare-bar {
            width: 100%;
            border-radius: 20px 20px 0 0;
            padding: 15px 20px calc(15px + env(safe-area-inset-bottom, 5px));
            flex-direction: column;
            gap: 15px;
            left: 0;
            transform: translateY(100%);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            bottom: 0;
            max-width: none;
        }
        .compare-bar.show {
            transform: translateY(0);
        }
        .compare-bar-control-btn {
            width: 30px;
            height: 30px;
            font-size: 13px;
        }
        .compare-info {
            font-size: 15px;
            font-weight: 700;
        }
        .compare-selected-agents {
            gap: 12px;
            padding: 0;
            margin: 5px 0;
            width: 100%;
            justify-content: center;
            order: 2;
        }
        .selected-agent-thumb {
            width: 54px;
            height: 54px;
        }
        .compare-actions {
            order: 3;
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .compare-actions button#compare-now-btn {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            border-radius: 12px;
        }
    }

    /* Comparison Table in Modal */
    .comparison-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 700px; /* Ensure horizontal scroll on mobile */
    }
    .comparison-table th, .comparison-table td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #e2e8f0;
    }
    .comparison-table th {
        background: #f8fafc;
        font-weight: 600;
        text-align: left;
    }
    .compare-agent-header {
        text-align: center;
    }
    .compare-agent-header img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-bottom: 10px;
        object-fit: cover;
    }
    .compare-agent-name {
        font-weight: 700;
        color: #1e293b;
        font-size: 16px;
    }
    .compare-row-title {
        color: #64748b;
        font-size: 14px;
        width: 150px;
    }
    .compare-value {
        font-weight: 600;
        color: #1e293b;
    }
    .compare-btn.is-selected {
        background-color: #0d9488 !important;
        color: white !important;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        window.handleAgentContactClick = function(event, element, interactionType) {
            if (!element) return true;

            event.preventDefault();

            const href = element.getAttribute('href');
            const agentId = element.getAttribute('data-agent-id');
            const serviceType = element.getAttribute('data-service-type') || '';
            const insuranceType = element.getAttribute('data-insurance-type') || '';
            const insuranceCompany = element.getAttribute('data-insurance-company') || '';

            const continueAction = () => {
                if (!href) return;
                if (interactionType === 'whatsapp') {
                    window.open(href, '_blank', 'noopener');
                } else {
                    window.location.href = href;
                }
            };

            if (!agentId) {
                continueAction();
                return false;
            }

            $.ajax({
                url: "{{ route('agent.leads.capture') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    agent_id: agentId,
                    interaction_type: interactionType,
                    service_type: serviceType,
                    insurance_type: insuranceType,
                    insurance_company: insuranceCompany,
                    source_page: 'find-agents'
                }
            }).always(function() {
                continueAction();
            });

            return false;
        };

        // Mobile filter toggle
        $(document).on("click", ".mobile-filter", function () {
            $(".find-agents-filter-wrapper").addClass("show-filter");
        });

        $(document).on("click", ".close-mobile-filter", function () {
            $(".find-agents-filter-wrapper").removeClass("show-filter");
        });

        // Close mobile filter drawer after applying or clearing filters
        $(document).on('click', '.apply-filter-btn, .clear-filter-btn', function() {
            if (window.innerWidth <= 1180) {
                $(".find-agents-filter-wrapper").removeClass("show-filter");
            }
        });

        // For homepage icon flow, open filters by default on mobile to complete sub-product/company selection.
        const urlParams = new URLSearchParams(window.location.search);
        const shouldOpenFilter = urlParams.get('openFilter') === '1';
        if (shouldOpenFilter && window.innerWidth <= 1180) {
            $(".find-agents-filter-wrapper").addClass("show-filter");
        }

        const insuranceOptions = {
            'New Policy': ['Health Insurance', 'Life Insurance', 'Motor Insurance', 'SME Insurance'],
            'Claim Assistance': ['Health Insurance', 'Life Insurance', 'Motor Insurance', 'SME Insurance']
        };
        const policyReviewOptions = [
            'Health', 'Life', 'Motor', 'SME'
        ];

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

        const insuranceCompanyMapping = {
            'Health Insurance': companiesHealth,
            'Life Insurance': companiesLife,
            'Motor Insurance': companiesGeneral,
            'SME Insurance': companiesGeneral
        };

        const serviceTypeSelect = $('#ServiceType');
        const insuranceTypeField = $('#InsuranceTypeField');
        const insuranceTypeLabel = $('#InsuranceTypeLabel');
        const companyContainer = $('#InsuranceCompanyContainer');
        const complaintContainer = $('#ComplaintTypeContainer');

        let selectedItems = {!! json_encode((array) request('InsuranceType')) !!};

        function renderSelectedTags() {
            let tagsHtml = '<div class="selected-tags-container">';
            selectedItems.forEach(item => {
                tagsHtml += `
                    <div class="insurance-tag">
                        ${item} <span class="remove-tag" data-val="${item}">&times;</span>
                    </div>
                `;
            });
            tagsHtml += '</div>';
            return tagsHtml;
        }

        function updateInsuranceTypes() {
            const serviceType = serviceTypeSelect.val();
            
            // Initial hide - will be shown based on conditions later
            companyContainer.hide();
            complaintContainer.hide();

            if (serviceType === 'Claim Assistance') {
                complaintContainer.show();
                // Company container visibility will be managed by InsuranceType change
            }

            if (serviceType === 'Policy Review') {
                insuranceTypeLabel.text('Insurance Types');
                
                let html = renderSelectedTags();
                const displayCount = selectedItems.length > 0 ? `${selectedItems.length} selected` : 'Select Insurance Types';
                
                html += `
                    <div class="custom-multiselect-container">
                        <div class="multiselect-trigger" id="InsuranceType" tabindex="0">
                            <span class="count-text">${displayCount}</span>
                            <span class="arrow">▼</span>
                        </div>
                        <div class="multiselect-dropdown">
                `;
                
                policyReviewOptions.forEach(opt => {
                    const isChecked = selectedItems.includes(opt) ? 'checked' : '';
                    html += `
                        <label class="multiselect-option">
                            <input type="checkbox" name="InsuranceType[]" value="${opt}" ${isChecked}>
                            <div class="check-circle"></div>
                            <span>${opt}</span>
                        </label>
                    `;
                });
                
                html += `</div></div>`;
                insuranceTypeField.html(html);
            } else {
                insuranceTypeLabel.text('Insurance Type');
                // selectedItems = []; // Keep selected items for initial load, cleared on change
                
                let html = `<select class="selectbox" name="InsuranceType" id="InsuranceType">
                    <option value="">All Insurance Types</option>`;
                
                const options = insuranceOptions[serviceType] || ['Life Insurance', 'Health Insurance', 'Motor Insurance', 'Home Insurance', 'Travel Insurance'];
                const currentlySelected = {!! json_encode(request('InsuranceType')) !!};

                options.forEach(opt => {
                    // Check if newly generated option should be selected
                    const isSelected = (currentlySelected === opt) || (Array.isArray(currentlySelected) && currentlySelected.includes(opt)) ? 'selected' : '';
                    html += `<option value="${opt}" ${isSelected}>${opt}</option>`;
                });
                html += '</select>';
                insuranceTypeField.html(html);
            }
        }

        // Toggling Dropdown
        $(document).off('click.multiSelectToggle').on('click.multiSelectToggle', '.custom-multiselect-container .multiselect-trigger', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).closest('.custom-multiselect-container').toggleClass('active');
        });

        // Closing Dropdown on outside click
        $(document).off('click.multiSelectOutside').on('click.multiSelectOutside', function(e) {
            if (!$(e.target).closest('.custom-multiselect-container').length) {
                $('.custom-multiselect-container').removeClass('active');
            }
        });

        $(document).off('click.multiSelectBody', '.custom-multiselect-container .multiselect-dropdown')
                   .on('click.multiSelectBody', '.custom-multiselect-container .multiselect-dropdown', function(e) {
            e.stopPropagation();
        });

        // Handling Choice in Multiselect
        $(document).on('change', '.multiselect-option input', function() {
            const val = $(this).val();
            if ($(this).is(':checked')) {
                if (!selectedItems.includes(val)) selectedItems.push(val);
            } else {
                selectedItems = selectedItems.filter(i => i !== val);
            }
            
            // Update Text
            const countText = selectedItems.length > 0 ? `${selectedItems.length} selected` : 'Select Insurance Types';
            $('.custom-multiselect-container .count-text').text(countText);

            // Update Tags
            let tagsContainer = insuranceTypeField.find('.selected-tags-container');
            if (tagsContainer.length) {
                tagsContainer.replaceWith(renderSelectedTags());
            } else {
                insuranceTypeField.prepend(renderSelectedTags());
            }
        });

        // Handling Tag Removal
        $(document).on('click', '.remove-tag', function() {
            const val = $(this).data('val');
            selectedItems = selectedItems.filter(i => i !== val);
            
            // Uncheck the checkbox
            $(`.multiselect-option input[value="${val}"]`).prop('checked', false);
            
            // Update Text
            const countText = selectedItems.length > 0 ? `${selectedItems.length} selected` : 'Select Insurance Types';
            $('.custom-multiselect-container .count-text').text(countText);
            
            // Update Tags
            let tagsContainer = insuranceTypeField.find('.selected-tags-container');
            tagsContainer.replaceWith(renderSelectedTags());
        });

        serviceTypeSelect.on('change', function() {
            selectedItems = [];
            // Reset dependent fields to clear stray filter data
            $('#InsuranceCompany').val('');
            $('#ComplaintType').val('');
            
            updateInsuranceTypes();
            updateInsuranceCompanyDropdown();
        });

        // Handle Clear Filters
        $(document).on('click', '.clear-filter-btn, .no-agents-found .all-btn', function(e) {
            // We let HTMX handle the actual request, but we reset the UI state here
            serviceTypeSelect.val('');
            selectedItems = [];
            updateInsuranceTypes();
            $('#InsuranceCompany').val('');
            $('#ComplaintType').val('');
        });
        
        const subProductMapping = {
            'Health Insurance': ['Mediclaim', 'Personal Accident', 'Critical Illness', 'Super Top-up', 'Others'],
            'Life Insurance': ['Term Plan', 'Pension Plan', 'Guaranteed Plan', 'Saving Plan', 'ULIP Plan', 'Others'],
            'Motor Insurance': ['Private Car', 'Two Wheeler', 'Commercial Vehicle', '3 Wheeler', 'Others'],
            'SME Insurance': ['Fire', 'Marine/Transport', 'Workmen Compensation', 'GPA/GMC', 'Group Term Insurance', 'Liability', 'Cyber', 'Others']
        };

        function updateInsuranceCompanyDropdown() {
            const serviceType = serviceTypeSelect.val();
            const insuranceType = $('#InsuranceType').val(); // Always get current value
            const requestedCompany = "{!! request('InsuranceCompany') !!}";

            if (serviceType === 'Claim Assistance' && insuranceType && insuranceCompanyMapping[insuranceType]) {
                $('#InsuranceCompanyContainer label').text('Insurance Company');
                const companies = insuranceCompanyMapping[insuranceType];
                let companyOptions = '<option value="">All Companies</option>';
                
                companies.forEach(company => {
                    const isSelected = requestedCompany === company ? 'selected' : '';
                    companyOptions += `<option value="${company}" ${isSelected}>${company}</option>`;
                });
                
                $('#InsuranceCompany').html(companyOptions);
                companyContainer.show();
            } else if (serviceType === 'New Policy' && insuranceType && subProductMapping[insuranceType]) {
                $('#InsuranceCompanyContainer label').text('Sub Product');
                const products = subProductMapping[insuranceType];
                let productOptions = '<option value="">All Sub Products</option>';
                
                products.forEach(product => {
                    const isSelected = requestedCompany === product ? 'selected' : '';
                    productOptions += `<option value="${product}" ${isSelected}>${product}</option>`;
                });
                
                $('#InsuranceCompany').html(productOptions);
                companyContainer.show();
            } else {
                companyContainer.hide();
            }
        }

        // Handle Insurance Type change to show/populate Insurance Company
        $(document).on('change', '#InsuranceType', function() {
            updateInsuranceCompanyDropdown();
        });

        // Trigger insurance company update initially
        $(document).ready(function() {
            if (serviceTypeSelect.val() === 'Claim Assistance' || serviceTypeSelect.val() === 'New Policy') {
                $('#InsuranceType').trigger('change');
            }
        });

        // Initial check
        updateInsuranceTypes();
        updateInsuranceCompanyDropdown();

        @if(($shouldGateGuest ?? false) === true)
        // Auto-show popup for guests
        if (Swal.isVisible() || $('#logout-form').length || $('#userMenu').length) return;
        Swal.fire({
            title: '<h3 style="color: #0d9488; margin-top: 10px;">Find Best Agents Nearby</h3>',
            html: `
                <div class="text-left" style="padding: 0 10px;">
                    <div id="swal-error-container" class="alert alert-danger d-none" style="font-size: 13px; padding: 10px; border-radius: 8px; margin-bottom: 15px; border: none; background-color: #fef2f2; color: #991b1b;">
                        <i class="fas fa-exclamation-circle mr-2"></i> <span id="swal-error-message"></span>
                    </div>

                    <p style="color: #64748b; font-size: 14px; margin-bottom: 20px;">Please share a few details to help us connect you with the right experts.</p>
                    
                    <div class="form-group mb-3">
                        <label style="font-size: 13px; font-weight: 600; color: #475569;">Full Name <span class="text-danger">*</span></label>
                        <input type="text" id="swal-fullname" class="form-control" placeholder="Enter your full name" style="border-radius: 8px; padding: 12px;">
                    </div>
                    
                    <div class="form-group mb-3">
                        <label style="font-size: 13px; font-weight: 600; color: #475569;">Email Address <span class="text-danger">*</span></label>
                        <input type="email" id="swal-email" class="form-control" placeholder="name@example.com" style="border-radius: 8px; padding: 12px;">
                    </div>
                    
                    <div class="form-group mb-3">
                        <label style="font-size: 13px; font-weight: 600; color: #475569;">Mobile Number</label>
                        <input type="text" id="swal-mobile" class="form-control" placeholder="10-digit mobile number" maxlength="10" 
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            style="border-radius: 8px; padding: 12px;">
                    </div>
                    
                    <div class="form-group mb-3">
                        <label style="font-size: 13px; font-weight: 600; color: #475569;">Pincode <span class="text-danger">*</span></label>
                        <input type="text" id="swal-pincode" class="form-control" placeholder="Where are you looking for an agent?" maxlength="6" 
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            style="border-radius: 8px; padding: 12px;">
                    </div>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Show Agents',
            confirmButtonColor: '#0d9488',
            cancelButtonText: 'Back to Home',
            padding: '2rem',
            width: '450px',
            preConfirm: () => {
                const fullname = $('#swal-fullname').val().trim();
                const email = $('#swal-email').val().trim();
                const mobile = $('#swal-mobile').val().trim();
                const pincode = $('#swal-pincode').val().trim();

                const showError = (msg) => {
                    $('#swal-error-message').text(msg);
                    $('#swal-error-container').removeClass('d-none').hide().fadeIn();
                    setTimeout(() => {
                        $('#swal-error-container').fadeOut(() => {
                            $(this).addClass('d-none');
                        });
                    }, 3000);
                };

                $('#swal-error-container').addClass('d-none');

                if (!fullname) { showError('Full Name is required'); return false; }
                if (!email) { showError('Email Address is required'); return false; }
                if (!/^\S+@\S+\.\S+$/.test(email)) { showError('Please enter a valid email address'); return false; }
                if (!pincode) { showError('Pincode is required'); return false; }
                if (pincode.length < 6) { showError('Please enter a valid 6-digit pincode'); return false; }

                return { fullname, email, mobile, pincode };
            },
            allowOutsideClick: false,
            allowEscapeKey: false,
            backdrop: `rgba(0,0,0,0.6)`
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Connecting you...',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                        $.ajax({
                            url: "{{ route('client.quick-register') }}",
                            type: "POST",
                            timeout: 15000,
                            data: {
                                _token: "{{ csrf_token() }}",
                                ...result.value
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Welcome!',
                                        text: 'We found matching agents for you.',
                                        timer: 3000,
                                        showConfirmButton: false,
                                        padding: '2rem'
                                    }).then(() => {
                                        window.location.href = response.redirect;
                                    });
                                } else {
                                    Swal.fire('Error', response.message, 'error');
                                }
                            },
                            error: function(xhr) {
                                const message = xhr.status === 0
                                    ? 'Request timed out. Please check your internet and try again.'
                                    : (xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred');
                                Swal.fire('Error', message, 'error');
                            }
                        });
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
               window.location.href = "{{ url('/') }}";
            }
        });
        @endif

        // Agent Comparison Logic
        let selectedCompareAgents = JSON.parse(localStorage.getItem('selectedCompareAgents')) || [];

        window.toggleCompareAgent = function(el) {
            const btn = $(el);
            const agentId = btn.data('agent-id');
            const agentData = {
                id: agentId,
                name: btn.data('agent-name'),
                experience: btn.data('agent-experience'),
                rating: btn.data('agent-rating'),
                reviews: btn.data('agent-reviews'),
                claims: btn.data('agent-claims'),
                settled: btn.data('agent-settled'),
                clients: btn.data('agent-clients'),
                segments: btn.data('agent-segments') || 'N/A',
                approved: String(btn.data('agent-approved')) === '1',
                trusted: String(btn.data('agent-trusted')) === '1',
                location: btn.data('agent-location'),
                slug: btn.data('agent-slug'),
                mobile: btn.data('agent-mobile'),
                whatsapp: btn.data('agent-whatsapp'),
                image: btn.data('agent-image')
            };

            const index = selectedCompareAgents.findIndex(a => a.id === agentId);

            if (index > -1) {
                // Remove
                selectedCompareAgents.splice(index, 1);
                btn.removeClass('is-selected');
                $(el).find('svg').css('stroke', 'currentColor');
            } else {
                if (selectedCompareAgents.length >= 3) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Limit Reached',
                        text: 'You can only compare up to 3 agents.',
                        confirmButtonColor: '#0d9488'
                    });
                    return;
                }
                selectedCompareAgents.push(agentData);
                btn.addClass('is-selected');
                $(el).find('svg').css('stroke', 'white');
            }

            localStorage.setItem('selectedCompareAgents', JSON.stringify(selectedCompareAgents));
            updateCompareBar();
        }

        window.updateCompareBar = function() {
            const bar = $('#compare-bar');
            const countSpan = $('#compare-count');
            const countMobile = $('#compare-count-mobile');
            const thumbsContainer = $('#compare-selected-agents');
            const compareBtn = $('#compare-now-btn');

            countSpan.text(selectedCompareAgents.length);
            countMobile.text(selectedCompareAgents.length);
            thumbsContainer.empty();

            // Sync card buttons state if available on page
            $('.compare-btn').removeClass('is-selected').find('svg').css('stroke', 'currentColor');
            selectedCompareAgents.forEach(agent => {
                const cardBtn = $(`.compare-btn[data-agent-id="${agent.id}"]`);
                if(cardBtn.length) {
                    cardBtn.addClass('is-selected').find('svg').css('stroke', 'white');
                }

                thumbsContainer.append(`
                    <div class="selected-agent-thumb">
                        <img src="${agent.image}" alt="${agent.name}">
                        <div class="remove-compare" onclick="removeCompareAgent(${agent.id})">&times;</div>
                    </div>
                `);
            });

            if (selectedCompareAgents.length > 0) {
                bar.addClass('show');
                compareBtn.prop('disabled', selectedCompareAgents.length < 2);
            } else {
                bar.removeClass('show');
            }
        }

        window.removeCompareAgent = function(id) {
            selectedCompareAgents = selectedCompareAgents.filter(a => a.id !== id);
            localStorage.setItem('selectedCompareAgents', JSON.stringify(selectedCompareAgents));
            updateCompareBar();
        }

        window.clearComparison = function() {
            selectedCompareAgents = [];
            localStorage.removeItem('selectedCompareAgents');
            updateCompareBar();
        }

        window.closeComparisonModal = function() {
            const modalEl = document.getElementById('comparisonModal');
            if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                const modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) modal.hide();
            }
            if (typeof $ !== 'undefined') {
                $('#comparisonModal').modal('hide');
            }
        }

        window.showComparisonModal = function() {
            const table = $('#comparison-table-content');
            table.empty();

            let headerRow = '<tr><th class="compare-row-title">Agents</th>';
            let experienceRow = '<tr><th class="compare-row-title">Experience</th>';
            let ratingRow = '<tr><th class="compare-row-title">Rating</th>';
            let reviewsRow = '<tr><th class="compare-row-title">Reviews</th>';
            let claimsRow = '<tr><th class="compare-row-title">Claims Processed</th>';
            let settledRow = '<tr><th class="compare-row-title">Claims Settled</th>';
            let clientsRow = '<tr><th class="compare-row-title">Active Clients</th>';
            let segmentsRow = '<tr><th class="compare-row-title">Specializations</th>';
            let locationRow = '<tr><th class="compare-row-title">Location</th>';
            let actionRow = '<tr><th class="compare-row-title">Action</th>';

            selectedCompareAgents.forEach(agent => {
                headerRow += `
                    <td>
                        <div class="compare-agent-header">
                            <img src="${agent.image}" alt="${agent.name}">
                            <div class="compare-agent-name">${agent.name}</div>
                            <div class="d-flex align-items-center justify-content-center flex-wrap mt-1" style="gap:6px;">
                                ${agent.approved ? '<span class="badge badge-light" style="border:1px solid #dbeafe; color:#1d4ed8; font-size:10px;">IRDAI</span>' : ''}
                                ${agent.trusted ? '<span class="badge badge-light" style="border:1px solid #99f6e4; color:#0f766e; font-size:10px;">Trusted</span>' : ''}
                            </div>
                        </div>
                    </td>
                `;
                experienceRow += `<td class="compare-value">${agent.experience}</td>`;
                ratingRow += `<td class="compare-value"><i class="fas fa-star text-warning"></i> ${agent.rating}</td>`;
                reviewsRow += `<td class="compare-value">${agent.reviews}</td>`;
                claimsRow += `<td class="compare-value">${agent.claims}</td>`;
                settledRow += `<td class="compare-value">${agent.settled}</td>`;
                clientsRow += `<td class="compare-value">${agent.clients}</td>`;
                
                // Format segments neatly
                let segmentsHtml = agent.segments !== 'N/A'
                    ? (() => {
                        const rawSegments = agent.segments.split(',').map(s => s.trim().toLowerCase()).filter(Boolean);
                        const priority = ['health', 'life', 'motor', 'sme'];
                        const ordered = [];

                        priority.forEach(item => {
                            if (rawSegments.includes(item)) {
                                ordered.push(item);
                            }
                        });

                        rawSegments.forEach(item => {
                            if (!ordered.includes(item)) {
                                ordered.push(item);
                            }
                        });

                        return ordered.map(item => {
                            const label = item === 'sme' ? 'SME' : item.charAt(0).toUpperCase() + item.slice(1);
                            return `<span class="badge text-white m-1 shadow-sm" style="background-color: #2b7a70; padding: 6px 14px; border-radius: 20px; font-weight: 600; font-size: 12px;">${label}</span>`;
                        }).join('');
                    })()
                    : agent.segments;
                segmentsRow += `<td class="compare-value">${segmentsHtml}</td>`;
                
                locationRow += `<td class="compare-value">${agent.location}</td>`;
                
                let whatsappNumber = agent.whatsapp;
                if (whatsappNumber && whatsappNumber.length === 10) {
                    whatsappNumber = '91' + whatsappNumber;
                }
                
                actionRow += `
                    <td>
                        <div class="d-flex flex-column mx-auto" style="max-width: 150px;">
                            <a href="tel:${agent.mobile}" onclick="window.closeComparisonModal()" class="btn btn-sm btn-outline-primary rounded-pill px-3 d-flex align-items-center justify-content-center mb-2">
                                <i class="fas fa-phone mr-2"></i> Call Now
                            </a>
                            <a href="https://wa.me/${whatsappNumber}" target="_blank" onclick="window.closeComparisonModal()" class="btn btn-sm btn-outline-success rounded-pill px-3 d-flex align-items-center justify-content-center">
                                <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                            </a>
                        </div>
                    </td>
                `;
            });

            headerRow += '</tr>';
            experienceRow += '</tr>';
            ratingRow += '</tr>';
            reviewsRow += '</tr>';
            claimsRow += '</tr>';
            settledRow += '</tr>';
            clientsRow += '</tr>';
            segmentsRow += '</tr>';
            locationRow += '</tr>';
            actionRow += '</tr>';

            table.append(headerRow + experienceRow + ratingRow + reviewsRow + claimsRow + settledRow + clientsRow + segmentsRow + locationRow + actionRow);
            
            const modalEl = document.getElementById('comparisonModal');
            if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                if (bootstrap.Modal.getOrCreateInstance) {
                    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                    modal.show();
                } else {
                    const modal = new bootstrap.Modal(modalEl);
                    modal.show();
                }
            } else {
                $('#comparisonModal').modal('show');
            }
        }

        // Initially sync the compare bar
        updateCompareBar();
        
        // Add event listener for htmx afterSettle to re-bind compare logic
        document.body.addEventListener('htmx:afterSettle', function() {
            updateCompareBar();
        });
    });
</script>
@endpush