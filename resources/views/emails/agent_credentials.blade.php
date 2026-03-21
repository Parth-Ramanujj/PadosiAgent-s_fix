<!DOCTYPE html>
<html>
<head>
    <title>Welcome to PadosiAgent - Registration Complete</title>
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
            margin-bottom: 18px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e2e8f0;
        }
        .credential-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }
        .credential-label {
            font-weight: 600;
            color: #64748b;
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .credential-value {
            color: #0d9488;
            font-weight: 600;
            font-size: 16px;
            word-break: break-all;
            background-color: #f1f5f9;
            padding: 10px;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
        }
        .login-button {
            display: inline-block;
            background-color: #0d9488;
            color: #ffffff;
            padding: 14px 32px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 15px;
            text-align: center;
            border: none;
            cursor: pointer;
        }
        .login-button:hover {
            background-color: #0b7a6d;
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
        .success-message {
            background-color: #dcfce7;
            padding: 15px;
            border-left: 4px solid #15803d;
            font-size: 14px;
            color: #166534;
            border-radius: 4px;
            margin: 20px 0;
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
            <h1>🎉 PadosiAgent</h1>
        </div>
        <div class="content">
            <p class="welcome-text">Hello {{ $agent->fullname }},</p>
            
            <div class="success-message">
                <strong>✓ Registration Successful!</strong><br>
                Your account has been activated. You can now log in with the credentials below.
            </div>
            
            <p>Welcome to <strong>PadosiAgent</strong>! Your registration is complete and your account is now active. Use the following credentials to access your agent dashboard:</p>
            
            <div class="credentials-container">
                <div class="credential-item">
                    <span class="credential-label">Email Address</span>
                    <span class="credential-value">{{ $agent->email }}</span>
                </div>
                <div class="credential-item">
                    <span class="credential-label">Password</span>
                    <span class="credential-value">{{ $password }}</span>
                </div>
                <div style="margin-top: 20px; text-align: center;">
                    <a href="{{ url('/agent-login') }}" class="login-button">Log In to Your Dashboard</a>
                </div>
            </div>
            
            <div class="note">
                <strong>🔒 Important Security Note:</strong> 
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>Please change your password after your first login for security.</li>
                    <li>Never share your credentials with anyone.</li>
                    <li>If you forgot your password, use the "Forgot Password" option on the login page.</li>
                </ul>
            </div>
            
            <p><strong>What's Next?</strong></p>
            <ul>
                <li>Log in to your dashboard</li>
                <li>Complete your agent profile</li>
                <li>Start connecting with clients looking for insurance expertise in your area</li>
                <li>Earn commissions on every successful referral</li>
            </ul>
            
            <p>If you have any questions or need assistance, our support team is always here to help.</p>
            
            <div class="signature">
                <p>Warm regards,<br><strong>Team PadosiAgent</strong></p>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} PadosiAgent. All rights reserved.</p>
            <p>This is an automated message, please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
