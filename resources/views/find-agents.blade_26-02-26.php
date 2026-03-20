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
                                    <path d="M10.0303 8.96965C9.73741 8.67676 9.26253 8.67676 8.96964 8.96965C8.67675 9.26255 8.67675 9.73742 8.96964 10.0303L10.9393 12L8.96966 13.9697C8.67677 14.2625 8.67677 14.7374 8.96966 15.0303C9.26255 15.3232 9.73743 15.3232 10.0303 15.0303L12 13.0607L13.9696 15.0303C14.2625 15.3232 14.7374 15.3232 15.0303 15.0303C15.3232 14.7374 15.3232 14.2625 15.0303 13.9696L13.0606 12L15.0303 10.0303C15.3232 9.73744 15.3232 9.26257 15.0303 8.96968C14.7374 8.67678 14.2625 8.67678 13.9696 8.96968L12 10.9393L10.0303 8.96965Z" fill="#1C274C"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25ZM2.75 12C2.75 6.89137 6.89137 2.75 12 2.75C17.1086 2.75 21.25 6.89137 21.25 12C21.25 17.1086 17.1086 21.25 12 21.25C6.89137 21.25 2.75 17.1086 2.75 12Z" fill="#1C274C"/>
                                </svg>
                            </a>
                            <div class="find-agents-filter">
                                <h3>Filters</h3>
                                <form action="{{ route('find.agents') }}" method="GET">
                                    <div class="form-group">
                                        <label for="ServiceType">Service Type</label>
                                        <select class="selectbox" name="ServiceType" id="ServiceType">
                                            <option value="">All Services</option>
                                            <option value="New Policy">New Policy</option>
                                            <option value="Claim Assistance">Claim Assistance</option>
                                            <option value="Policy Review">Policy Review</option>

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
                                        <label for="ComplaintCompany">Complaint Type</label>
                                        <select class="selectbox" name="ComplaintCompany" id="ComplaintCompany">
                                            <option value="" disabled selected>Complaint Type</option>
                                            <option value="Life Insurance">Life Insurance</option>
                                            <option value="Health Insurance">Health Insurance</option>
                                            <option value="Auto Insurance">Auto Insurance</option>
                                            <option value="Home Insurance">Home Insurance</option>
                                            <option value="Travel Insurance">Travel Insurance</option>
                                        </select>
                                    </div>

                                    <div class="form-group button">
                                        <a href="{{ route('find.agents') }}" class="clear-filter-btn no-interceptor text-decoration-none">Clear All Filters</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="find-agents-list">
                            <!-- Title -->
                            <div class="find-agents-list-title mb-2">
                                <h3>{{ $agents->total() }} Insurance Agent{{ $agents->total() != 1 ? 's' : '' }} Available</h3>
                                <!-- <p>Sorted by Recent Registration</p> -->
                            </div>

                            @if($agents->isEmpty())
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
                                           class="all-btn no-interceptor text-decoration-none position-relative"
                                           hx-get="{{ $agents->nextPageUrl() }}"
                                           hx-target="#load-more-wrapper"
                                           hx-select=".pagination-response"
                                           hx-swap="outerHTML">
                                           <span class="htmx-indicator-content">
                                               <i class="fas fa-spinner fa-spin me-2"></i> Loading...
                                           </span>
                                           <span class="default-content">Find More Agents</span>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
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
    .htmx-indicator-content {
        display: none;
    }
    .htmx-request .htmx-indicator-content {
        display: inline-block;
    }
    .htmx-request .default-content {
        display: none;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Mobile filter toggle
        $(document).on("click", ".mobile-filter", function () {
            $(".find-agents-filter-wrapper").addClass("show-filter");
        });

        $(document).on("click", ".close-mobile-filter", function () {
            $(".find-agents-filter-wrapper").removeClass("show-filter");
        });

        const insuranceOptions = {
            'New Policy': ['Health Insurance', 'Life Insurance', 'Motor Insurance', 'SME Insurance'],
            'Claim Assistance': ['Health Insurance', 'Life Insurance', 'Motor Insurance', 'Travel Insurance', 'Fire Insurance', 'Marine Insurance', 'Liability Insurance', 'SME Insurance', 'Other General Insurance']
        };

        const policyReviewOptions = [
            'Health', 'Life', 'Motor', 'Travel', 'Fire', 'Marine', 'Transport',
            'Workmen Compensation', 'GPA / GMC', 'Group Term Insurance', 'Liability', 'Cyber'
        ];

        const serviceTypeSelect = $('#ServiceType');
        const insuranceTypeField = $('#InsuranceTypeField');
        const insuranceTypeLabel = $('#InsuranceTypeLabel');
        const companyContainer = $('#InsuranceCompanyContainer');
        const complaintContainer = $('#ComplaintTypeContainer');

        let selectedItems = [];

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
            
            // Handle conditional visibility
            if (serviceType === 'Claim Assistance') {
                companyContainer.show();
                complaintContainer.show();
            } else {
                companyContainer.hide();
                complaintContainer.hide();
            }

            if (serviceType === 'Policy Review') {
                insuranceTypeLabel.text('Insurance Types');
                
                let html = renderSelectedTags();
                const displayCount = selectedItems.length > 0 ? `${selectedItems.length} selected` : 'Select Insurance Types';
                
                html += `
                    <div class="custom-multiselect-container" id="customMultiselect">
                        <div class="multiselect-trigger">
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
                selectedItems = []; // Clear multiselect on switch
                
                let html = `<select class="selectbox" name="InsuranceType" id="InsuranceType">
                    <option value="">All Insurance Types</option>`;
                
                const options = insuranceOptions[serviceType] || ['Life Insurance', 'Health Insurance', 'Auto Insurance', 'Home Insurance', 'Travel Insurance'];
                options.forEach(opt => {
                    html += `<option value="${opt}">${opt}</option>`;
                });
                html += '</select>';
                insuranceTypeField.html(html);
            }
        }

        // Toggling Dropdown
        $(document).on('click', '#customMultiselect .multiselect-trigger', function(e) {
            e.stopPropagation();
            $('#customMultiselect').toggleClass('active');
        });

        // Closing Dropdown on outside click
        $(document).on('click', function() {
            $('#customMultiselect').removeClass('active');
        });

        $(document).on('click', '.multiselect-dropdown', function(e) {
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
            $('#customMultiselect .count-text').text(countText);

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
            $('#customMultiselect .count-text').text(countText);
            
            // Update Tags
            let tagsContainer = insuranceTypeField.find('.selected-tags-container');
            tagsContainer.replaceWith(renderSelectedTags());
        });

        serviceTypeSelect.on('change', function() {
            selectedItems = [];
            updateInsuranceTypes();
        });

        // Handle Clear Filters
        $('#reset, .no-agents-found .all-btn').on('click', function(e) {
            e.preventDefault();
            serviceTypeSelect.val('');
            selectedItems = [];
            updateInsuranceTypes();
            $('#InsuranceCompany').val('');
            $('#ComplaintCompany').val('');
        });
        
        // Initial check
        updateInsuranceTypes();

        @guest
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
                    didOpen: () => {
                        Swal.showLoading();
                        $.ajax({
                            url: "{{ route('client.quick-register') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                ...result.value
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: 'Account created. We sent your credentials to your email.',
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        window.location.href = response.redirect;
                                    });
                                } else {
                                    Swal.fire('Error', response.message, 'error');
                                }
                            },
                            error: function(xhr) {
                                const message = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred';
                                Swal.fire('Error', message, 'error');
                            }
                        });
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
               htmx.ajax('GET', "{{ url('/') }}", {target: '#app-content', select: '#app-content'});
            }
        });
        @endguest
    });
</script>
@endpush