<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_token')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $token = Auth::guard('admin')->attempt(
            $request->only('email', 'password')
        );

        if (!$token) {
            return back()
                ->withErrors(['email' => 'Invalid email or password.'])
                ->withInput();
        }

        session(['admin_token' => $token]);
        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        session()->forget('admin_token');
        return redirect()->route('admin.login');
    }
}