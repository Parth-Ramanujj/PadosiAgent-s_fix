<!DOCTYPE html>
<html>
<head>
    <title>Email Verification - PadosiAgent</title>
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
            text-align: center; /* Fallback */
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
        .verification-badge {
            display: inline-block;
            background-color: #e0f2fe;
            color: #0369a1;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .otp-container {
            background-color: #f8fafc;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-code {
            font-size: 36px;
            font-weight: 800;
            color: #0d9488;
            letter-spacing: 8px;
            margin: 0;
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
    <div class="container" style="max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 16px; overflow: hidden;">
        <!-- Robust Centering for Header -->
        <div class="header" style="background-color: #0d9488; padding: 30px; text-align: center;" align="center">
            <h1 style="color: #ffffff; margin: 0; font-size: 24px; text-align: center; width: 100%; display: block;" align="center">PadosiAgent</h1>
        </div>
        
        <div class="content">
            <span class="verification-badge">Verification Required</span>
            <p class="welcome-text">Hello,</p>
            <p>Thank you for choosing <strong>PadosiAgent</strong>. To complete your verification, please use the 6-digit One-Time Password (OTP) provided below:</p>
            
            <div class="otp-container" style="background-color: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 12px; padding: 30px; text-align: center; margin: 30px 0;" align="center">
                <p class="otp-code" style="font-size: 36px; font-weight: 800; color: #0d9488; letter-spacing: 8px; margin: 0; text-align: center;" align="center">{{ $otp }}</p>
            </div>
            
            <p>This code is valid for <strong>10 minutes</strong>. For security reasons, please do not share this code with anyone.</p>
            <p>If you did not request this verification, please ignore this email.</p>
            
            <div class="signature">
                <p>Warm regards,<br><strong>Team PadosiAgent</strong></p>
            </div>
        </div>
        
        <div class="footer" style="padding: 30px; background-color: #f8fafc; text-align: center; font-size: 14px; color: #64748b; border-top: 1px solid #e2e8f0;" align="center">
            <p>&copy; {{ date('Y') }} PadosiAgent. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
