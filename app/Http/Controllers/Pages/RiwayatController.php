<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Penanaman;
use App\Models\TinggiTanaman;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RiwayatController extends Controller
{
    public function index(Request $request): View
    {
        $sideMenu = $this->getSideMenuList($request);
        $tinggi_tanaman = TinggiTanaman::activeTinggiDataWithDetails();

        return view('pages.riwayat.index', [
            'sideMenu' => $sideMenu,
            'tinggiTanaman' => $tinggi_tanaman,
        ]);
    }
}
