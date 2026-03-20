@extends('layouts.app')

@section('content')
<div class="sub_banner position-relative">
    @include('layouts.header')
</div>

<!-- become-a-padosi-agent -->
<section class="benefit-con become-a-padosi-agent-con position-relative">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="become-padosi-agent-content">                   
                    <!-- Plan Selection Section -->
                    @php
                        $hasPromo = session()->has('applied_promo_code');
                        
                        // Starter's Plan Prices
                        $starterFull = 2359;
                        $starterDiscounted = 589;
                        $starterFinal = $hasPromo ? $starterDiscounted : $starterFull;
                        $starterBase = round($starterFinal / 1.18, 0);
                        
                        // Professional's Plan Prices
                        $profFull = 8258;
                        $profDiscounted = 2359;
                        $profFinal = $hasPromo ? $profDiscounted : $profFull;
                        $profBase = round($profFinal / 1.18, 0);
                    @endphp

                    <div class="modal-step active" data-step="2">
                        <div class="choose-your">
                            <h2>Choose Your PadosiAgent Plan</h2>
                            @if($hasPromo)
                                <h3 class="pricing-subtitle">Partner Promo Applied! Once in a lifetime offer!</h3>
                                <p class="text text-size-16">Your exclusive discount has been successfully applied to all plans.</p>
                            @else
                                <h3 class="pricing-subtitle">Get started with our standard partner plans</h3>
                                <p class="text text-size-16">Select the plan that best fits your professional needs.</p>
                            @endif
                        </div>

                        <div class="plan-links">
                           <a data-rel="tab-1" href="javascript:void(0)" onclick="selectPlanForPayment('basic', false)">Starter's Plan</a> 
                           <a class="active" data-rel="tab-2" href="javascript:void(0)" onclick="selectPlanForPayment('professional', false)">Professional's Plan</a> 
                        </div>

                        <div class="choose-your-content">
                            <div class="plans-container">
                                <!-- Basic Plan Card -->
                                <div class="plan-card basic" id="tab-1">
                                    <div class="recommended-badge">@if($hasPromo) PROMO APPLIED @else STANDARD @endif</div>
                                    <div class="plan-header">
                                        <div class="plan-name">Starter's Plan</div>
                                        @if($hasPromo)
                                            <div class="original-price"><b>₹{{ number_format($starterFull) }}/-</b></div>
                                            <div class="plan-price">₹{{ number_format($starterDiscounted) }}/-<span> 1<sup>st</sup> Year Only</span></div>
                                            <div class="discount-badge">75% OFF</div>
                                        @else
                                            <div class="plan-price">₹{{ number_format($starterFull) }}/-<span> 1<sup>st</sup> Year Only</span></div>
                                        @endif
                                        <div class="plan-desc">Perfect for New Agents</div>
                                    </div>

                                    <div class="features-list">
                                        <!-- ... features same as before ... -->
                                        <div class="feature-category">
                                            <div class="category-title">
                                                <i class="fas fa-shopping-bag"></i> Sales Kit
                                            </div>
                                            <div class="feature-item">
                                                <div class="feature-name"><i class="fas fa-leaf"></i> Organic Lead Inquiries</div>
                                                <div class="feature-value">Yes</div>
                                            </div>
                                            <div class="feature-item">
                                                <div class="feature-name"><i class="fas fa-coins"></i> Service Lead Inquiries*</div>
                                                <div class="feature-value">Yes</div>
                                            </div>
                                            <div class="feature-item">
                                                <div class="feature-name"><i class="fas fa-handshake"></i> Referral Lead Inquiries</div>
                                                <div class="feature-value">Yes</div>
                                            </div>
                                        </div>

                                        <!-- Asset & Marketing Kit -->
                                        <div class="feature-category">
                                            <div class="category-title">
                                                <i class="fas fa-bullhorn"></i> Asset &amp; Marketing
                                            </div>
                                            <div class="feature-item">
                                                <div class="feature-name"><i class="fas fa-globe"></i> Webpage</div>
                                                <div class="feature-value">Lifetime*</div>
                                            </div>
                                            <div class="feature-item">
                                                <div class="feature-name"><i class="fas fa-share-alt"></i> Social Media Integration</div>
                                                <div class="feature-value">Lifetime*</div>
                                            </div>
                                            <div class="feature-item">
                                                <div class="feature-name"><i class="fas fa-id-card"></i> Digital Business Card</div>
                                                <div class="feature-value">Lifetime*</div>
                                            </div>
                                            <div class="feature-item">
                                                <div class="feature-name"><i class="fas fa-images"></i> Digital Gallery</div>
                                                <div class="feature-value">5 Images</div>
                                            </div>
                                        </div>

                                        <!-- Business Support -->
                                        <div class="feature-category">
                                            <div class="category-title">
                                                <i class="fas fa-headset"></i> Business Support
                                            </div>
                                            <div class="feature-item">
                                                <div class="feature-name"><i class="fas fa-star"></i> Profile Review &amp; Rating</div>
                                                <div class="feature-value">Lifetime*</div>
                                            </div>
                                            <div class="feature-item">
                                                <div class="feature-name"><i class="fas fa-chart-line"></i> Profile Analytics</div>
                                                <div class="feature-value" style="color: #e67e22;">Basic</div>
                                            </div>
                                            <div class="feature-item">
                                                <div class="feature-name"><i class="fas fa-tools"></i> Retention Tools</div>
                                                <div class="feature-value" style="color: #e67e22;">Limited Access</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="plan-footer">
                                        <button class="plan-button" onclick="selectPlanForPayment('basic', true)">
                                            <i class="fas fa-check-circle me-2"></i> Select Starter Plan
                                        </button>
                                        <div class="offer-note">@if($hasPromo) Promo Code Applied @else Official Launch Price @endif</div>
                                    </div>
                                </div>

                                <!-- Professional Plan Card -->
                                <div class="plan-card professional" id="tab-2">
                                    <div class="recommended-badge">RECOMMENDED</div>
                                    <div class="plan-header">
                                        <div class="plan-name">Professional's Plan</div>
                                        @if($hasPromo)
                                            <div class="original-price"><b>₹{{ number_format($profFull) }}/-</b></div>
                                            <div class="plan-price">₹{{ number_format($profDiscounted) }}/-<span> 1<sup>st</sup> Year Only</span></div>
                                            <div class="discount-badge">71% OFF</div>
                                        @else
                                            <div class="plan-price">₹{{ number_format($profFull) }}/-<span> 1<sup>st</sup> Year Only</span></div>
                                        @endif
                                        <div class="plan-desc">For Established Professionals</div>
                                    </div>

                                    <div class="features-list">
                                        <!-- Sales Kit -->
                                        <div class="feature-category">
                                            <div class="category-title">
                                                <i class="fas fa-shopping-bag"></i> Sales Kit
                                            </div>
                                            <div class="feature-item">
                                                <div class="feature-name"><i class="fas fa-leaf"></i> Organic Lead Inquiries</div>
                                                <div class="feature-value">Priority</div>
                                            </div>
                                            <div class="feature-item">
                                                <div class="feature-name"><i class="fas fa-coins"></i> Service Lead Inquiries*</div>
                                                <div class="feature-value">Priority</div>
                                            </div>
                                            <div class="feature-item">
                                                <div class="feature-name"><i class="fas fa-handshake"></i> Referral Lead Inquiries</div>
                                                <div class="feature-value">Lifetime*</div>
                                            </div>
                                            <div class="feature-item highlighted">
                                                <div class="feature-name"><i class="fas fa-ad"></i> Paid Lead Inquiries*</div>
                                                <div class="feature-value"><span class="validity-badge">90 Days</span></div>
                                            </div>
                                        </div>

                                        <!-- Asset & Marketing Kit -->
                                        <div class="feature-category">
                                            <div class="category-title">
                                                <i class="fas fa-bullhorn"></i> Asset &amp; Marketing
                                            </div>
                                            <div class="feature-item">
                                                <div class="feature-name"><i class="fas fa-globe"></i> Webpage</div>
                                                <div class="feature-value">Lifetime*</div>
                                            </div>
                                            <div class="feature-item">
                                                <div class="feature-name"><i class="fas fa-share-alt"></i> Social Media Integration</div>
                                                <div class="feature-value">Lifetime*</div>
                                            </div>
                                            <div class="feature-item">
                                                <div class="feature-name"><i class="fas fa-id-card"></i> Digital Business Card</div>
                                                <div class="feature-value">Lifetime*</div>
                                            </div>
                                            <div class="feature-item">
                                                <div class="feature-name"><i class="fas fa-images"></i> Digital Gallery</div>
                                                <div class="feature-value">10 Images</div>
                                            </div>
                                        </div>

                                        <!-- Business Support -->
                                        <div class="feature-category">
                                            <div class="category-title">
                                                <i class="fas fa-headset"></i> Business Support
                                            </div>
                                            <div class="feature-item">
                                                <div class="feature-name"><i class="fas fa-star"></i> Profile Review &amp; Rating</div>
                                                <div class="feature-value">Lifetime*</div>
                                            </div>
                                            <div class="feature-item highlighted mb-1">
                                                <div class="feature-name"><i class="fas fa-award"></i> Trusted Badge</div>
                                                <div class="feature-value">Yes</div>
                                            </div>
                                            <div class="feature-item highlighted mb-1">
                                                <div class="feature-name"><i class="fas fa-chart-line"></i> Profile Analytics</div>
                                                <div class="feature-value">Advanced <span class="validity-badge">90 Days</span></div>
                                            </div>
                                            <div class="feature-item highlighted mb-1">
                                                <div class="feature-name"><i class="fas fa-tools"></i>Retention Tools</div>
                                                <div class="feature-value">Full Access <span class="validity-badge">90 Days</span></div>
                                            </div>
                                        </div>

                                        <!-- Coming Soon Features -->
                                        <div class="feature-category coming-soon">
                                            <div class="category-title">
                                                <i class="fas fa-bolt"></i> More Features Coming Soon
                                            </div>
                                            <div class="feature-item coming-soon-item">
                                                <div class="feature-name"><i class="fas fa-cogs"></i> Business Ops Kit</div>
                                            </div>
                                            <div class="feature-item coming-soon-item">
                                                <div class="feature-name"><i class="fas fa-boxes"></i> Cross Sell Products</div>
                                            </div>
                                            <div class="feature-item coming-soon-item">
                                                <div class="feature-name"><i class="fas fa-rocket"></i> Many More...</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="plan-footer">
                                        <button class="plan-button" onclick="selectPlanForPayment('professional', true)">
                                            <i class="fas fa-crown me-2"></i> Select Professional Plan
                                        </button>
                                        <div class="offer-note">Special Pre-Launch Price</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Selected Plan Summary -->
                            <div class="selected-plan-summary" id="selectedPlanSummary" style="display: none;">
                                <h4><i class="fas fa-check-circle me-2 text-success"></i> Selected Plan: <span id="selectedPlanName"></span></h4>
                                <p>Base Price: <strong id="selectedPlanPrice"></strong></p>
                                <p>GST (18%): <strong id="selectedPlanGST"></strong></p>
                                <p class="mb-0">Total Payable: <strong id="selectedPlanTotal" style="font-size: 28px;"></strong></p>
                                
                                <!-- Terms Agreement Checkbox -->
                                <div class="terms-checkbox mb-3 mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="termsCheckbox">
                                        <label class="form-check-label" for="termsCheckbox" style="font-size: 14px; color: #374151;">
                                            I agree to the <a href="{{ url('/terms') }}" target="_blank" style="color: #273C8E; font-weight: 600;">Terms and Conditions</a> and 
                                            <a href="{{ url('/privacy') }}" target="_blank" style="color: #273C8E; font-weight: 600;">Privacy Policy</a>. 
                                            I understand this is a one-time, non-refundable registration fee for 1st Year access.
                                        </label>
                                    </div>
                                </div>

                                <button id="confirmPaymentBtn" class="confirm-payment-btn" onclick="confirmPayment()">
                                    <i class="fas fa-lock me-2"></i> Confirm &amp; Proceed to Payment
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .selected-plan-summary {
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        margin-top: 30px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    .confirm-payment-btn {
        background: #273C8E;
        color: white;
        border: none;
        padding: 15px 30px;
        border-radius: 8px;
        width: 100%;
        font-weight: 600;
        font-size: 18px;
        margin-top: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .confirm-payment-btn:hover {
        background: #1a2a63;
        transform: translateY(-2px);
    }
    .confirm-payment-btn:disabled {
        background: #94a3b8;
        cursor: not-allowed;
    }
    .validity-badge {
        background: #fee2e2;
        color: #ef4444;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
    }

    /* Desktop View: Both plans visible */
    @media (min-width: 992px) {
        .plans-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }
        .plan-card {
            display: block !important;
        }
        .plan-links {
            display: none !important;
        }
    }

    /* Mobile View: Tab behavior */
    @media (max-width: 991px) {
        .plans-container {
            display: block;
        }
        .plan-links {
            display: flex !important;
            justify-content: center;
            margin-bottom: 20px;
            gap: 10px;
        }
        .plan-links a {
            padding: 10px 20px;
            background: #f1f5f9;
            border-radius: 50px;
            text-decoration: none;
            color: #475569;
            font-weight: 600;
        }
        .plan-links a.active {
            background: #273C8E;
            color: white;
        }
        .plan-card {
            display: none;
        }
        .plan-card.active-mobile {
            display: block !important;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    // Global variable to store selected plan
    let selectedPlan = {
        type: 'professional',
        name: "Professional's Plan",
        price: {{ $profBase }},
        total: {{ $profFinal }}
    };

    /**
     * Consistently handle plan selection and UI updates
     */
    function selectPlanForPayment(planType, shouldScroll = false) {
        if (planType === 'basic') {
            selectedPlan = {
                type: 'basic',
                name: "Starter's Plan",
                price: {{ $starterBase }},
                total: {{ $starterFinal }}
            };
            // UI updates for tabs
            $('.plan-links a[data-rel="tab-1"]').addClass('active').siblings().removeClass('active');
            $('#tab-1').addClass('active-mobile').siblings(".plan-card").removeClass('active-mobile');
            if(window.innerWidth < 992) {
                $('#tab-1').show().siblings(".plan-card").hide();
            }
        } else if (planType === 'professional') {
            selectedPlan = {
                type: 'professional',
                name: "Professional's Plan",
                price: {{ $profBase }},
                total: {{ $profFinal }}
            };
            // UI updates for tabs
            $('.plan-links a[data-rel="tab-2"]').addClass('active').siblings().removeClass('active');
            $('#tab-2').addClass('active-mobile').siblings(".plan-card").removeClass('active-mobile');
            if(window.innerWidth < 992) {
                $('#tab-2').show().siblings(".plan-card").hide();
            }
        }
        
        updateSelectedPlanSummary();

        // Scroll to summary for better user experience ONLY when requested (via select buttons)
        const summary = document.getElementById('selectedPlanSummary');
        if (summary && shouldScroll) {
            summary.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    }

    function updateSelectedPlanSummary() {
        const summary = document.getElementById('selectedPlanSummary');
        if (summary) {
            summary.style.display = 'block';
            document.getElementById('selectedPlanName').textContent = selectedPlan.name;
            document.getElementById('selectedPlanPrice').textContent = `₹${selectedPlan.price}`;
            document.getElementById('selectedPlanGST').textContent = `₹${(selectedPlan.price * 0.18).toFixed(2)}`;
            document.getElementById('selectedPlanTotal').textContent = `₹${selectedPlan.total.toFixed(2)}`;
        }
    }

    async function confirmPayment() {
        const termsCheckbox = document.getElementById('termsCheckbox');
        
        if (!termsCheckbox || !termsCheckbox.checked) {    
            showAlert('❌ Please agree to the Terms and Conditions and Privacy Policy to proceed with payment.', 'error');
            if(termsCheckbox) termsCheckbox.focus();
            return;
        }
        
        const paymentBtn = document.getElementById('confirmPaymentBtn');
        const originalText = paymentBtn.innerHTML;
        paymentBtn.disabled = true;
        paymentBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Processing...';

        try {
            const response = await fetch('/agent-register-complete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    plan_type: selectedPlan.type,
                    plan_name: selectedPlan.name,
                    plan_amount: selectedPlan.price,
                    total_amount: selectedPlan.total
                })
            });

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

            const data = await response.json();

            if (data.success) {
                if (data.test_payment) {
                    showPaymentSuccessPopup('🎉 Registration Complete!', `Your ${selectedPlan.name} registration has been completed successfully in test mode.`);
                } else {
                    paymentBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Opening Payment...';
                    
                    const options = {
                        "key": data.key,
                        "amount": data.amount,
                        "currency": data.currency || "INR",
                        "name": "Padosi Agent Registration",
                        "description": `Agent Registration - ${selectedPlan.name}`,
                        "image": "{{ asset('img/logo.png') }}",
                        "order_id": data.order_id,
                        "handler": function (response) {
                            handlePaymentSuccess(response, data.agent_id, selectedPlan);
                        },
                        "prefill": {
                            "name": data.name || "",
                            "email": data.email || "",
                            "contact": data.mobile || ""
                        },
                        "notes": {
                            "agent_id": data.agent_id,
                            "plan_type": selectedPlan.type
                        },
                        "theme": { "color": "#273C8E" },
                        "modal": {
                            "ondismiss": function () {
                                // Also log cancellation to backend
                                fetch('{{ url("/payment-failure") }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify({
                                        agent_id: data.agent_id,
                                        error_description: 'Payment modal dismissed by user'
                                    })
                                });
                                showPaymentFailedPopup('Payment Cancelled', `You cancelled the payment for ${selectedPlan.name}.`);
                                resetPaymentButton(paymentBtn, originalText);
                            }
                        }
                    };

                    const rzp = new Razorpay(options);
                    rzp.on('payment.failed', function (response) {
                        // Log failure to backend so database is updated (as requested)
                        fetch('{{ url("/payment-failure") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                agent_id: data.agent_id,
                                error_code: response.error.code,
                                error_description: response.error.description
                            })
                        });

                        // Show a small toast instead of a big popup, 
                        // because the user might still be inside the modal correcting details.
                        showAlert('⚠️ Payment Attempt Failed: ' + response.error.description, 'error');
                        
                        // Don't reset the main button yet, the modal might still be open
                    });
                    rzp.open();
                }
            } else {
                showPaymentFailedPopup('Registration Failed', data.message || 'Unable to process registration.');
                resetPaymentButton(paymentBtn, originalText);
            }
        } catch (error) {
            showPaymentFailedPopup('Payment Error', `Error: ${error.message}`);
            resetPaymentButton(paymentBtn, originalText);
        }
    }

    async function handlePaymentSuccess(paymentResponse, agentId, plan) {
        try {
            const response = await fetch('{{ url("/payment-success") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    razorpay_payment_id: paymentResponse.razorpay_payment_id,
                    razorpay_order_id: paymentResponse.razorpay_order_id,
                    razorpay_signature: paymentResponse.razorpay_signature,
                    agent_id: agentId,
                    plan_type: plan.type,
                    plan_name: plan.name,
                    plan_amount: plan.price,
                    total_amount: plan.total
                })
            });

            const data = await response.json();
            if (data.success) {
                showPaymentSuccessPopup('🎉 Payment Successful!', `Your registration for ${plan.name} is complete. Welcome!`);
            } else {
                showPaymentFailedPopup('Payment Verification Failed', data.message);
            }
        } catch (error) {
            showPaymentFailedPopup('Payment Verification Failed', 'Unable to verify payment.');
        }
    }

    function showPaymentSuccessPopup(title, message) {
        showCustomPopup('success', title, message);
        setTimeout(() => { 
            window.location.href = '{{ url("/") }}'; 
        }, 5000);
    }

    function showPaymentFailedPopup(title, message) {
        showCustomPopup('error', title, message);
    }

    function showCustomPopup(type, title, message) {
        // Clear any existing popups first
        document.querySelectorAll('.custom-popup-overlay').forEach(el => el.remove());

        const popupOverlay = document.createElement('div');
        popupOverlay.className = 'custom-popup-overlay';
        popupOverlay.style.cssText = `position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; z-index: 10000; font-family: sans-serif;`;
        
        const icon = type === 'success' ? '✅' : '❌';
        const color = type === 'success' ? '#10b981' : '#ef4444';

        popupOverlay.innerHTML = `
            <div style="background: white; padding: 30px; border-radius: 15px; text-align: center; max-width: 400px; width: 90%; box-shadow: 0 20px 40px rgba(0,0,0,0.2);">
                <div style="font-size: 48px; margin-bottom: 15px;">${icon}</div>
                <h2 style="color: ${color}; margin-bottom: 15px; font-size: 24px;">${title}</h2>
                <p style="color: #6b7280; margin-bottom: 25px; line-height: 1.5;">${message}</p>
                <button onclick="this.closest('.custom-popup-overlay').remove()" style="background: ${color}; color: white; border: none; padding: 12px 30px; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: 600;">
                    ${type === 'success' ? 'Continue' : 'Try Again'}
                </button>
            </div>
        `;
        document.body.appendChild(popupOverlay);
    }

    function resetPaymentButton(paymentBtn, originalText) {
        if (paymentBtn) {
            paymentBtn.disabled = false;
            paymentBtn.innerHTML = originalText;
        }
    }

    function showAlert(message, type = 'info') {
        const alertDiv = document.createElement('div');
        alertDiv.style.cssText = `position: fixed; top: 20px; right: 20px; padding: 15px 20px; border-radius: 8px; color: white; font-weight: 500; z-index: 10001; box-shadow: 0 5px 15px rgba(0,0,0,0.2); background-color: ${type === 'error' ? '#ef4444' : '#10b981'};`;
        alertDiv.textContent = message;
        document.body.appendChild(alertDiv);
        setTimeout(() => alertDiv.remove(), 5000);
    }

    // Initialize
    $(document).ready(function() {
        selectPlanForPayment('professional');
        
        // Handle window resize to ensure correct display
        $(window).resize(function() {
            if(window.innerWidth >= 992) {
                $('.plan-card').show();
            } else {
                if(selectedPlan.type === 'basic') {
                    $('#tab-1').show();
                    $('#tab-2').hide();
                } else {
                    $('#tab-1').hide();
                    $('#tab-2').show();
                }
            }
        });
    });
</script>
@endpush
