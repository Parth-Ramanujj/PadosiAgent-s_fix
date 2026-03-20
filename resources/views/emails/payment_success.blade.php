<!DOCTYPE html>
<html>
<head>
    <title>Registration Successful - PadosiAgent</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #334155;
            margin: 0;
            padding: 0;
            background-color: #f1f5f9;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #0d9488;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            letter-spacing: 1px;
            text-align: center; /* Force centering */
        }
        .content {
            padding: 40px;
        }
        .welcome-text {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 20px;
        }
        .success-badge {
            display: inline-block;
            background-color: #dcfce7;
            color: #15803d;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .info-container {
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 25px;
            margin: 30px 0;
            border: 1px solid #e2e8f0;
        }
        .info-item {
            margin-bottom: 12px;
            display: flex;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 8px;
        }
        .info-label {
            font-weight: 600;
            color: #64748b;
            width: 140px;
        }
        .info-value {
            color: #334155;
            font-weight: 500;
        }
        .login-button {
            display: inline-block;
            background-color: #000000;
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 20px;
            text-align: center;
        }
        .footer {
            padding: 30px;
            background-color: #f8fafc;
            text-align: center;
            font-size: 14px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }
        .signature {
            margin-top: 20px;
            color: #475569;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PadosiAgent</h1>
        </div>
        <div class="content">
            <span class="success-badge">Registration Complete</span>
            <p class="welcome-text">Hi {{ $agent->fullname }},</p>
            <p>Congratulations! Your registration as an insurance professional with <strong>PadosiAgent</strong> is now complete. We have successfully received your payment.</p>
            
            <div class="info-container">
                <!-- <div class="info-item">
                    <span class="info-label">Order ID:</span>
                    <span class="info-value">{{ $agent->razorpay_order_id }}</span>
                </div> -->
                <div class="info-item">
                    <span class="info-label">Status:</span>
                    <span class="info-value">Active</span>
                </div>
                <div class="info-item" style="border: none;">
                    <span class="info-label">Login Email:</span>
                    <span class="info-value">{{ $agent->email }}</span>
                </div>
                <div style="text-align: center;">
                    <a href="{{ url('/agent-login') }}" class="login-button">Log In to Dashboard</a>
                </div>
            </div>
            
            <p>Your password is your registered email: <strong>{{ $agent->email }}</strong>. We highly recommend updating it after your first login.</p>
            <p>If you have any questions or need assistance, our support team is dedicated to help you grow.</p>
            
            <div class="signature">
                <p>Warm regards,<br><strong>Team PadosiAgent</strong></p>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} PadosiAgent. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
