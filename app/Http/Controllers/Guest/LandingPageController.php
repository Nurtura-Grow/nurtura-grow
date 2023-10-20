<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function loginView()
    {
        return view('login/main', [
            'layout' => 'login'
        ]);
    }

    public function login(LoginRequest $request)
    {
        if (! Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            throw new \Exception('Wrong email or password.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
