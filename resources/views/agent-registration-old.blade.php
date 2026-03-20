<!DOCTYPE html>
<!-- resources/views/agent-registration.blade.php -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Registration - Padosi</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
        }

        .header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .header p {
            opacity: 0.9;
        }

        .form-container {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .checkbox-label:hover {
            border-color: #4f46e5;
        }

        .checkbox-label input[type="checkbox"] {
            width: 18px;
            height: 18px;
        }

        .submit-btn {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.3);
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .step-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 25px 0;
        }

        .step {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            background: #e5e7eb;
            color: #6b7280;
        }

        .step.active {
            background: #4f46e5;
            color: white;
        }

        .step.completed {
            background: #10b981;
            color: white;
        }

        .step-line {
            flex: 1;
            height: 3px;
            background: #e5e7eb;
            margin: 0 10px;
        }

        .step-line.completed {
            background: #10b981;
        }

        .modal-step {
            display: none;
        }

        .modal-step.active {
            display: block;
        }

        .portfolio-inputs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .selected-items {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }

        .selected-item {
            background: #e5e7eb;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .remove-item {
            background: none;
            border: none;
            cursor: pointer;
            color: #6b7280;
        }

        .company-input-container {
            display: flex;
            gap: 10px;
        }

        .btn-add {
            background: #4f46e5;
            color: white;
            border: none;
            padding: 0 15px;
            border-radius: 6px;
            cursor: pointer;
        }

        .pricing-card {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
        }

        .price-header {
            margin-bottom: 20px;
        }

        .original-price {
            text-decoration: line-through;
            color: #6b7280;
            font-size: 18px;
        }

        .discounted-price {
            font-size: 32px;
            font-weight: bold;
            color: #059669;
        }

        .savings-badge {
            background: #dc2626;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 14px;
            display: inline-block;
            margin-top: 8px;
        }

        .benefits-list {
            text-align: left;
            margin: 20px 0;
        }

        .benefits-list ul {
            list-style: none;
            padding: 0;
        }

        .benefits-list li {
            padding: 8px 0;
            color: #374151;
        }

        .modal-actions {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            flex: 1;
        }

        .btn-primary {
            background: #4f46e5;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            flex: 1;
        }

        .btn-payment {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            font-size: 16px;
            font-weight: bold;
        }

        .text-muted {
            color: #6b7280;
        }

        .small {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Agent Registration</h1>
            <p>Join our network of professional agents</p>
        </div>

        <div class="form-container">
            <div id="successAlert" class="alert alert-success"></div>
            <div id="errorAlert" class="alert alert-error"></div>

            <!-- Step 1: Basic Information -->
            <div class="modal-step active" data-step="1">
                <h2>Basic Information</h2>
                <p class="text-muted">Tell us about yourself</p>
                
                <div class="step-indicator">
                    <div class="step active">1</div>
                    <div class="step-line"></div>
                    <div class="step">2</div>
                    <div class="step-line"></div>
                    <div class="step">3</div>
                </div>

                <form id="agentForm1">
                    @csrf
                    <div class="form-group">
                        <label>Full Name *</label>
                        <input type="text" name="fullname" placeholder="Enter your full name" required>
                    </div>

                    <div class="form-group">
                        <label>Email Address *</label>
                        <input type="email" name="email" placeholder="your.email@example.com" required>
                    </div>

                    <div class="form-group">
                        <label>Mobile Number *</label>
                        <input type="tel" name="mobile" placeholder="10-digit mobile number" pattern="[0-9]{10}" required>
                    </div>

                    <div class="form-group">
                        <label>I am a * (Select all that apply)</label>
                        <div class="checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="user_types[]" value="insurance_agent">
                                <span>Insurance Agent</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="user_types[]" value="mutual_fund_agent">
                                <span>Mutual Fund Agent</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="user_types[]" value="ca">
                                <span>Chartered Accountant</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="user_types[]" value="lawyer">
                                <span>Lawyer</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">Continue</button>
                </form>
            </div>

            <!-- Step 2: Professional Details (Only for Insurance Agents) -->
            <div class="modal-step" data-step="2">
                <h2>Professional Details</h2>
                <p class="text-muted">Tell us about your professional experience</p>
                
                <div class="step-indicator">
                    <div class="step completed">✓</div>
                    <div class="step-line completed"></div>
                    <div class="step active">2</div>
                    <div class="step-line"></div>
                    <div class="step">3</div>
                </div>

                <form id="agentForm2">
                    @csrf
                    <div class="form-group">
                        <label>PAN / IRDAI License Number *</label>
                        <input type="text" name="license_number" placeholder="Enter your PAN or IRDAI license" required>
                    </div>

                    <div class="form-group">
                        <label>Insurance Companies *</label>
                        <div class="company-input-container">
                            <input type="text" id="companyInput" placeholder="Type company name...">
                            <button type="button" class="btn-add" onclick="addCompany()">Add</button>
                        </div>
                        <div id="selectedCompanies" class="selected-items"></div>
                        <input type="hidden" name="insurance_companies" id="insuranceCompaniesInput">
                    </div>

                    <div class="form-group">
                        <label>Years of Experience *</label>
                        <select name="experience_range" required>
                            <option value="">Select experience</option>
                            <option value="0-2">0-2 years</option>
                            <option value="2-5">2-5 years</option>
                            <option value="5-10">5-10 years</option>
                            <option value="10+">10+ years</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Client Base Size *</label>
                        <select name="client_base" required>
                            <option value="">Select client base</option>
                            <option value="0-50">0-50 clients</option>
                            <option value="50-200">50-200 clients</option>
                            <option value="200-500">200-500 clients</option>
                            <option value="500+">500+ clients</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Portfolio Breakdown (%)</label>
                        <div class="portfolio-inputs">
                            <input type="number" name="life_insurance" placeholder="Life Insurance %" min="0" max="100" value="0">
                            <input type="number" name="health_insurance" placeholder="Health Insurance %" min="0" max="100" value="0">
                            <input type="number" name="general_insurance" placeholder="General Insurance %" min="0" max="100" value="0">
                            <input type="number" name="mutual_funds" placeholder="Mutual Funds %" min="0" max="100" value="0">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Desired Services *</label>
                        <div class="checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="desired_services[]" value="digital_profile">
                                <span>Digital Profile</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="desired_services[]" value="lead_generation">
                                <span>Lead Generation</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="desired_services[]" value="client_management">
                                <span>Client Management</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="desired_services[]" value="marketing_tools">
                                <span>Marketing Tools</span>
                            </label>
                        </div>
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn-secondary" onclick="previousStep()">Back</button>
                        <button type="submit" class="btn-primary">Continue</button>
                    </div>
                </form>
            </div>

            <!-- Step 3: Payment -->
            <div class="modal-step" data-step="3">
                <h2>🎉 Early Bird Special!</h2>
                <p class="text-muted">Join now and save big on your registration</p>
                
                <div class="step-indicator">
                    <div class="step completed">✓</div>
                    <div class="step-line completed"></div>
                    <div class="step completed">✓</div>
                    <div class="step-line completed"></div>
                    <div class="step active">3</div>
                </div>

                <div class="pricing-card">
                    <div class="price-header">
                        <div class="original-price">₹5,000</div>
                        <div class="discounted-price">₹999</div>
                        <div class="savings-badge">Save 80%</div>
                    </div>

                    <div class="benefits-list">
                        <h3>What You Get:</h3>
                        <ul>
                            <li>✓ Professional Digital Profile</li>
                            <li>✓ Lead Generation Tools</li>
                            <li>✓ Client Management System</li>
                            <li>✓ Marketing Automation</li>
                            <li>✓ Analytics Dashboard</li>
                            <li>✓ Priority Support</li>
                            <li>✓ Training & Resources</li>
                            <li>✓ Lifetime Platform Access</li>
                        </ul>
                    </div>

                    <div class="payment-info">
                        <p><strong>One-time payment</strong> - No recurring fees!</p>
                        <p class="text-muted small">Secure payment powered by Razorpay</p>
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn-secondary" onclick="previousStep()">Back</button>
                        <button type="button" class="btn-primary btn-payment" onclick="handlePayment()">
                            Pay ₹999 & Register
                        </button>
                    </div>

                    <p class="text-muted small" style="text-align: center; margin-top: 1rem;">
                        🔒 100% secure payment | 💯 Money-back guarantee
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentStep = 1;
        let selectedCompanies = [];
        const indianInsuranceCompanies = [
            'LIC', 'HDFC Life', 'ICICI Prudential', 'SBI Life', 'Max Life', 
            'Bajaj Allianz', 'Kotak Life', 'Aditya Birla Sun Life', 'TATA AIG',
            'Reliance Nippon', 'PNB MetLife', 'Aviva Life', 'Shriram Life',
            'Sahara Life', 'Star Health', 'HDFC ERGO', 'ICICI Lombard',
            'Bajaj Allianz General', 'New India Assurance', 'United India',
            'National Insurance', 'Oriental Insurance'
        ];

        function showAlert(message, type = 'success') {
            const alertDiv = type === 'success' ? document.getElementById('successAlert') : document.getElementById('errorAlert');
            const otherAlert = type === 'success' ? document.getElementById('errorAlert') : document.getElementById('successAlert');
            
            alertDiv.textContent = message;
            alertDiv.style.display = 'block';
            otherAlert.style.display = 'none';
            
            if (type === 'success') {
                setTimeout(() => {
                    alertDiv.style.display = 'none';
                }, 5000);
            }
        }

        function showStep(step) {
            document.querySelectorAll('.modal-step').forEach(el => {
                el.classList.remove('active');
            });
            document.querySelector(`[data-step="${step}"]`).classList.add('active');
            currentStep = step;
        }

        function previousStep() {
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
        }

        function addCompany() {
            const companyInput = document.getElementById('companyInput');
            const companyName = companyInput.value.trim();
            
            if (companyName && !selectedCompanies.includes(companyName)) {
                selectedCompanies.push(companyName);
                updateSelectedCompanies();
                companyInput.value = '';
            }
        }

        function updateSelectedCompanies() {
            const container = document.getElementById('selectedCompanies');
            const hiddenInput = document.getElementById('insuranceCompaniesInput');
            
            container.innerHTML = '';
            selectedCompanies.forEach((company, index) => {
                const item = document.createElement('div');
                item.className = 'selected-item';
                item.innerHTML = `
                    ${company}
                    <button type="button" class="remove-item" onclick="removeCompany(${index})">×</button>
                `;
                container.appendChild(item);
            });
            
            hiddenInput.value = JSON.stringify(selectedCompanies);
        }

        function removeCompany(index) {
            selectedCompanies.splice(index, 1);
            updateSelectedCompanies();
        }

        // In your Blade file, update ALL fetch calls:

// Step 1 Form Submission
document.getElementById('agentForm1').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Processing...';

    try {
        const response = await fetch('{{ url("/agent-register-step1") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();

        if (data.success) {
            showStep(data.next_step);
            showAlert('Basic information saved successfully!', 'success');
        } else {
            showAlert('Error: ' + data.message, 'error');
        }
    } catch (error) {
        showAlert('Network Error: ' + error.message, 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Continue';
    }
});

// Step 2 Form Submission
document.getElementById('agentForm2').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Processing...';

    try {
        const response = await fetch('{{ url("/agent-register-step2") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();

        if (data.success) {
            showStep(data.next_step);
            showAlert('Professional details saved successfully!', 'success');
        } else {
            showAlert('Error: ' + data.message, 'error');
        }
    } catch (error) {
        showAlert('Network Error: ' + error.message, 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Continue';
    }
});

// Complete Registration with Razorpay Payment
async function handlePayment() {
    const paymentBtn = document.querySelector('.btn-payment');
    paymentBtn.disabled = true;
    paymentBtn.textContent = 'Creating Registration...';

    try {
        const response = await fetch('{{ url("/agent-register-complete") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();

        if (data.success) {
            if (data.test_payment) {
                // Test payment mode - Show success popup
                showPaymentSuccessPopup('🎉 Registration Complete!', 'Your registration has been completed successfully in test mode. Welcome to Padosi!');
            } else {
                paymentBtn.textContent = 'Opening Payment...';
                
                // Razorpay Payment
                const options = {
                    "key": data.key,
                    "amount": data.amount,
                    "currency": data.currency,
                    "name": "Padosi Agent Registration",
                    "description": "Agent Registration Fee - ₹2358",
                    "image": "/favicon.ico",
                    "order_id": data.order_id,
                    "handler": function (response) {
                        handlePaymentSuccess(response, data.agent_id);
                    },
                    "prefill": {
                        "name": data.name,
                        "email": data.email,
                        "contact": data.mobile
                    },
                    "notes": {
                        "agent_id": data.agent_id
                    },
                    "theme": {
                        "color": "#4f46e5"
                    },
                    "modal": {
                        "ondismiss": function() {
                            showPaymentFailedPopup('Payment Cancelled', 'You cancelled the payment. You can complete the payment later from your dashboard.');
                            resetPaymentButton();
                        }
                    }
                };

                const rzp = new Razorpay(options);
                rzp.on('payment.failed', function (response) {
                    console.error('Payment failed:', response.error);
                    showPaymentFailedPopup(
                        'Payment Failed', 
                        `Payment failed: ${response.error.description}. Please try again or use a different payment method.`
                    );
                    resetPaymentButton();
                });
                
                rzp.open();
            }
        } else {
            showPaymentFailedPopup('Registration Failed', data.message || 'Unable to process registration. Please try again.');
            resetPaymentButton();
        }
    } catch (error) {
        showPaymentFailedPopup('Network Error', 'Unable to connect to server. Please check your internet connection and try again.');
        resetPaymentButton();
    }
}

// Handle Razorpay Payment Success
async function handlePaymentSuccess(paymentResponse, agentId) {
    try {
        const response = await fetch('{{ url("/payment-success") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({
                razorpay_payment_id: paymentResponse.razorpay_payment_id,
                razorpay_order_id: paymentResponse.razorpay_order_id,
                razorpay_signature: paymentResponse.razorpay_signature,
                agent_id: agentId
            })
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();

        if (data.success) {
            showPaymentSuccessPopup(
                '🎉 Payment Successful!', 
                'Your payment has been processed successfully and your registration is now complete. Welcome to Padosi!'
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
        window.location.reload();
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
    popupOverlay.addEventListener('click', function(e) {
        if (e.target === popupOverlay) {
            popupOverlay.remove();
        }
    });
}

function resetPaymentButton() {
    const paymentBtn = document.querySelector('.btn-payment');
    if (paymentBtn) {
        paymentBtn.disabled = false;
        paymentBtn.textContent = 'Pay ₹2358 & Register';
    }
}

// Test route check (optional)
document.addEventListener('DOMContentLoaded', function() {
    // Initialize company datalist
    const companyInput = document.getElementById('companyInput');
    const datalist = document.createElement('datalist');
    datalist.id = 'companyList';
    
    indianInsuranceCompanies.forEach(company => {
        const option = document.createElement('option');
        option.value = company;
        datalist.appendChild(option);
    });
    
    companyInput.setAttribute('list', 'companyList');
    document.body.appendChild(datalist);
});
    </script>
</body>
</html>