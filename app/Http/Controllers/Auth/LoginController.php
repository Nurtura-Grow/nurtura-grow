<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('account.login');
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        if (Auth::attempt($credentials)) {
            // Alert::error('Error', 'Email atau password salah!');
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return redirect()->back()->withInput()->withErrors('login', 'Username atau password salah!');
    }
}
