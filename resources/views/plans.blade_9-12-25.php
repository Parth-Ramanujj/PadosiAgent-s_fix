<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padosi Agent - Choose Your Plan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .header p {
            color: #7f8c8d;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .highlight {
            color: #e74c3c;
            font-weight: bold;
        }

        .pricing-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .pricing-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 500px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .pricing-card.basic {
            border-top: 5px solid #3498db;
        }

        .pricing-card.professional {
            border-top: 5px solid #e74c3c;
            transform: scale(1.05);
        }

        .plan-badge {
            position: absolute;
            top: 20px;
            right: -30px;
            background: #e74c3c;
            color: white;
            padding: 8px 40px;
            transform: rotate(45deg);
            font-weight: bold;
            font-size: 0.8rem;
        }

        .plan-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ecf0f1;
        }

        .plan-name {
            font-size: 1.8rem;
            color: #2c3e50;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .plan-price {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .basic .plan-price {
            color: #3498db;
        }

        .professional .plan-price {
            color: #e74c3c;
        }

        .plan-period {
            color: #7f8c8d;
            font-size: 1rem;
        }

        .plan-desc {
            color: #7f8c8d;
            font-size: 0.95rem;
            margin-top: 10px;
        }

        .features-list {
            margin-bottom: 30px;
        }

        .feature-category {
            margin-bottom: 25px;
        }

        .category-title {
            font-size: 1.2rem;
            color: #2c3e50;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 2px solid #ecf0f1;
            font-weight: 600;
        }

        .feature-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px dashed #ecf0f1;
        }

        .feature-name {
            color: #34495e;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
        }

        .feature-name i {
            margin-right: 8px;
            font-size: 0.9rem;
        }

        .feature-value {
            font-weight: 600;
            font-size: 0.9rem;
            text-align: right;
        }

        .basic .feature-value {
            color: #3498db;
        }

        .professional .feature-value {
            color: #e74c3c;
        }

        .feature-value.na {
            color: #95a5a6;
        }

        .feature-value.coming {
            color: #f39c12;
        }

        .feature-value.limited {
            color: #e67e22;
        }

        .plan-button {
            display: block;
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            text-decoration: none;
        }

        .basic .plan-button {
            background: #3498db;
            color: white;
        }

        .basic .plan-button:hover {
            background: #2980b9;
        }

        .professional .plan-button {
            background: #e74c3c;
            color: white;
        }

        .professional .plan-button:hover {
            background: #c0392b;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal {
            background: white;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            padding: 30px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            transform: translateY(-50px);
            transition: transform 0.3s ease;
        }

        .modal-overlay.active .modal {
            transform: translateY(0);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #ecf0f1;
        }

        .modal-title {
            font-size: 1.5rem;
            color: #2c3e50;
            font-weight: 700;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #7f8c8d;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close-modal:hover {
            color: #e74c3c;
        }

        .plan-summary {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #dee2e6;
        }

        .summary-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .summary-label {
            color: #6c757d;
        }

        .summary-value {
            font-weight: 600;
            color: #2c3e50;
        }

        .total-amount {
            font-size: 1.3rem;
            color: #e74c3c;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 600;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            margin: 25px 0;
        }

        .terms-checkbox input {
            margin-right: 10px;
            margin-top: 3px;
        }

        .terms-text {
            font-size: 0.9rem;
            color: #6c757d;
            line-height: 1.5;
        }

        .terms-link {
            color: #3498db;
            text-decoration: none;
        }

        .terms-link:hover {
            text-decoration: underline;
        }

        .payment-button {
            display: block;
            width: 100%;
            padding: 15px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .payment-button:hover {
            background: #218838;
        }

        .payment-button:disabled {
            background: #6c757d;
            cursor: not-allowed;
        }

        .payment-button i {
            font-size: 1.2rem;
        }

        .discount-note {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            text-align: center;
            color: #856404;
        }

        .discount-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: #e74c3c;
        }

        /* Responsive */
        @media (max-width: 1100px) {
            .pricing-container {
                flex-direction: column;
                align-items: center;
            }
            
            .pricing-card.professional {
                transform: none;
            }
            
            .pricing-card {
                max-width: 600px;
            }
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }
            
            .plan-price {
                font-size: 2.5rem;
            }
            
            .pricing-card {
                padding: 20px;
            }
            
            .modal {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Choose Your <span class="highlight"><span style="color: #003AAD">Padosi</span><span style="color: #06A441;"> Agent</span> Plan</h1>
            <p>Boost your real estate business with our digital solutions. Select the plan that best fits your needs and start growing today!</p>
        </div>
        
        <div class="pricing-container">
            <!-- Basic Plan Card -->
            <div class="pricing-card basic">
                <div class="plan-header">
                    <div class="plan-name">Basic Plan</div>
                    <div class="plan-price">₹589</div>
                    <div class="plan-period">One-Time Payment</div>
                    <div class="plan-desc">Perfect for getting started</div>
                </div>
                
                <div class="features-list">
                    <!-- Sales Kit -->
                    <div class="feature-category">
                        <div class="category-title">Sales Kit</div>
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
                        <div class="feature-item">
                            <div class="feature-name"><i class="fas fa-ad"></i> Paid Lead Inquiries*</div>
                            <div class="feature-value na">NA</div>
                        </div>
                    </div>
                    
                    <!-- Assert & Marketing Kit -->
                    <div class="feature-category">
                        <div class="category-title">Assert & Marketing</div>
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
                        <div class="category-title">Business Support</div>
                        <div class="feature-item">
                            <div class="feature-name"><i class="fas fa-star"></i> Profile Review & Rating</div>
                            <div class="feature-value">Lifetime*</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-name"><i class="fas fa-badge-check"></i> Trusted Agent Badge</div>
                            <div class="feature-value na">-</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-name"><i class="fas fa-chart-line"></i> Profile Analytics</div>
                            <div class="feature-value limited">Basic</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-name"><i class="fas fa-tools"></i> Client Retention Tools</div>
                            <div class="feature-value limited">Limited Access</div>
                        </div>
                    </div>
                </div>
                
                <button class="plan-button" onclick="openModal('basic')">
                    Get Started
                </button>
            </div>
            
            <!-- Professional Plan Card -->
            <div class="pricing-card professional">
                <div class="plan-badge">RECOMMENDED</div>
                <div class="plan-header">
                    <div class="plan-name">Professional Plan</div>
                    <div class="plan-price">₹2,359</div>
                    <div class="plan-period">One-Time Payment</div>
                    <div class="plan-desc">Best value for growing agents</div>
                </div>
                
                <div class="features-list">
                    <!-- Sales Kit -->
                    <div class="feature-category">
                        <div class="category-title">Sales Kit</div>
                        <div class="feature-item">
                            <div class="feature-name"><i class="fas fa-leaf"></i> Organic Lead Inquiries</div>
                            <div class="feature-value">Yes (Priority)</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-name"><i class="fas fa-concierge-bell"></i> Service Lead Inquiries*</div>
                            <div class="feature-value">Yes (Priority)</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-name"><i class="fas fa-handshake"></i> Referral Lead Inquiries</div>
                            <div class="feature-value">Lifetime*</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-name"><i class="fas fa-ad"></i> Paid Lead Inquiries*</div>
                            <div class="feature-value">Yes</div>
                        </div>
                    </div>
                    
                    <!-- Assert & Marketing Kit -->
                    <div class="feature-category">
                        <div class="category-title">Assert & Marketing</div>
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
                        <div class="category-title">Business Support</div>
                        <div class="feature-item">
                            <div class="feature-name"><i class="fas fa-star"></i> Profile Review & Rating</div>
                            <div class="feature-value">Lifetime*</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-name"><i class="fas fa-badge-check"></i> Trusted Agent Badge</div>
                            <div class="feature-value">Yes</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-name"><i class="fas fa-chart-line"></i> Profile Analytics</div>
                            <div class="feature-value">Advanced</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-name"><i class="fas fa-tools"></i> Client Retention Tools</div>
                            <div class="feature-value">Full Access</div>
                        </div>
                    </div>
                    
                    <!-- Coming Soon Features -->
                    <div class="feature-category">
                        <div class="category-title">Premium Features</div>
                        <div class="feature-item">
                            <div class="feature-name"><i class="fas fa-cogs"></i> Business Management Kit</div>
                            <div class="feature-value coming">Coming Soon (Priority)</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-name"><i class="fas fa-boxes"></i> Cross Sell Products</div>
                            <div class="feature-value coming">Coming Soon (Priority)</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-name"><i class="fas fa-rocket"></i> Many More...</div>
                            <div class="feature-value coming">Coming Soon...</div>
                        </div>
                    </div>
                </div>
                
                <button class="plan-button" onclick="openModal('professional')">
                    Get Professional
                </button>
            </div>
        </div>
        
        <div class="discount-note">
            <p><strong>Pre-Launch Discount Offer:</strong> Limited time only! Get started at special introductory prices.</p>
            <p class="discount-price">Basic: ₹589 (₹2,359 value) | Professional: ₹2,359 (₹8,258 value)</p>
        </div>
    </div>
    
    <!-- Payment Modal -->
    <div class="modal-overlay" id="paymentModal">
        <div class="modal">
            <div class="modal-header">
                <h2 class="modal-title">Complete Your Purchase</h2>
                <button class="close-modal" onclick="closeModal()">&times;</button>
            </div>
            
            <div class="plan-summary">
                <div class="summary-item">
                    <span class="summary-label">Selected Plan:</span>
                    <span class="summary-value" id="selectedPlan">Basic Plan</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Plan Price:</span>
                    <span class="summary-value" id="planPrice">₹589</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">GST (18%):</span>
                    <span class="summary-value" id="gstAmount">₹106.02</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Total Amount:</span>
                    <span class="summary-value total-amount" id="totalAmount">₹695.02</span>
                </div>
            </div>
            
            <form id="paymentForm">
                <div class="form-group">
                    <label class="form-label" for="name">Full Name</label>
                    <input type="text" id="name" class="form-input" placeholder="Enter your full name" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" id="email" class="form-input" placeholder="Enter your email" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="phone">Phone Number</label>
                    <input type="tel" id="phone" class="form-input" placeholder="Enter your phone number" required>
                </div>
                
                <div class="terms-checkbox">
                    <input type="checkbox" id="terms" required>
                    <label for="terms" class="terms-text">
                        I agree to the <a href="#" class="terms-link">Terms and Conditions</a>. 
                        *Service Lead Inquiries only for experienced agents (subject to verification). 
                        *Lifetime Access means access as long as the company operates or AMC is paid. 
                        PadosiAgent is a Digital Platform and does not sell Insurance.
                    </label>
                </div>
                
                <button type="submit" class="payment-button" id="payButton">
                    <i class="fas fa-lock"></i> Pay Securely with Razorpay
                </button>
            </form>
        </div>
    </div>

    <script>
        // Modal functionality
        const paymentModal = document.getElementById('paymentModal');
        let selectedPlan = 'basic';
        let selectedPrice = 589;
        
        function openModal(plan) {
            selectedPlan = plan;
            
            if (plan === 'basic') {
                selectedPrice = 499;
                document.getElementById('selectedPlan').textContent = 'Basic Plan';
                document.getElementById('planPrice').textContent = '₹499';
            } else {
                selectedPrice = 1999;
                document.getElementById('selectedPlan').textContent = 'Professional Plan';
                document.getElementById('planPrice').textContent = '₹1,999';
            }
            
            // Calculate GST (18%)
            const gst = selectedPrice * 0.18;
            const total = selectedPrice + gst;
            
            document.getElementById('gstAmount').textContent = '₹' + gst.toFixed(2);
            document.getElementById('totalAmount').textContent = '₹' + total.toFixed(2);
            
            paymentModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closeModal() {
            paymentModal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
        
        // Close modal when clicking outside
        paymentModal.addEventListener('click', function(e) {
            if (e.target === paymentModal) {
                closeModal();
            }
        });
        
        // Payment form submission
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            
            // Prepare payment data
            const amountInPaise = Math.round(selectedPrice * 100); // Razorpay uses paise
            const totalAmount = selectedPrice + (selectedPrice * 0.18);
            
            // In a real application, you would make an API call to your server
            // to create a Razorpay order. Here's a mock implementation:
            
            const options = {
                "key": "rzp_test_YOUR_KEY_HERE", // Replace with your Razorpay Key ID
                "amount": amountInPaise,
                "currency": "INR",
                "name": "Padosi Agent",
                "description": `${selectedPlan === 'basic' ? 'Basic' : 'Professional'} Plan Purchase`,
                "image": "https://padosiagent.com/logo.png", // Your logo URL
                "order_id": "", // This should come from your server
                "handler": function(response) {
                    // Handle successful payment
                    alert('Payment Successful! Payment ID: ' + response.razorpay_payment_id);
                    closeModal();
                    
                    // In real app, send payment details to your server
                    // const paymentData = {
                    //     paymentId: response.razorpay_payment_id,
                    //     orderId: response.razorpay_order_id,
                    //     signature: response.razorpay_signature,
                    //     plan: selectedPlan,
                    //     amount: totalAmount,
                    //     customerName: name,
                    //     customerEmail: email,
                    //     customerPhone: phone
                    // };
                    // Send to your backend
                },
                "prefill": {
                    "name": name,
                    "email": email,
                    "contact": phone
                },
                "notes": {
                    "plan": selectedPlan,
                    "customer_name": name
                },
                "theme": {
                    "color": "#e74c3c"
                }
            };
            
            // For demo purposes, we'll show a mock payment success
            // In production, uncomment the Razorpay code below
            
            // const rzp = new Razorpay(options);
            // rzp.open();
            
            // Demo mode - simulate payment
            if (confirm(`DEMO MODE: Proceed with ${selectedPlan} plan payment of ₹${totalAmount.toFixed(2)}?`)) {
                setTimeout(() => {
                    alert('Payment Successful! Demo transaction completed.');
                    closeModal();
                    document.getElementById('paymentForm').reset();
                }, 1000);
            }
        });
        
        // Terms modal (if needed)
        function showTerms() {
            alert(`Terms and Conditions:
            
1. Service Lead Inquiries are only accessible for experienced agents, subject to verification.
2. Lifetime Access means access to features as long as the company continues to operate or you are paying the AMC.
3. PadosiAgent is a Digital Platform and does not sell Insurance.
4. All payments are non-refundable.
5. The platform reserves the right to modify features and pricing.
6. User must comply with all applicable laws and regulations.
            
For complete terms, visit our website.`);
        }
        
        // Add click event to terms link
        document.querySelector('.terms-link').addEventListener('click', function(e) {
            e.preventDefault();
            showTerms();
        });
    </script>
</body>
</html>