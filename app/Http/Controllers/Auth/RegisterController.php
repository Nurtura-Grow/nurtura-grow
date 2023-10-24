<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function index()
    {
        return view('account.register');
    }

    public function register(Request $request)
    {
        return redirect()->route('dashboard');
    }
}
