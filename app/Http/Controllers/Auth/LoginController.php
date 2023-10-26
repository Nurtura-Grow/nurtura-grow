<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index()
    {
        return view('account.login');
    }

    public function login(Request $request)
    {
        // if (!Auth::attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ])) {
        //     throw new \Exception('Wrong email or password.');
        // }

        return redirect()->route('dashboard');
    }
}
