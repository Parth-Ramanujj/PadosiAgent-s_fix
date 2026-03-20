<!DOCTYPE html>
<html>
<head>
    <title>Reset Password - PadosiAgent</title>
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
        .action-container {
            text-align: center;
            margin: 30px 0;
        }
        .action-button {
            display: inline-block;
            background-color: #000000;
            color: #ffffff;
            padding: 14px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
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
        .expire-text {
            font-size: 14px;
            color: #64748b;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PadosiAgent</h1>
        </div>
        <div class="content">
            <p class="welcome-text">Hello,</p>
            <p>You are receiving this email because we received a password reset request for your account.</p>
            
            <div class="action-container">
                <a href="{{ $url }}" class="action-button">Reset Password</a>
            </div>
            
            <p class="expire-text">This password reset link will expire in 60 minutes.</p>
            <p>If you did not request a password reset, no further action is required.</p>
            
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
