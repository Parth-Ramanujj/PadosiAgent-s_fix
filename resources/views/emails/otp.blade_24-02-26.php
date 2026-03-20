<x-mail::message>
# Email Verification

Hello,

Thank you for registering with **Padosi Agents**. To complete your verification, please use the 6-digit One-Time Password (OTP) provided below:

<x-mail::panel>
# {{ $otp }}
</x-mail::panel>

This OTP is valid for the next 10 minutes. Please do not share this code with anyone.

If you did not request this code, please ignore this email.

Thanks,<br>
**{{ config('app.name') }} Team**
</x-mail::message>
