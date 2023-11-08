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

        $rememberMe = $request->input('remember_me') == 'on' ? true : false;

        if (Auth::attempt($credentials, $rememberMe)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        } else {
            // Alert::error('Error', 'Email atau password salah!');
            return redirect()->back()->withInput()->withErrors('login', 'Username atau password salah!');
        }
    }
}
