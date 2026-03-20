<!DOCTYPE html>
<html>
<head>
    <title>Test Live Payment - ₹1</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; text-align: center; }
        .container { max-width: 500px; margin: 0 auto; padding: 30px; border: 2px solid #4CAF50; border-radius: 10px; }
        .btn { background: #4CAF50; color: white; padding: 15px 30px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; }
        .btn:hover { background: #45a049; }
        .status { margin-top: 20px; padding: 15px; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="container">
        <h2>💰 Live Payment Test - ₹1</h2>
        <p><strong>Purpose:</strong> Test your live Razorpay integration</p>
        <p><strong>Amount:</strong> ₹1.00 (including GST)</p>
        <p><strong>Agent ID:</strong> {{ $agent_id }}</p>
        <p><strong>Order ID:</strong> {{ $order_id }}</p>
        
        <button class="btn" onclick="startPayment()">Pay ₹1 Now</button>
        
        <div id="status" class="status"></div>
        <div id="webhookStatus" class="status" style="display: none;"></div>
        
        <div style="margin-top: 30px; font-size: 14px; color: #666;">
            <p><strong>Note:</strong> This is a REAL payment. ₹1 will be deducted from your account.</p>
            <p>Check: 1) Bank statement 2) Razorpay dashboard 3) Your database</p>
        </div>
    </div>

    <script>
        const options = {
            "key": "{{ $key }}",
            "amount": {{ $amount }}, // 100 paise = ₹1
            "currency": "INR",
            "name": "PadosiAgent - Live Test",
            "description": "Live Payment Test - ₹1",
            "image": "{{ asset('images/logo.png') }}",
            "order_id": "{{ $order_id }}",
            "handler": function (response) {
                document.getElementById('status').innerHTML = 
                    '<div class="success"><h4>✅ Payment Successful!</h4>' +
                    '<p>Payment ID: ' + response.razorpay_payment_id + '</p>' +
                    '<p>Order ID: ' + response.razorpay_order_id + '</p>' +
                    '<p>Signature: ' + response.razorpay_signature.substring(0, 20) + '...</p>' +
                    '<p><strong>Now checking webhook...</strong></p></div>';
                
                // Verify payment with your backend
                verifyPayment(response);
                
                // Start polling for webhook
                //pollWebhookStatus("{{ $agent_id }}");
            },
            "prefill": {
                "name": "{{ $name }}",
                "email": "{{ $email }}",
                "contact": "{{ $mobile }}"
            },
            "notes": {
                "agent_id": "{{ $agent_id }}",
                "test_type": "live_1rs_payment"
            },
            "theme": {
                "color": "#4CAF50"
            }
        };

        function startPayment() {
            const rzp = new Razorpay(options);
            
            rzp.on('payment.failed', function (response) {
                document.getElementById('status').innerHTML = 
                    '<div class="error"><h4>❌ Payment Failed</h4>' +
                    '<p>Error: ' + response.error.description + '</p>' +
                    '<p>Code: ' + response.error.code + '</p></div>';
            });

            rzp.open();
        }

        async function verifyPayment(paymentResponse) {
            try {
                const verifyResponse = await fetch('/payment-success', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        razorpay_payment_id: paymentResponse.razorpay_payment_id,
                        razorpay_order_id: paymentResponse.razorpay_order_id,
                        razorpay_signature: paymentResponse.razorpay_signature,
                        agent_id: "{{ $agent_id }}"
                    })
                });
                
                const data = await verifyResponse.json();
                console.log('Payment verification:', data);
            } catch (error) {
                console.error('Verification error:', error);
            }
        }

        // Poll for webhook status (every 5 seconds for 60 seconds)
        async function pollWebhookStatus(agentId) {
            const webhookDiv = document.getElementById('webhookStatus');
            webhookDiv.style.display = 'block';
            
            for (let i = 0; i < 12; i++) {
                webhookDiv.innerHTML = 
                    '<div>🔄 Checking webhook status... (' + (i+1) + '/12)</div>' +
                    '<div>Waiting for webhook to update database...</div>';
                
                try {
                    // Check agent status in database
                    const statusResponse = await fetch('/check-agent-status/' + agentId);
                    const statusData = await statusResponse.json();
                    
                    if (statusData.payment_status === 'completed') {
                        webhookDiv.innerHTML = 
                            '<div class="success">' +
                            '<h4>✅ Webhook SUCCESS!</h4>' +
                            '<p>Database updated via webhook!</p>' +
                            '<p>Payment Status: ' + statusData.payment_status + '</p>' +
                            '<p>Agent Status: ' + statusData.status + '</p>' +
                            '<p><strong>🎉 Live Payment Test COMPLETE!</strong></p>' +
                            '</div>';
                        return;
                    }
                } catch (error) {
                    console.error('Status check error:', error);
                }
                
                // Wait 5 seconds before next check
                await new Promise(resolve => setTimeout(resolve, 5000));
            }
            
            webhookDiv.innerHTML = 
                '<div class="error">' +
                '<h4>⚠️ Webhook NOT Received</h4>' +
                '<p>Webhook did not update database within 60 seconds.</p>' +
                '<p>Check: 1) Laravel logs 2) Razorpay webhook logs 3) CSRF settings</p>' +
                '</div>';
        }
    </script>
</body>
</html>