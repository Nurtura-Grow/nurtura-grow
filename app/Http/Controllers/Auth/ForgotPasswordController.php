<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    public function index(): View
    {
        return view('account.forgot-password');
    }

    public function password(Request $request)
    {
        return redirect()->route('verifikasi');
    }

    public function index_verifikasi(Request $request): View
    {
        return view('account.verifikasi-otp');
    }

    public function verifikasi(Request $request)
    {
        return redirect()->route('login');
    }
}
