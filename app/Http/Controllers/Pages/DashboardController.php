<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\InformasiLahan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $sideMenu = $this->getSideMenuList($request);
        $seluruhLahan = InformasiLahan::activeLahanData();

        return view('pages.dashboard', [
            'sideMenu' => $sideMenu,
            'seluruhLahan' => $seluruhLahan,
        ]);
    }
}
