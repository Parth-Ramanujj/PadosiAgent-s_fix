@extends('layouts.app')

@section('content')
<div class="login-page-wrapper">
    @include('layouts.header')
    
    <div class="login-section">
        <div class="login-container">
            <div class="login-header">
                <img src="{{ asset('img/logo-icon.png') }}" alt="PadosiAgent Logo" style="height: 60px; margin-bottom: 24px;">
                <h1>Reset Password</h1>
                <p>Please enter your new password below.</p>
            </div>

            <div id="alert-container">
                @if ($errors->any())
                    <div class="alert alert-danger" style="margin-bottom: 20px; color: #dc2626; background: #fef2f2; padding: 8px 12px; border-radius: 8px; font-size: 12px; font-weight: 500; border: 1px solid #fee2e2; line-height: 1.4;">
                        <i class="fas fa-exclamation-circle" style="margin-right: 6px;"></i>
                        @foreach ($errors->all() as $error)
                            <span>{{ $error }}</span>@if(!$loop->last) <br> @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <form action="{{ route('password.update') }}" method="POST" id="reset-password-form" class="no-preloader">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}" required readonly class="bg-light">
                </div>

                <div class="form-group">
                    <label for="password">New Password</label>
                    <div class="password-field-wrapper">
                        <input type="password" id="password" name="password" placeholder="••••••••" required autofocus>
                        <i class="fas fa-eye password-toggle-icon"></i>
                    </div>
                    <small class="text-muted">Minimum 8 characters</small>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="password-field-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                        <i class="fas fa-eye password-toggle-icon"></i>
                    </div>
                    <div id="password-match-error" style="color: #dc2626; font-size: 13px; margin-top: 5px; display: none;">
                        Passwords do not match.
                    </div>
                </div>

                <button type="submit" class="login-btn" id="submit-btn">
                    <span id="btn-text">Reset Password</span>
                    <i class="fas fa-lock" id="btn-icon"></i>
                    <i class="fas fa-spinner fa-spin" id="btn-spinner" style="display: none;"></i>
                </button>
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

    // Handle loading state & Validation via HTMX events
    document.addEventListener('htmx:beforeRequest', function(evt) {
        if (evt.detail.elt.id === 'reset-password-form') {
            const password = document.getElementById('password').value;
            const confirm = document.getElementById('password_confirmation').value;
            const errorDiv = document.getElementById('password-match-error');
            
            if (password !== confirm) {
                evt.preventDefault(); // Stop HTMX request
                errorDiv.style.display = 'block';
                document.getElementById('password_confirmation').style.borderColor = '#dc2626';
                return false;
            }

            const submitBtn = document.getElementById('submit-btn');
            const btnText = document.getElementById('btn-text');
            const btnIcon = document.getElementById('btn-icon');
            const btnSpinner = document.getElementById('btn-spinner');

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.7';
            submitBtn.style.cursor = 'not-allowed';
            btnText.innerText = 'Resetting...';
            btnIcon.style.display = 'none';
            btnSpinner.style.display = 'inline-block';
        }
    });

    document.addEventListener('htmx:afterRequest', function(evt) {
        if (evt.detail.elt.id === 'reset-password-form' && evt.detail.xhr.status !== 200) {
            const submitBtn = document.getElementById('submit-btn');
            const btnText = document.getElementById('btn-text');
            const btnIcon = document.getElementById('btn-icon');
            const btnSpinner = document.getElementById('btn-spinner');

            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
            submitBtn.style.cursor = 'pointer';
            btnText.innerText = 'Reset Password';
            btnIcon.style.display = 'inline-block';
            btnSpinner.style.display = 'none';
        }
    });

    // Real-time check
    document.getElementById('password_confirmation').addEventListener('input', function() {
        const password = document.getElementById('password').value;
        const confirm = this.value;
        const errorDiv = document.getElementById('password-match-error');
        
        if (confirm && password !== confirm) {
            errorDiv.style.display = 'block';
            this.style.borderColor = '#dc2626';
        } else {
            errorDiv.style.display = 'none';
            this.style.borderColor = '#e5e7eb';
        }
    });
</script>
@endpush
