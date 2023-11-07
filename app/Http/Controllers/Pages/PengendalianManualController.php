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

        foreach ($lahan as $informasiLahan) {
            $informasiLahan->load('penanaman');
        }

        return view('pages.data-manual.index', [
            'sideMenu' => $sideMenu,
            'seluruhLahan' => $lahan,
        ]);
    }
}
