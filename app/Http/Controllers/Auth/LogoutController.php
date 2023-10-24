<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LogoutController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
