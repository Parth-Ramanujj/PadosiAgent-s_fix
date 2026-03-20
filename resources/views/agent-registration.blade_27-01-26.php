@extends('layouts.app')

@push('styles')
<style>
    .selected-items {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
    }

    .selected-item {
        background: #ADD8E6 !important;
        padding: 5px 12px;
        border-radius: 20px;
        display: inline-flex !important;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        border: 1px solid #90cbdc;
        color: #273C8E;
        font-weight: 500;
        margin: 4px !important;
    }

    .selected-item .remove-item {
        cursor: pointer;
        border: none;
        background: none;
        color: #273C8E;
        font-weight: bold;
        font-size: 18px;
        padding: 0;
        line-height: 1;
        margin-left: 8px;
    }

    .selected-item .remove-item:hover {
        color: #d32f2f;
    }

    .company-input-container {
        display: flex;
        gap: 10px;
        width: 100%;
    }
</style>
@endpush

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

                            <div class="section-divider"></div>

                            <!-- Promo Code Section -->
                            <h2>Special Offer / Promo Code</h2>
                            <p class="text text-size-16">Enter your promo code to unlock exclusive partner benefits.</p>

                            <div class="form-group">
                                <label>Promo Code</label>
                                <div class="company-input-container">
                                    <input type="text" id="promoCodeInput" placeholder="Enter promo code" autocomplete="off">
                                    <button type="button" id="verifyPromoBtn" class="btn btn-primary" onclick="verifyPromoCode()" style="background: #273C8E; color: white; border: none; padding: 0 20px; border-radius: 5px; height: 50px; min-width: 100px;">Verify</button>
                                </div>
                                <div id="promoMessage" class="mt-2" style="font-weight: 500;"></div>
                                <input type="hidden" name="promo_code" id="appliedPromoCode">
                            </div>

                            <div class="continue-btn">
                                <button type="submit" class="submit-btn" style="margin-bottom: 10px;">Continue</button>
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

                    <div class="registration-footer-link text-center" style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
                        <p style="color: #6b7280; font-size: 16px;">Already have an account? <a href="{{ url('/agent-login') }}" style="color: #06A441; font-weight: 600; text-decoration: none; border-bottom: 2px solid transparent; transition: all 0.3s;" onmouseover="this.style.borderBottomColor='#06A441'" onmouseout="this.style.borderBottomColor='transparent'">Login here</a></p>
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

    const validPromos = [
        "LICINDIAPadosiAgent", "TALICPadosiAgent", "TAGICPadosiAgent", 
        "BALICPadosiAgent", "BAGICPadosiAgent", "STARSAHIPadosiAgent", 
        "CARESAHIPadosiAgent", "NationalGICPadosiAgent", "UnitedGICPadosiAgent", 
        "NewIndiaGICPadosiAgent", "OriantalGICPadosiAgent", "Pre-Launch"
    ];

    function verifyPromoCode() {
        const promoInput = document.getElementById('promoCodeInput');
        const promoCode = promoInput.value.trim();
        const messageDiv = document.getElementById('promoMessage');
        const appliedInput = document.getElementById('appliedPromoCode');

        if (!promoCode) {
            messageDiv.innerHTML = '<span style="color: #ef4444;"><i class="fas fa-exclamation-circle"></i> Please enter a promo code.</span>';
            appliedInput.value = '';
            return;
        }

        if (validPromos.includes(promoCode)) {
            messageDiv.innerHTML = '<span style="color: #059669;"><i class="fas fa-check-circle"></i> Promo code "' + promoCode + '" applied! Your discount will be shown at selection.</span>';
            appliedInput.value = promoCode;
            document.getElementById('verifyPromoBtn').innerHTML = '<i class="fas fa-check"></i>';
            document.getElementById('verifyPromoBtn').style.background = '#059669';
        } else {
            messageDiv.innerHTML = '<span style="color: #ef4444;"><i class="fas fa-times-circle"></i> Invalid promo code.</span>';
            appliedInput.value = '';
            // Reset button if it was previously successful
            document.getElementById('verifyPromoBtn').innerHTML = 'Verify';
            document.getElementById('verifyPromoBtn').style.background = '#273C8E';
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

    const indianInsuranceCompanies = [
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
        'Go Digit Life Insurance Limited',
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
        'Zuna General Insurance Ltd.',
        'Aditya Birla Health Insurance Co. Limited',
        'Care Health Insurance Ltd.',
        'Galaxy Health and Allied Insurance Company Limited',
        'ManipalCigna Health Insurance Company Limited',
        'Niva Bupa Health Insurance Company Limited',
        'Reliance Health Insurance Ltd.',
        'Star Health & Allied Insurance Co. Ltd.',
        'Narayana Health Insurance Company Limited'
    ];

    document.addEventListener('DOMContentLoaded', function() {
        const datalist = document.getElementById('companyOptions');
        if (datalist) {
            indianInsuranceCompanies.forEach(company => {
                const option = document.createElement('option');
                option.value = company;
                datalist.appendChild(option);
            });
        }
        updateSelectedCompanies();
    });

    // Company selection logic
    var companyInput = document.getElementById('companyInput');
    if (companyInput) {
        companyInput.addEventListener('input', function(e) {
            const val = this.value.trim();
            if (indianInsuranceCompanies.includes(val)) {
                addCompany(val);
                this.value = '';
            }
        });

        companyInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const val = this.value.trim();
                if (val && indianInsuranceCompanies.includes(val)) {
                    addCompany(val);
                    this.value = '';
                } else if (val) {
                    showAlert('"' + val + '" is not an approved insurance company. Please select from the list.', 'error');
                    this.value = '';
                }
            }
        });
    }

    function addCompany(companyName) {
        if (companyName && !selectedCompanies.includes(companyName)) {
            selectedCompanies.push(companyName);
            updateSelectedCompanies();
        }
    }

    function updateSelectedCompanies() {
        const container = document.getElementById('selectedCompanies');
        const hiddenInput = document.getElementById('insuranceCompaniesInput');
        
        if (!container) return;
        
        container.innerHTML = '';
        selectedCompanies.forEach((company, index) => {
            const item = document.createElement('div');
            item.className = 'selected-item';
            item.innerHTML = `
                ${company}
                <span class="remove-item" onclick="removeCompany(${index})" title="Remove">&times;</span>
            `;
            container.appendChild(item);
        });
        
        if (hiddenInput) {
            hiddenInput.value = JSON.stringify(selectedCompanies);
        }
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
