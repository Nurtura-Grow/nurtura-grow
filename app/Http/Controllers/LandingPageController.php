<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function index(Request $request) :View
    {
        $sideMenu = $this->getSideMenuList($request);
        return view('guest.landing-page', [
            'sideMenu' => $sideMenu
        ]);
    }
}
