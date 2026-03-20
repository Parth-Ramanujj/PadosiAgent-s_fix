<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PadosiAgent - Coming Soon</title>
    
    <!-- Your existing meta tags -->
    <meta property="og:title" content="Reagsing the PadosiAgent! 🚀">
    <meta property="og:description" content="Join #PadosiAgent #PadosiAgentTeam — India's platform for Mutual Fund Advisors, Insurance Agents, CA, and Lawyers.">
    <meta property="og:image" content="https://padosiagents.com/share-banner.jpg">
    <meta property="og:url" content="https://padosiagents.com/contest-share">
    <meta property="og:type" content="website">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.png') }}">

    <!-- Add CSRF Token Meta Tag HERE in HEAD -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="PadosiAgent - We are working on something awesome. Launching December 1st, 2025. Join us as an agent or customer!">
    <meta name="author" content="PadosiAgent">
    <meta name="keywords" content="PadosiAgent, coming soon, agents, customers, launch 2025">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="PadosiAgent - Coming Soon">
    <meta property="og:description" content="We are working on something awesome. Launching December 1st, 2025!">
    <meta property="og:type" content="website">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@PadosiAgent">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/padosiagent_css.css') }}">
</head>

<body>
    <div class="full-width container">
        <!-- Background Images -->
        <div class="background-bokeh"></div>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Pricing Plans Section -->
                <div class="pricing-section">
                <div class="pricing-header">
                <h1 class="pricing-title">
                    Choose Your 
                    <span class="padosi-agent">
                        <span class="padosi-text">Padosi</span><span class="agent-text">Agent</span>
                    </span> 
                    Plan
                </h1>
                <p class="pricing-subtitle">
                    <strong>Pre-Launch Discount Offer: Limited time only!</strong> 
                    Get started at special introductory prices.
                </p>
                </div>
                
                <div class="plans-container">
                    <!-- Basic Plan Card -->
                    <div class="plan-card basic">
                        <div class="plan-header">
                            <div class="plan-name">Starter's Plan</div>
                            <div class="original-price">₹2,359</div>
                            <div class="plan-price">₹589/<span>-Year</span></div>
                            <div class="plan-desc">Perfect for New Agents</div>
                            <div class="discount-badge">75% OFF</div>
                        </div>
                        
                        <div class="features-list">
                            <!-- Sales Kit -->
                            <div class="feature-category">
                                <div class="category-title">
                                    <i class="fas fa-shopping-bag"></i> Sales Kit
                                </div>
                                <div class="feature-item">
                                    <div class="feature-name"><i class="fas fa-leaf"></i> Organic Lead Inquiries</div>
                                    <div class="feature-value">Yes</div>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-name"><i class="fas fa-concierge-bell"></i> Service Lead Inquiries*</div>
                                    <div class="feature-value">Yes</div>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-name"><i class="fas fa-handshake"></i> Referral Lead Inquiries</div>
                                    <div class="feature-value">Yes</div>
                                </div>                        
                            </div>
                            
                            <!-- Assert & Marketing Kit -->
                            <div class="feature-category">
                                <div class="category-title">
                                    <i class="fas fa-bullhorn"></i> Asset & Marketing
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
                                    <div class="feature-name"><i class="fas fa-star"></i> Profile Review & Rating</div>
                                    <div class="feature-value">Lifetime*</div>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-name"><i class="fas fa-chart-line"></i> Profile Analytics</div>
                                    <div class="feature-value" style="color: #e67e22;">Basic</div>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-name"><i class="fas fa-tools"></i> Client Retention Tools</div>
                                    <div class="feature-value" style="color: #e67e22;">Limited Access</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="plan-footer">
                            <button class="plan-button" onclick="selectPlan('basic')">
                                <i class="fas fa-check-circle me-2"></i> Select Starter Plan
                            </button>
                            <div class="offer-note">Special Pre-Launch Price</div>
                        </div>
                    </div>
                    
                    <!-- Professional Plan Card -->
                    <div class="plan-card professional">
                        <div class="recommended-badge">RECOMMENDED</div>
                        <div class="plan-header">
                            <div class="plan-name">Professional's Choice</div>
                            <div class="original-price">₹8,258</div>
                            <div class="plan-price">₹2,359/<span>-Year</span></div>
                            <div class="plan-desc">For Established Professionals</div>
                            <div class="discount-badge">71% OFF</div>
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
                                    <div class="feature-name"><i class="fas fa-concierge-bell"></i> Service Lead Inquiries*</div>
                                    <div class="feature-value">Priority</div>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-name"><i class="fas fa-handshake"></i> Referral Lead Inquiries</div>
                                    <div class="feature-value">Lifetime*</div>
                                </div>
                                <div class="feature-item highlighted">
                                    <div class="feature-name"><i class="fas fa-ad"></i> Paid Lead Inquiries*</div>
                                    <div class="feature-value">Yes <span class="validity-badge">90 Days</span></div>
                                </div>
                            </div>
                            
                            <!-- Assert & Marketing Kit -->
                            <div class="feature-category">
                                <div class="category-title">
                                    <i class="fas fa-bullhorn"></i> Asset & Marketing
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
                                    <div class="feature-name"><i class="fas fa-star"></i> Profile Review & Rating</div>
                                    <div class="feature-value">Lifetime*</div>
                                </div>
                                <div class="feature-item highlighted">
                                    <div class="feature-name"><i class="fas fa-badge-check"></i> Trusted Agent Badge</div>
                                    <div class="feature-value">Yes</div>
                                </div>
                                <div class="feature-item highlighted">
                                    <div class="feature-name"><i class="fas fa-chart-line"></i> Profile Analytics</div>
                                    <div class="feature-value">Advanced <span class="validity-badge">90 Days</span></div>
                                </div>
                                <div class="feature-item highlighted">
                                    <div class="feature-name"><i class="fas fa-tools"></i> Client Retention Tools</div>
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
                            <button class="plan-button" onclick="selectPlan('professional')">
                                <i class="fas fa-crown me-2"></i> Select Professional Plan
                            </button>
                            <div class="offer-note">Special Pre-Launch Price</div>
                        </div>
                    </div>
                </div>
                
                <!-- Selected Plan Summary -->
                <div class="selected-plan-summary" id="selectedPlanSummary">
                    <h4><i class="fas fa-check-circle me-2 text-success"></i> Selected Plan: <span id="selectedPlanName">Starter's Plan</span></h4>
                    <p>Base Price: <strong id="selectedPlanPrice">₹499</strong></p>
                    <p>GST (18%): <strong id="selectedPlanGST">₹106.02</strong></p>
                    <p class="mb-0">Total Payable: <strong id="selectedPlanTotal" style="font-size: 28px;">₹695.02</strong></p>
                        <!-- Terms Agreement Checkbox -->
                        <div class="terms-checkbox mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="termsCheckbox">
                                <label class="form-check-label" for="termsCheckbox" style="font-size: 14px; color: #374151;">
                                    I agree to the <a href="/terms" target="_blank" style="color: #273C8E; font-weight: 600;">Terms and Conditions</a> and 
                                    <a href="/privacy" target="_blank" style="color: #273C8E; font-weight: 600;">Privacy Policy</a>. 
                                    I understand this is a one-time, non-refundable registration fee for lifetime access.
                                </label>
                            </div>
                        </div>

                    <button id="confirmPaymentBtn" class="confirm-payment-btn" onclick="confirmPayment()">
                        <i class="fas fa-lock me-2"></i> Confirm & Proceed to Payment
                    </button>
                </div>
                
                <div class="plan-footer-note">
                    <p>All prices are in Indian Rupees (₹). GST of 18% will be added to the final amount.</p>
                </div>
            </div>
        </main>       
    </div>
    
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    
    <script>
        // Plan selection functionality
        function selectPlan(planType) {
            const selectedPlanSummary = document.getElementById('selectedPlanSummary');
            
            if (planType === 'basic') {
                // Update selected plan summary
                document.getElementById('selectedPlanName').textContent = "Starter's Plan";
                document.getElementById('selectedPlanPrice').textContent = "₹499";
                
                // Calculate GST and total
                const basePrice = 499;
                const gst = basePrice * 0.18;
                const total = basePrice + gst;
                
                document.getElementById('selectedPlanGST').textContent = `₹${gst.toFixed(2)}`;
                document.getElementById('selectedPlanTotal').textContent = `₹${total.toFixed(2)}`;
                // Scroll to the selected plan summary for better UX
            selectedPlanSummary.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                
            } else if (planType === 'professional') {
                // Update selected plan summary
                document.getElementById('selectedPlanName').textContent = "Professional's Choice";
                document.getElementById('selectedPlanPrice').textContent = "₹1,999";
                
                // Calculate GST and total
                const basePrice = 1999;
                const gst = basePrice * 0.18;
                const total = basePrice + gst;
                
                document.getElementById('selectedPlanGST').textContent = `₹${gst.toFixed(2)}`;
                document.getElementById('selectedPlanTotal').textContent = `₹${total.toFixed(2)}`;
                // Scroll to the selected plan summary for better UX
            selectedPlanSummary.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
            
            // Show the selected plan summary
            selectedPlanSummary.style.display = 'block';
            
            // // Scroll to the selected plan summary for better UX
            // selectedPlanSummary.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
        
        // Payment confirmation function
        function confirmPayment() {
            const selectedPlanName = document.getElementById('selectedPlanName').textContent;
            const totalAmount = document.getElementById('selectedPlanTotal').textContent;
            
            // In a real implementation, you would integrate with Razorpay here
            alert(`Proceeding to payment for ${selectedPlanName}\nTotal Amount: ${totalAmount}\n\nThis would redirect to Razorpay checkout in a real implementation.`);
        }
        
        // Initialize with basic plan selected by default
        document.addEventListener('DOMContentLoaded', function() {
            selectPlan('professional');
        });


        // Global variable to store selected plan
let selectedPlan = {
    type: 'professional', // Default to professional
    name: "Professional's Choice",
    price: 1999,
    total: 2359 // With GST
};

// Function to update selected plan from the plan selection
function selectPlanForPayment(planType) {
    if (planType === 'basic') {
        selectedPlan = {
            type: 'basic',
            name: "Starter's Plan",
            price: 499,
            total: 589
        };
    } else if (planType === 'professional') {
        selectedPlan = {
            type: 'professional',
            name: "Professional's Choice",
            price: 1999,
            total: 2359
        };
    }
    
    // Update the selected plan summary display
    updateSelectedPlanSummary();
    
    // Show the confirm payment button
    document.getElementById('confirmPaymentBtn').style.display = 'block';
}

// Function to update the selected plan summary in UI
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

// Complete Registration with Razorpay Payment - UPDATED FOR PLAN SELECTION
async function confirmPayment() {
    const termsCheckbox = document.getElementById('termsCheckbox');

    
    // Check if terms are agreed
    if (!termsCheckbox) {
        console.error('Terms checkbox not found');
        return;
    }
    
    if (!termsCheckbox.checked) {    
        showAlert('❌ Please agree to the Terms and Conditions and Privacy Policy to proceed with payment.', 'error');
        termsCheckbox.focus();
        return;
    }
    
    const paymentBtn = document.getElementById('confirmPaymentBtn') || document.querySelector('.secure-payment');
    
    if (!paymentBtn) {
        console.error('Payment button not found');
        return;
    }
    
    const originalText = paymentBtn.innerHTML;
    paymentBtn.disabled = true;
    paymentBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Processing...';

    try {
        console.log('Starting payment process for plan:', selectedPlan);
        
        // Prepare payment data
        const paymentData = {
            plan_type: selectedPlan.type,
            plan_name: selectedPlan.name,
            plan_amount: selectedPlan.price,
            total_amount: selectedPlan.total
        };
        
        const response = await fetch('/agent-register-complete', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(paymentData)
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        console.log('Payment response:', data);

        if (data.success) {
            if (data.test_payment) {
                // Test payment mode - Show success popup
                console.log('Test payment mode activated');
                showPaymentSuccessPopup(
                    '🎉 Registration Complete!', 
                    `Your ${selectedPlan.name} registration has been completed successfully in test mode. Welcome to Padosi!`
                );
            } else {
                paymentBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Opening Payment...';
                console.log('Opening Razorpay payment for amount:', data.amount);

                // Check if Razorpay is available
                if (typeof Razorpay === 'undefined') {
                    throw new Error('Razorpay payment gateway not loaded. Please refresh the page.');
                }

                // Razorpay Payment Options
                const options = {
                    "key": data.key,
                    "amount": data.amount,
                    "currency": data.currency || "INR",
                    "name": "Padosi Agent Registration",
                    "description": `Agent Registration - ${selectedPlan.name}`,
                    "image": "{{ asset('images/logo.png') }}",
                    "order_id": data.order_id,
                    "handler": function (response) {
                        console.log('Payment successful:', response);
                        handlePaymentSuccess(response, data.agent_id, selectedPlan);
                    },
                    "prefill": {
                        "name": data.name || "Customer",
                        "email": data.email || "customer@example.com",
                        "contact": data.mobile || "9999999999"
                    },
                    "notes": {
                        "agent_id": data.agent_id,
                        "plan_type": selectedPlan.type,
                        "plan_name": selectedPlan.name
                    },
                    "theme": {
                        "color": "#4f46e5"
                    },
                    "modal": {
                        "ondismiss": function () {
                            console.log('Payment modal dismissed');
                            showPaymentFailedPopup(
                                'Payment Cancelled', 
                                `You cancelled the payment for ${selectedPlan.name}. You can complete the payment later from your dashboard.`
                            );
                            resetPaymentButton(paymentBtn, originalText);
                        }
                    }
                };

                console.log('Razorpay options:', options);

                // Create and open Razorpay instance
                const rzp = new Razorpay(options);
                
                rzp.on('payment.failed', function (response) {
                    console.error('Payment failed:', response.error);
                    // Close modal on failure
                    // if (rzp) {
                    //     rzp.close();
                    // }
                    showPaymentFailedPopup(
                        'Payment Failed',
                        `Payment for ${selectedPlan.name} failed: ${response.error.description}. Please try again or use a different payment method.`
                    );
                    resetPaymentButton(paymentBtn, originalText);
                });

                // Open payment modal
                rzp.open();
                
            }
        } else {
            console.error('Registration failed:', data);
            showPaymentFailedPopup(
                'Registration Failed', 
                data.message || `Unable to process ${selectedPlan.name} registration. Please try again.`
            );
            resetPaymentButton(paymentBtn, originalText);
        }
    } catch (error) {
        console.error('Payment error:', error);
        showPaymentFailedPopup(
            'Payment Error', 
            `Unable to process payment for ${selectedPlan.name}. Please check your internet connection and try again. Error: ${error.message}`
        );
        resetPaymentButton(paymentBtn, originalText);
    }
}

// Handle Razorpay Payment Success - UPDATED
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

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();

        if (data.success) {
            showPaymentSuccessPopup(
                '🎉 Payment Successful!',
                `Your payment for ${plan.name} has been processed successfully and your registration is now complete. Welcome to Padosi!`
            );
        } else {
            showPaymentFailedPopup('Payment Verification Failed', data.message || 'Unable to verify payment. Please contact support.');
        }
    } catch (error) {
        showPaymentFailedPopup('Payment Verification Failed', 'Unable to verify payment. Please contact our support team.');
    }
}

// Payment Popup Functions
function showPaymentSuccessPopup(title, message) {
    showCustomPopup('success', title, message);
    setTimeout(() => {
        //window.location.reload();
        window.location.href = '/';

    }, 5000);
}

function showPaymentFailedPopup(title, message) {
    showCustomPopup('error', title, message);
}

function showCustomPopup(type, title, message) {
    // Create popup overlay
    const popupOverlay = document.createElement('div');
    popupOverlay.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10000;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    `;

    // Create popup content
    const popupContent = document.createElement('div');
    popupContent.style.cssText = `
        background: white;
        padding: 30px;
        border-radius: 15px;
        text-align: center;
        max-width: 400px;
        width: 90%;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    `;

    // Create icon based on type
    const icon = type === 'success' ? '✅' : '❌';
    const titleColor = type === 'success' ? '#10b981' : '#ef4444';
    const buttonColor = type === 'success' ? '#10b981' : '#ef4444';

    popupContent.innerHTML = `
        <div style="font-size: 48px; margin-bottom: 15px;">${icon}</div>
        <h2 style="color: ${titleColor}; margin-bottom: 15px; font-size: 24px;">${title}</h2>
        <p style="color: #6b7280; margin-bottom: 25px; line-height: 1.5;">${message}</p>
        <button onclick="this.closest('div').remove()" 
                style="background: ${buttonColor}; color: white; border: none; padding: 12px 30px; 
                       border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: 600;">
            ${type === 'success' ? 'Continue' : 'Try Again'}
        </button>
        ${type === 'success' ? '<p style="color: #9ca3af; font-size: 14px; margin-top: 15px;">Redirecting in 5 seconds...</p>' : ''}
    `;

    popupOverlay.appendChild(popupContent);
    document.body.appendChild(popupOverlay);

    // Close on overlay click
    popupOverlay.addEventListener('click', function (e) {
        if (e.target === popupOverlay) {
            popupOverlay.remove();
        }
    });
}

function resetPaymentButton(paymentBtn, originalText) {
    if (paymentBtn) {
        paymentBtn.disabled = false;
        paymentBtn.innerHTML = originalText;
    }
}

// Show alert function
function showAlert(message, type = 'info') {
    const alertDiv = document.createElement('div');
    alertDiv.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        z-index: 10001;
        animation: slideIn 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    `;
    
    if (type === 'error') {
        alertDiv.style.backgroundColor = '#ef4444';
    } else if (type === 'success') {
        alertDiv.style.backgroundColor = '#10b981';
    } else {
        alertDiv.style.backgroundColor = '#3b82f6';
    }
    
    alertDiv.textContent = message;
    document.body.appendChild(alertDiv);
    
    // Remove after 5 seconds
    setTimeout(() => {
        alertDiv.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => alertDiv.remove(), 300);
    }, 5000);
}

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
`;
document.head.appendChild(style);

// Initialize with default plan
document.addEventListener('DOMContentLoaded', function() {
    // Set professional as default selected
    selectPlanForPayment('professional');
    
    // Make sure plan buttons are connected
    document.querySelectorAll('.plan-button').forEach(button => {
        const planType = button.closest('.plan-card').classList.contains('basic') ? 'basic' : 'professional';
        button.addEventListener('click', function() {
            selectPlanForPayment(planType);
        });
    });
});
    </script>
</body>
</html>