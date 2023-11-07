<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\InformasiLahan;
use App\Models\Penanaman;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengendalianManualController extends Controller
{
    public function index(Request $request): View
    {
        $sideMenu = $this->getSideMenuList($request);
        $lahan = InformasiLahan::activeLahanData();
        $penanaman = Penanaman::activePenanamanData();

        return view('pages.data-manual.index', [
            'sideMenu' => $sideMenu,
            'seluruhLahan' => $lahan,
            'seluruhPenanaman' => $penanaman
        ]);
    }
}
