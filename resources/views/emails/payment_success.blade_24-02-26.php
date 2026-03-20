<x-mail::message>
# Welcome to Padosi Agents!

Hi {{ $agent->fullname }},

Congratulations! Your registration as an insurance agent with **Padosi Agents** is now complete. We have successfully received your payment.

**Registration Details:**
- **Agent Name:** {{ $agent->fullname }}
- **Order ID:** {{ $agent->razorpay_order_id }}
- **Status:** Active

You can now log in to your dashboard using your registered email.

**Login Credentials:**
- **Username:** {{ $agent->email }}
- **Password:** {{ $agent->email }}

<x-mail::button :url="config('app.url') . '/agent-login'">
Log In to Dashboard
</x-mail::button>

If you have any questions or need assistance, please feel free to contact our support team.

Thanks,<br>
**{{ config('app.name') }} Team**
</x-mail::message>
