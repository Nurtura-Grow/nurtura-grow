<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $sideMenu = $this->getSideMenuList($request);

        return view('pages.dashboard', [
            'sideMenu' => $sideMenu
        ]);
    }
}
