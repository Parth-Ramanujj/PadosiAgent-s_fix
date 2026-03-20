@extends('layouts.app')

@section('content')
<div class="sub_banner position-relative">
    @include('layouts.header')
     <!-- Sub banner section appeared commented out in template, omitting -->
</div>

<!--  become-a-padosi-agent -->
<section class="benefit-con become-a-padosi-agent-con position-relative">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                <div class="become-padosi-agent-content">
                    <!-- First step-->
                    <div class="modal-step active" data-step="1">

                        <!-- <div class="step-indicator">
                                <div class="step active">1</div>
                                <div class="step-line"></div>
                                <div class="step">2</div>
                            </div> -->

                        <div id="successAlert" class="alert alert-success mt-3" style="display: none;"></div>
                        <div id="errorAlert" class="alert alert-danger mt-3" style="display: none;"></div>

                        <form id="agentForm1" action="{{ route('agent.register.step1') }}" method="POST" hx-boost="false"> <!-- Added hx-boost="false" -->
                            @csrf
                            <input type="hidden" name="user_types[]" value="insurance_agent">
                            <h2>Basic Information</h2>
                            <p class="text text-size-18">Tell us about yourself</p>

                            <div class="form-group">
                                <label>Full Name *</label>
                                <input type="text" name="fullname" placeholder="Enter your full name" required="">
                                <div data-lastpass-icon-root=""
                                    style="position: relative !important; height: 0px !important; width: 0px !important; display: initial !important; float: left !important;">
                                </div>
                            </div>

                            <div class="flex-box">
                                <div class="form-group">
                                    <label>Email Address *</label>
                                    <input type="email" name="email" placeholder="your.email@example.com"
                                        required="" onblur="validateEmailOnBlur(this)">
                                </div>

                                <div class="form-group">
                                    <label>Mobile Number *</label>
                                    <input type="tel" name="mobile" placeholder="10-digit mobile number"
                                        oninput="this.value = this.value.replace(/[^0-9]/g,'')" maxlength="10"
                                        pattern="[0-9]{10}" required="">
                                </div>
                            </div>

                            <div class="section-divider"></div>

                            <!-- Professional Details -->
                            <h2>Professional Details</h2>
                            <p class="text text-size-16">Tell us about your professional experience</p>

                            <div class="form-group">
                                <label>Insurance Companies * (Select Multiple Companies)</label>
                                <div class="company-input-container">
                                    <input type="text" id="companyInput" list="companyOptions"
                                        placeholder="Select a company from the list" autocomplete="off">
                                </div>
                                <datalist id="companyOptions">
                                    <option value="Life Insurance Corporation of India"></option>
                                    <option value="Axis Max Life Insurance Limited"></option>
                                    <option value="HDFC Life Insurance Company Limited"></option>
                                    <option value="ICICI Prudential Life Insurance Company Limited"></option>
                                    <option value="Kotak Mahindra Life Insurance Company Limited"></option>
                                    <!-- Full list omitted for brevity, user has source -->
                                    <option value="Star Health &amp; Allied Insurance Co. Ltd."></option>
                                </datalist>
                                <div id="selectedCompanies" class="selected-items"></div>
                                <input type="hidden" name="insurance_companies" id="insuranceCompaniesInput"
                                    value="[]">
                            </div>

                            <div class="flex-box">
                                <div class="form-group">
                                    <label>Years of Experience</label>
                                    <input name="experience_range" type="number" inputmode="numeric" min="0"
                                        max="60">

                                </div>
                                <div class="form-group">
                                    <label>Approximate Client Base</label>
                                    <input type="number" inputmode="numeric" name="client_base" placeholder="">
                                </div>
                            </div>

                            <div class="continue-btn">
                                <button type="submit" class="submit-btn">Continue</button>
                            </div>
                        </form>
                    </div>

                    <!-- Second step (Example structure, logic needs Implementation) -->
                    <div class="modal-step" data-step="2">
                         <!-- Content from become-padosiagent.html lines 356-613 -->
                         <div class="choose-your">
                            <h2>Choose Your PadosiAgent Plan</h2>
                            <h3 class="pricing-subtitle">Pre-Launch Discount Offer Once in a lifetime offer!</h3>
                            <p class="text text-size-18">Get started at special introductory prices.</p>
                        </div>
                        <!-- ... Plans content ... -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    var selectedCompanies = [];

    function showAlert(message, type = 'success') {
        const alertDiv = type === 'success' ? document.getElementById('successAlert') : document.getElementById('errorAlert');
        const otherAlert = type === 'success' ? document.getElementById('errorAlert') : document.getElementById('successAlert');
        
        alertDiv.innerHTML = message;
        alertDiv.style.display = 'block';
        otherAlert.style.display = 'none';
        
        // Scroll to alert
        alertDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });

        // Auto hide after 5 seconds
        setTimeout(() => {
            alertDiv.style.display = 'none';
        }, 5000);
    }

    function showStep(step) {
        document.querySelectorAll('.modal-step').forEach(el => {
            el.classList.remove('active');
        });
        const targetStep = document.querySelector(`[data-step="${step}"]`);
        if (targetStep) {
            targetStep.classList.add('active');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }

    function validateEmailOnBlur(input) {
        const email = input.value.trim();
        if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            showAlert('Please enter a valid email address.', 'error');
            input.classList.add('is-invalid');
        } else {
            input.classList.remove('is-invalid');
        }
    }

    // Company selection logic
    var companyInput = document.getElementById('companyInput');
    var companyOptions = document.getElementById('companyOptions');

    companyInput.addEventListener('input', function(e) {
        const val = this.value;
        const options = companyOptions.options;
        for (let i = 0; i < options.length; i++) {
            if (options[i].value === val) {
                addCompany(val);
                this.value = '';
                break;
            }
        }
    });

    // Also support "Enter" to add custom if needed, or just from list
    companyInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const val = this.value.trim();
            if (val) {
                addCompany(val);
                this.value = '';
            }
        }
    });

    function addCompany(companyName) {
        if (companyName && !selectedCompanies.includes(companyName)) {
            selectedCompanies.push(companyName);
            updateSelectedCompanies();
        }
    }

    function updateSelectedCompanies() {
        const container = document.getElementById('selectedCompanies');
        const hiddenInput = document.getElementById('insuranceCompaniesInput');
        
        container.innerHTML = '';
        selectedCompanies.forEach((company, index) => {
            const item = document.createElement('div');
            item.className = 'selected-item';
            item.style.display = 'inline-block';
            item.style.margin = '5px';
            item.style.padding = '5px 10px';
            item.style.background = '#e9ecef';
            item.style.borderRadius = '20px';
            item.innerHTML = `
                ${company}
                <span class="remove-item" onclick="removeCompany(${index})" style="cursor:pointer; margin-left:8px; font-weight:bold;">&times;</span>
            `;
            container.appendChild(item);
        });
        
        hiddenInput.value = JSON.stringify(selectedCompanies);
    }

    window.removeCompany = function(index) {
        selectedCompanies.splice(index, 1);
        updateSelectedCompanies();
    }

    // Form submission
    document.getElementById('agentForm1').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const emailInput = this.querySelector('input[name="email"]');
        const email = emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // JS Email Validation first
        if (!email || !emailRegex.test(email)) {
            showAlert('Please enter a valid email address.', 'error');
            emailInput.focus();
            return;
        }

        // Validation check for insurance companies
        if (selectedCompanies.length === 0) {
            showAlert('Please select at least one insurance company.', 'error');
            return;
        }

        const formData = new FormData(this);
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.textContent;
        
        submitBtn.disabled = true;
        submitBtn.textContent = 'Processing...';

        try {
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (response.ok && data.success) {
                // Success - Redirect to plans page
                window.location.href = '/chooseplan';
            } else {
                let errorMessage = data.message || 'An error occurred during registration.';
                if (data.errors) {
                    errorMessage = Object.values(data.errors).flat().join('<br>');
                }
                showAlert(errorMessage, 'error');
            }
        } catch (error) {
            showAlert('Network error. Please try again later.', 'error');
            console.error('Error:', error);
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = originalBtnText;
        }
    });

    $(document).on('click', '.plan-links a', function(e){
        e.preventDefault();
        var target = $(this).attr('data-rel');
        
        $('.plan-links a').removeClass('active');
        $(this).addClass('active');
        
        if(target) {
            $("#"+target).fadeIn('slow').siblings(".plan-card").hide();
        }
        return false;
    });
</script>
@endpush
