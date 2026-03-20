<!DOCTYPE html>
<!-- resources/views/agent-registration.blade.php -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Registration</title>
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

        .file-input {
            padding: 10px;
            background: #f8fafc;
            border: 2px dashed #e5e7eb;
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

        .google-btn {
            background: white;
            color: #374151;
            border: 2px solid #e5e7eb;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .google-btn:hover {
            border-color: #4f46e5;
            transform: translateY(-1px);
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }

        .divider::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e5e7eb;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            color: #6b7280;
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

        .payment-info {
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
        }

        .payment-amount {
            font-size: 24px;
            font-weight: bold;
            color: #0369a1;
        }

        /* Confirmation Modal Styles */
        .confirmation-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .confirmation-content {
            background: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }

        .confirmation-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 25px;
        }

        .btn-confirm {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-cancel {
            background: #ef4444;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        .btn-cancel:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
        }

        .success-message {
            background: #d1fae5;
            color: #065f46;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
            display: none;
        }

        .success-message h3 {
            margin-bottom: 10px;
        }

        .hidden {
            display: none;
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

            <div id="registrationSuccess" class="success-message">
                <h3>✅ Registration Successful!</h3>
                <p>Your details have been saved. Please complete the payment to activate your account.</p>
                <button id="proceedToPayment" class="btn-confirm">Proceed to Payment</button>
            </div>

            <form id="agentForm">
                @csrf
                <div class="form-group">
                    <input type="text" name="fullname" placeholder="Full Name *" required>
                </div>

                <div class="form-group">
                    <input type="email" name="email" placeholder="Email Address *" required>
                </div>

                <div class="form-group">
                    <input type="tel" name="mobile" placeholder="Mobile Number *" pattern="[0-9]{10}" required>
                </div>

                {{-- <div class="form-group">
                    <input type="date" name="dob" placeholder="Date of Birth" required>
                </div> --}}

                <div class="form-group">
                    <select name="gender" required>
                        <option value="">Gender *</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <select name="profession" required>
                        <option value="">Select Profession *</option>
                        <option>LIC Agent</option>
                        <option>CA</option>
                        <option>Lawyer</option>
                        <option>Vehicle Insurance</option>
                        <option>Health Insurance</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" name="company" placeholder="Agency / Company Name">
                </div>

                <div class="form-group">
                    <input type="text" name="city" placeholder="City / Pincode" required>
                </div>

                <div class="form-group">
                    <textarea name="experience" rows="3" placeholder="Experience / Details"></textarea>
                </div>

                {{-- <div class="form-group">
                    <label>Upload Profile Photo</label>
                    <input type="file" name="photo" class="file-input" accept="image/*" required>
                </div>

                <div class="form-group">
                    <label>Upload ID Proof (png/jpg/pdf)</label>
                    <input type="file" name="idproof" class="file-input" accept=".png,.jpg,.jpeg,.pdf" required>
                </div> --}}

                <button type="submit" class="submit-btn">Register Now</button>
            </form>
        </div>
    </div>

    <!-- Payment Confirmation Modal -->
    <div id="paymentConfirmation" class="confirmation-modal">
        <div class="confirmation-content">
            <h2>Complete Your Registration</h2>
            <p>Your registration details have been saved successfully!</p>
            <div class="payment-info">
                <div>Registration Fee</div>
                <div class="payment-amount">₹2,000</div>
                <small>Pay now to activate your agent account</small>
            </div>
            <div class="confirmation-buttons">
                <button id="confirmPayment" class="btn-confirm">Pay Now</button>
                <button id="cancelPayment" class="btn-cancel">Pay Later</button>
            </div>
        </div>
    </div>

    <script>
        let currentAgentId = null;
        let razorpayOptions = null;

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

        function showConfirmationModal(agentId) {
            currentAgentId = agentId;
            document.getElementById('paymentConfirmation').style.display = 'flex';
        }

        function hideConfirmationModal() {
            document.getElementById('paymentConfirmation').style.display = 'none';
        }

        function showRegistrationSuccess() {
            document.getElementById('agentForm').style.display = 'none';
            document.getElementById('registrationSuccess').style.display = 'block';
        }

        function resetForm() {
            document.getElementById('agentForm').style.display = 'block';
            document.getElementById('registrationSuccess').style.display = 'none';
            document.getElementById('agentForm').reset();
        }

        // Form submission - Step 1: Save to database
        document.getElementById('agentForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Registering...';

            try {
                const response = await fetch('/agent-register', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                });

                const data = await response.json();

                if (data.success) {
                    showRegistrationSuccess();
                    currentAgentId = data.agent_id;
                    showAlert('Registration successful! Please proceed with payment.', 'success');
                } else {
                    showAlert(data.message || 'Registration failed', 'error');
                }
            } catch (error) {
                showAlert('An error occurred. Please try again.', 'error');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Register Now';
            }
        });

        // Step 2: Proceed to payment after registration success
        document.getElementById('proceedToPayment').addEventListener('click', function() {
            showConfirmationModal(currentAgentId);
        });

        // Step 3: Confirm payment initiation
        document.getElementById('confirmPayment').addEventListener('click', async function() {
            const confirmBtn = this;
            confirmBtn.disabled = true;
            confirmBtn.textContent = 'Processing...';

            try {
                const response = await fetch('/initiate-payment', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        agent_id: currentAgentId
                    })
                });

                const data = await response.json();

                if (data.success) {
                    razorpayOptions = {
                        "key": data.key,
                        "amount": data.amount,
                        "currency": data.currency,
                        "name": "Agent Registration",
                        "description": "Registration Fee - ₹2,000",
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
                                showAlert('Payment cancelled. You can try again later.', 'error');
                            }
                        }
                    };

                    const rzp = new Razorpay(razorpayOptions);
                    rzp.open();
                    hideConfirmationModal();
                } else {
                    showAlert(data.message || 'Payment initiation failed', 'error');
                }
            } catch (error) {
                showAlert('An error occurred. Please try again.', 'error');
            } finally {
                confirmBtn.disabled = false;
                confirmBtn.textContent = 'Pay Now';
            }
        });

        // Step 4: Handle payment cancellation
        document.getElementById('cancelPayment').addEventListener('click', function() {
            hideConfirmationModal();
            showAlert('You can complete the payment later. Your registration details are saved.', 'success');
        });

        // Step 5: Handle payment success
        async function handlePaymentSuccess(paymentResponse, agentId) {
            try {
                const response = await fetch('/payment-success', {
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

                const data = await response.json();

                if (data.success) {
                    showAlert(data.message, 'success');
                    setTimeout(() => {
                        resetForm();
                    }, 3000);
                } else {
                    showAlert(data.message, 'error');
                }
            } catch (error) {
                showAlert('Payment verification failed. Please contact support.', 'error');
            }
        }

        // Close modal when clicking outside
        document.getElementById('paymentConfirmation').addEventListener('click', function(e) {
            if (e.target === this) {
                hideConfirmationModal();
            }
        });
    </script>
</body>
</html>