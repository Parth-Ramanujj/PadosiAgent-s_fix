<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin) {
            // Check if password matches (handling both hashed and plain for existing users)
            if (password_verify($request->password, $admin->password) || $request->password === $admin->password) {
                
                // If the stored password was plain text, update it to a bcrypt hash for security
                if ($request->password === $admin->password) {
                    $admin->password = bcrypt($request->password);
                    $admin->save();
                }

                Auth::guard('admin')->login($admin);
                return redirect()->route('admin.dashboard');
            }
        }

        return back()->withInput($request->only('email'))->withErrors([
            'error' => 'Invalid email or password.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
