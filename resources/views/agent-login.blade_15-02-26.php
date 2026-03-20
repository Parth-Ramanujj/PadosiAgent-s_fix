@extends('layouts.app')

@push('styles')
{{-- Styles moved to public/css/custome.css to ensure consistency --}}
@endpush

@section('content')
<div class="login-page-wrapper">
    @include('layouts.header')
    
    <div class="login-section">
        <div class="login-container">
            <!-- Login Step -->
            <div id="login-step" class="auth-step active">
                <div class="login-header">
                    <img src="{{ asset('img/logo-icon.png') }}" alt="PadosiAgent Logo" style="height: 60px; margin-bottom: 24px;">
                    <h1>Login</h1>
                    <p>Welcome back! Please enter your details.</p>
                </div>

                <form action="{{ Route::has('login') ? route('login') : '#' }}" method="POST" id="login-form" class="no-preloader">
                    @csrf

                    <div id="alert-container">
                        @if (session('status'))
                            <div id="status-alert" class="alert alert-success" style="margin-bottom: 16px; color: #059669; background: #ecfdf5; padding: 8px 12px; border-radius: 8px; font-size: 12px; font-weight: 500; border: 1px solid #d1fae5; line-height: 1.4;">
                                <i class="fas fa-check-circle" style="margin-right: 6px;"></i>
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div id="error-alert" class="alert alert-danger" style="margin-bottom: 16px; color: #dc2626; background: #fef2f2; padding: 8px 12px; border-radius: 8px; font-size: 12px; font-weight: 500; border: 1px solid #fee2e2; line-height: 1.4;">
                                <i class="fas fa-exclamation-circle" style="margin-right: 6px;"></i>
                                @foreach ($errors->all() as $error)
                                    <span>{{ $error }}</span>@if(!$loop->last) <br> @endif
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                    </div>

                    <a href="{{ route('password.request') }}" class="forgot-password">Forgot password?</a>

                    <button type="submit" class="login-btn" id="submit-btn">
                        <span id="btn-text">Login as Agent</span>
                        <i class="fas fa-arrow-right" id="btn-icon"></i>
                        <i class="fas fa-spinner fa-spin" id="btn-spinner" style="display: none;"></i>
                    </button>
                </form>

                <div class="register-link">
                    New as PadosiAgent? <a href="{{ url('/agent-registration') }}">Register here</a>
                </div>
            </div>
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
        if (evt.detail.elt.id === 'login-form') {
            const submitBtn = document.getElementById('submit-btn');
            const btnText = document.getElementById('btn-text');
            const btnIcon = document.getElementById('btn-icon');
            const btnSpinner = document.getElementById('btn-spinner');

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.7';
            submitBtn.style.cursor = 'not-allowed';
            btnText.innerText = 'Logging in...';
            btnIcon.style.display = 'none';
            btnSpinner.style.display = 'inline-block';
        }
    });

    document.addEventListener('htmx:afterRequest', function(evt) {
        if (evt.detail.elt.id === 'login-form' && evt.detail.xhr.status !== 200) {
            // Re-enable button on error (if not redirecting)
            const submitBtn = document.getElementById('submit-btn');
            const btnText = document.getElementById('btn-text');
            const btnIcon = document.getElementById('btn-icon');
            const btnSpinner = document.getElementById('btn-spinner');

            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
            submitBtn.style.cursor = 'pointer';
            btnText.innerText = 'Login as Agent';
            btnIcon.style.display = 'inline-block';
            btnSpinner.style.display = 'none';
        }
    });
</script>
@endpush
