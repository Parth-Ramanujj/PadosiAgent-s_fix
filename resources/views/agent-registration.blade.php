@extends('layouts.app')

@push('styles')
{{--
<style>
    /* Premium Registration Form Styles */
    .become-a-padosi-agent-con {
        background: #f9fafb;
        padding: 60px 0;
    }
    
    .become-padosi-agent-content {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        padding: 40px;
        max-width: 900px;
        margin: 0 auto;
        border: 1px solid #eef2f6;
    }
    
    .become-padosi-agent-content h2 {
        color: #1a1a1a;
        font-family: "Urbanist", sans-serif;
        font-weight: 700;
        font-size: 28px;
        margin-bottom: 10px;
        text-align: left;
    }
    
    .become-padosi-agent-content p.text {
        color: #64748b;
        font-size: 16px;
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #334155;
        font-size: 15px;
    }
    
    .form-group input, 
    .form-group select {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 16px;
        color: #1e293b;
        transition: all 0.3s ease;
        background-color: #f8fafc;
        outline: none;
    }
    
    .form-group input:focus, 
    .form-group select:focus {
        border-color: #003AAD;
        background-color: #ffffff;
        box-shadow: 0 0 0 4px rgba(0, 58, 173, 0.1);
    }

    .form-group input::placeholder {
        color: #94a3b8;
    }

    /* Email & Company Input Container */
    .email-input-container, 
    .company-input-container {
        display: flex;
        gap: 12px;
        align-items: stretch;
    }

    .email-input-container input,
    .company-input-container input {
        flex: 1;
    }

    /* Verify Button */
    .verify-btn {
        background: #273C8E;
        color: white;
        border: none;
        padding: 0 24px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
        height: auto;
        font-size: 15px;
    }

    .verify-btn:hover {
        background: #1a2a63;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(39, 60, 142, 0.2);
    }
    
    .verify-btn:disabled {
        background: #cbd5e1;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    /* Section Divider */
    .section-divider {
        height: 1px;
        background: linear-gradient(to right, transparent, #e2e8f0, transparent);
        margin: 40px 0;
    }

    /* Validated Fields */
    .is-valid {
        border-color: #10b981 !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2310b981' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }

    .is-invalid {
        border-color: #ef4444 !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23ef4444'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linecap='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23ef4444' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }

    /* Selected Items (Company Tags) */
    .selected-items {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
    }

    .selected-item {
        background: #e0f2fe;
        color: #0369a1;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1px solid #bae6fd;
        transition: all 0.2s;
    }
    
    .selected-item:hover {
        background: #bae6fd;
    }

    .selected-item .remove-item {
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 18px;
        height: 18px;
        background: rgba(255,255,255,0.5);
        border-radius: 50%;
        font-size: 14px;
        line-height: 1;
        color: #0369a1;
    }
    
    .selected-item .remove-item:hover {
        background: #0369a1;
        color: white;
    }

    /* Submit Button Area */
    .continue-btn {
        margin-top: 40px;
        text-align: center;
    }

    .submit-btn {
        background: linear-gradient(135deg, #003AAD 0%, #002570 100%);
        color: white;
        border: none;
        padding: 18px 50px;
        border-radius: 12px;
        font-size: 18px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px -5px rgba(0, 58, 173, 0.4);
        width: 100%;
        max-width: 400px;
        letter-spacing: 0.5px;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px -5px rgba(0, 58, 173, 0.5);
        background: linear-gradient(135deg, #0046cf 0%, #002d8a 100%);
    }

    .submit-btn.verified {
        background: linear-gradient(135deg, #06A441 0%, #047a30 100%);
        box-shadow: 0 10px 20px -5px rgba(6, 164, 65, 0.4);
    }
    
    .submit-btn.verified:hover {
        background: linear-gradient(135deg, #07c24d 0%, #059139 100%);
        box-shadow: 0 15px 30px -5px rgba(6, 164, 65, 0.5);
    }

    /* Small Layout Fixes */
    .flex-box {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    
    @media (max-width: 768px) {
        .become-padosi-agent-content {
            padding: 25px;
        }
        
        .flex-box {
            grid-template-columns: 1fr;
            gap: 0;
        }
        
        .email-input-container, 
        .company-input-container {
            flex-direction: column;
        }
        
        .verify-btn {
            width: 100%;
            height: 45px;
        }
    }
    
    /* Verified Badge */
    .verified-badge {
        display: none;
        align-items: center;
        gap: 6px;
        padding: 8px 12px;
        background: #ecfdf5;
        color: #059669;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        margin-top: 10px;
        border: 1px solid #d1fae5;
    }

    /* OTP Section */
    .otp-section {
        background: #fff;
        border: 1px solid #e2e8f0;
        padding: 20px;
        border-radius: 12px;
        margin-top: 15px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }



--}}
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

                        <form id="agentForm1" action="{{ route('agent.register.step1') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_types[]" value="insurance_agent">
                            <h2>Basic Information</h2>
                            <p class="text text-size-18">Tell us about yourself</p>

                            <div class="form-group">
                                <label>Full Name *</label>
                                <input type="text" name="fullname" placeholder="Enter your full name" required="" value="{{ $agent->fullname ?? '' }}" maxlength="70" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '');">
                                <div data-lastpass-icon-root=""
                                    style="position: relative !important; height: 0px !important; width: 0px !important; display: initial !important; float: left !important;">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label>Email Address *</label>
                                        <div class="email-input-container">
                                            <input type="email" name="email" id="regEmail" placeholder="your.email@example.com"
                                                required="" onblur="validateEmailOnBlur(this)" value="{{ $agent->email ?? $verifiedEmail ?? '' }}" {{ $isVerified ? 'readonly' : '' }}>
                                            <button type="button" id="sendOtpBtn" class="verify-btn" onclick="sendOTP()" style="{{ $isVerified ? 'display: none;' : '' }}">Verify</button>
                                        </div>
                                        <small class="email-note"><i class="fas fa-info-circle"></i> Note: Your email will be your login username.</small>
                                        
                                        <div id="otpSection" class="otp-section">
                                            <label style="font-size: 14px; font-weight: 600; color: #273C8E;">Enter OTP sent to your email</label>
                                            <div class="email-input-container">
                                                <input type="text" id="otpInput" placeholder="6-digit OTP" maxlength="6" oninput="this.value = this.value.replace(/[^0-9]/g,'')">
                                                <button type="button" class="verify-btn" onclick="verifyOTP(event)" style="background: #059669;">Verify OTP</button>
                                            </div>
                                            <div id="otpTimer" style="font-size: 12px; margin-top: 5px; color: #64748b;"></div>
                                        </div>

                                        <div id="emailVerifiedBadge" class="verified-badge" style="{{ $isVerified ? 'display: flex;' : '' }}">
                                            <i class="fas fa-check-circle"></i> Email Verified Successfully
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Mobile Number *</label>
                                        <input type="tel" name="mobile" placeholder="10-digit mobile number"
                                            oninput="this.value = this.value.replace(/[^0-9]/g,'')" maxlength="10"
                                            pattern="[0-9]{10}" required="" value="{{ $agent->mobile ?? '' }}">
                                    </div>
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
                                    value="{{ isset($agent->insurance_companies) ? json_encode($agent->insurance_companies) : '[]' }}">
                            </div>

                            <div class="flex-box">
                                <div class="form-group">
                                    <label>Years of Experience</label>
                                    <input name="experience_range" type="number" inputmode="numeric" min="0"
                                        max="60" value="{{ $agent->experience_range ?? '' }}"
                                        onkeydown="return event.keyCode !== 187 && event.keyCode !== 107 && event.keyCode !== 189 && event.keyCode !== 109 && event.keyCode !== 69" 
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 2) this.value = this.value.slice(0, 2);">

                                </div>
                                <div class="form-group">
                                    <label>Approximate Client Base</label>
                                    <input type="number" inputmode="numeric" name="client_base" placeholder="" value="{{ $agent->client_base ?? '' }}"
                                        min="0" onkeydown="return event.keyCode !== 187 && event.keyCode !== 107 && event.keyCode !== 189 && event.keyCode !== 109 && event.keyCode !== 69" 
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 5) this.value = this.value.slice(0, 5);">
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
                                <button type="submit" id="mainSubmitBtn" class="submit-btn" style="margin-bottom: 10px;">Continue</button>
                            </div>
                        </form>
                    </div>

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
    // Initialize variables (will be populated below or by Blade)
    var selectedCompanies = {!! isset($agent->insurance_companies) ? json_encode($agent->insurance_companies) : '[]' !!};
    var isEmailVerified = {{ $isVerified ? 'true' : 'false' }};


    function showAlert(message, type = 'success') {
        const alertDiv = type === 'success' ? document.getElementById('successAlert') : document.getElementById('errorAlert');
        const otherAlert = type === 'success' ? document.getElementById('errorAlert') : document.getElementById('successAlert');
        
        if (!alertDiv) return;

        alertDiv.innerHTML = message;
        alertDiv.style.display = 'block';
        alertDiv.style.opacity = '1';
        alertDiv.style.transition = 'none';
        
        if (otherAlert) otherAlert.style.display = 'none';
        
        // Scroll to alert
        alertDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });

        // Auto hide after 5 seconds
        if (window.alertTimeout) clearTimeout(window.alertTimeout);
        window.alertTimeout = setTimeout(() => {
            alertDiv.style.transition = 'opacity 0.5s ease';
            alertDiv.style.opacity = '0';
            setTimeout(() => {
                alertDiv.style.display = 'none';
            }, 500);
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

    var validPromos = [
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
            document.getElementById('sendOtpBtn').disabled = true;
        } else if (email) {
            input.classList.remove('is-invalid');
            document.getElementById('sendOtpBtn').disabled = false;
        }
    }

    async function sendOTP() {
        const email = document.getElementById('regEmail').value.trim();
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            showAlert('Please enter a valid email address first.', 'error');
            return;
        }

        const btn = document.getElementById('sendOtpBtn');
        const originalText = btn.textContent;
        btn.disabled = true;
        btn.textContent = 'Sending...';

        try {
            const response = await fetch('{{ route("agent.send.otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email: email })
            });

            const data = await response.json();

            if (response.ok && data.success) {
                btn.textContent = 'Resend';
                btn.disabled = false;
                document.getElementById('otpSection').style.display = 'block';
                showAlert(data.message, 'success');
                
                // Start a timer for resend
                let timeLeft = 60;
                const timerDiv = document.getElementById('otpTimer');
                btn.disabled = true;
                
                const timerInterval = setInterval(() => {
                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        timerDiv.innerHTML = 'You can resend the OTP now.';
                        btn.disabled = false;
                    } else {
                        timerDiv.innerHTML = 'Wait ' + timeLeft + 's to resend OTP';
                        timeLeft--;
                    }
                }, 1000);
            } else {
                showAlert(data.message || 'Failed to send OTP.', 'error');
                btn.disabled = false;
                btn.textContent = originalText;
            }
        } catch (error) {
            showAlert('Network error. Please try again.', 'error');
            btn.disabled = false;
            btn.textContent = originalText;
        }
    }



    async function verifyOTP(e) {
        const otp = document.getElementById('otpInput').value;
        const email = document.getElementById('regEmail').value.trim();
        
        if (otp.length !== 6) {
            showAlert('Please enter a valid 6-digit OTP.', 'error');
            return;
        }

        const btn = e ? e.target : document.querySelector('#otpSection .verify-btn');
        const originalText = btn.textContent;
        btn.disabled = true;
        btn.textContent = 'Verifying...';

        try {
            const response = await fetch('{{ route("agent.verify.otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ otp: otp, email: email })
            });

            const data = await response.json();

            if (response.ok && data.success) {
                document.getElementById('otpSection').style.display = 'none';
                document.getElementById('regEmail').readOnly = true;
                document.getElementById('sendOtpBtn').style.display = 'none';
                document.getElementById('emailVerifiedBadge').style.display = 'flex';
                
                isEmailVerified = true;
                const submitBtn = document.getElementById('mainSubmitBtn');
                submitBtn.classList.add('verified');
                
                showAlert(data.message, 'success');
            } else {
                showAlert(data.message || 'Verification failed.', 'error');
                btn.disabled = false;
                btn.textContent = originalText;
            }
        } catch (error) {
            showAlert('Network error. Please try again.', 'error');
            btn.disabled = false;
            btn.textContent = originalText;
        }
    }

    var indianInsuranceCompanies = [
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

    function initRegistrationForm() {
        const datalist = document.getElementById('companyOptions');
        if (datalist) {
            // Clear existing options to prevent duplication
            datalist.innerHTML = '';
            indianInsuranceCompanies.forEach(company => {
                const option = document.createElement('option');
                option.value = company;
                datalist.appendChild(option);
            });
        }
        updateSelectedCompanies();
        if (isEmailVerified) {
            if(document.getElementById('regEmail')) document.getElementById('regEmail').readOnly = true;
            if(document.getElementById('sendOtpBtn')) document.getElementById('sendOtpBtn').style.display = 'none';
            if(document.getElementById('emailVerifiedBadge')) document.getElementById('emailVerifiedBadge').style.display = 'flex';
            if(document.getElementById('mainSubmitBtn')) document.getElementById('mainSubmitBtn').classList.add('verified');
        }
    }

    // Initialize on script load
    initRegistrationForm();

    // Re-initialize on HTMX swap if script persists
    if (typeof window.registrationHtmxListenerAdded === 'undefined') {
        document.addEventListener('htmx:afterSwap', function(evt) {
            if(document.getElementById('companyOptions')) {
                initRegistrationForm();
            }
        });
        window.registrationHtmxListenerAdded = true;
    }

  

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
    // Form submission
    document.getElementById('agentForm1').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const emailInput = document.getElementById('regEmail');
        const email = emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // JS Email Validation first
        if (!email || !emailRegex.test(email)) {
            showAlert('Please enter a valid email address.', 'error');
            emailInput.focus();
            return;
        }

        // Verification check
        if (!isEmailVerified) {
            showAlert('Please verify your email address with OTP before continuing.', 'error');
            document.getElementById('otpSection').style.display = 'block';
            document.getElementById('regEmail').focus();
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
                // Success - Redirect instantly to the plans page
                window.location.href = data.redirect || '/chooseplan';
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
