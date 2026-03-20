<!DOCTYPE html>
<html>
<head>
    <title>Welcome to PadosiAgent</title>
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
        .credentials-container {
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 25px;
            margin: 30px 0;
            border: 1px solid #e2e8f0;
        }
        .credential-item {
            margin-bottom: 12px;
        }
        .credential-label {
            font-weight: 600;
            color: #64748b;
            display: inline-block;
            width: 120px;
        }
        .credential-value {
            color: #0d9488;
            font-weight: 600;
        }
        .login-button {
            display: inline-block;
            background-color: #000000;
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 10px;
            text-align: center;
        }
        .note {
            background-color: #fff7ed;
            padding: 15px;
            border-left: 4px solid #f97316;
            font-size: 14px;
            color: #9a3412;
            border-radius: 4px;
            margin: 25px 0;
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
            <p class="welcome-text">Hello {{ $fullname }},</p>
            <p>Welcome to <strong>PadosiAgent</strong>! We're excited to help you find the best insurance expertise in your locality.</p>
            
            <p><strong>Welcome to PadosiAgent!</strong> You can use the following credentials to access your dashboard:</p>
            
            <div class="credentials-container">
                <div class="credential-item">
                    <span class="credential-label">Email:</span>
                    <span class="credential-value">{{ $email }}</span>
                </div>
                <div class="credential-item">
                    <span class="credential-label">Password:</span>
                    <span class="credential-value">{{ $password }}</span>
                </div>
                <div style="margin-top: 20px;">
                    <a href="{{ url('/client-login') }}" class="login-button">Log In to Dashboard</a>
                </div>
            </div>
            
            <div class="note">
                <strong>Important Note:</strong> To maintain data hygiene, please ensure you log in at least once every 15 days, otherwise your account data may be removed from our platform.
            </div>
            
            <p>If you have any questions, our support team is always here to help.</p>
            
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
