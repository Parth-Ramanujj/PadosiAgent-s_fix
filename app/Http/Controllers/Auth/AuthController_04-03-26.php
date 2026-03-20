<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Handle Login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        try {
            if (Auth::attempt($credentials, $request->remember)) {
                $request->session()->regenerate();

                $user = Auth::user();
                
                // Extra safety: Check if they are using the correct login page
                $loginType = $request->input('login_type');
                if ($loginType && $user->role !== 'admin') {
                    if ($loginType === 'client' && $user->role === 'agent') {
                        Auth::logout();
                        return back()->withErrors(['email' => 'This is an Agent account. Please use the Agent Login page.']);
                    }
                    if ($loginType === 'agent' && $user->role === 'client') {
                        Auth::logout();
                        return back()->withErrors(['email' => 'This is a Client account. Please use the Client Login page.']);
                    }
                }

                \Illuminate\Support\Facades\Log::info('User logged in', ['id' => $user->id, 'role' => $user->role]);
                
                // Update last login
                $user->update(['last_login_at' => now()]);

                // Role-based redirection
                $url = match ($user->role) {
                    'admin' => '/admin/dashboard',
                    'agent' => '/agent/dashboard',
                    'client' => '/find-agents',
                    default => '/',
                };

                \Illuminate\Support\Facades\Log::info('Redirecting user', ['url' => $url]);
                return redirect($url)->with('login_success', true);
            }

            \Illuminate\Support\Facades\Log::warning('Login failed for email', ['email' => $request->email]);
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Login exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Handle Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Show Forgot Password Form
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send Reset Link
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Just a simple implementation for now, can be expanded to use Laravel's default Notification-based reset
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Show Reset Form
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Handle Reset
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('agent.login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
