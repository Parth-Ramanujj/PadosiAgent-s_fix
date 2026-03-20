@extends('layouts.app')

@section('content')
<div class="login-page-wrapper">
    @include('layouts.header')
    
    <div class="login-section">
        <div class="login-container">
            <div class="login-header">
                <img src="{{ asset('img/logo-icon.png') }}" alt="PadosiAgent Logo" style="height: 60px; margin-bottom: 24px;">
                <h1>Forgot Password</h1>
                <p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
            </div>

            <div id="alert-container">
                @if (session('status'))
                    <div class="alert alert-success" style="margin-bottom: 20px; color: #059669; background: #ecfdf5; padding: 8px 12px; border-radius: 8px; font-size: 12px; font-weight: 500; border: 1px solid #d1fae5; line-height: 1.4;">
                        <i class="fas fa-check-circle" style="margin-right: 6px;"></i>
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger" style="margin-bottom: 20px; color: #dc2626; background: #fef2f2; padding: 8px 12px; border-radius: 8px; font-size: 12px; font-weight: 500; border: 1px solid #fee2e2; line-height: 1.4;">
                        <i class="fas fa-exclamation-circle" style="margin-right: 6px;"></i>
                        @foreach ($errors->all() as $error)
                            <span>{{ $error }}</span>@if(!$loop->last) <br> @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <form action="{{ route('password.email') }}" method="POST" id="forgot-password-form" class="no-preloader">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
                </div>

                <button type="submit" class="login-btn" id="submit-btn">
                    <span id="btn-text">Email Password Reset Link</span>
                    <i class="fas fa-paper-plane" id="btn-icon"></i>
                    <i class="fas fa-spinner fa-spin" id="btn-spinner" style="display: none;"></i>
                </button>

                <div class="back-link" style="margin-top: 24px; text-align: center;">
                    <a href="{{ route('agent.login') }}" style="color: #64748b; text-decoration: none; font-weight: 500;">
                        <i class="fas fa-chevron-left" style="margin-right: 8px;"></i> Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-hide alerts
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 500);
            }, 5000);
        });
    });

    // Handle loading state via HTMX events
    document.addEventListener('htmx:beforeRequest', function(evt) {
        if (evt.detail.elt.id === 'forgot-password-form') {
            const submitBtn = document.getElementById('submit-btn');
            const btnText = document.getElementById('btn-text');
            const btnIcon = document.getElementById('btn-icon');
            const btnSpinner = document.getElementById('btn-spinner');

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.7';
            submitBtn.style.cursor = 'not-allowed';
            btnText.innerText = 'Sending...';
            btnIcon.style.display = 'none';
            btnSpinner.style.display = 'inline-block';
        }
    });

    document.addEventListener('htmx:afterRequest', function(evt) {
        if (evt.detail.elt.id === 'forgot-password-form') {
            const submitBtn = document.getElementById('submit-btn');
            const btnText = document.getElementById('btn-text');
            const btnIcon = document.getElementById('btn-icon');
            const btnSpinner = document.getElementById('btn-spinner');

            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
            submitBtn.style.cursor = 'pointer';
            btnText.innerText = 'Email Password Reset Link';
            btnIcon.style.display = 'inline-block';
            btnSpinner.style.display = 'none';
        }
    });
</script>
@endpush
