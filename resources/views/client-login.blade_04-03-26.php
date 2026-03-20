@extends('layouts.app')

@push('styles')
{{-- Styles moved to public/css/custome.css to ensure consistency --}}
{{-- Include Client Dashboard Specific Styles --}}
<link href="{{ asset('css/client-dashboard.css') }}" rel="stylesheet">
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
                    <h1>Client Login</h1>
                    <p>Welcome back! Please enter your details.</p>
                </div>

                <form action="{{ route('login') }}" method="POST" id="login-form" class="no-preloader">
                    @csrf
                    <input type="hidden" name="login_type" value="client">

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
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email or username" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-field-wrapper">
                            <input type="password" id="password" name="password" placeholder="••••••••" required>
                            <i class="fas fa-eye password-toggle-icon" id="togglePassword"></i>
                        </div>
                    </div>

                    <a href="{{ route('password.request') }}" class="forgot-password">Forgot password?</a>

                    <button type="submit" class="login-btn" id="submit-btn" style="background-color: #0d9488;">
                        <span id="btn-text">Login as Client</span>
                        <i class="fas fa-arrow-right" id="btn-icon"></i>
                        <i class="fas fa-spinner fa-spin" id="btn-spinner" style="display: none;"></i>
                    </button>
                </form>

                <div class="register-link">
                    New as PadosiAgent Client? <a href="{{ url('/find-agents') }}" class="find-agent-btn">Register here</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Login form logic is now handled globally in app.blade.php --}}
@endpush
