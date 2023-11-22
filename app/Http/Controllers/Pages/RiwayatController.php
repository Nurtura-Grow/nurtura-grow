<?php

namespace App\Http\Controllers\Pages;

use Illuminate\View\View;
use App\Models\DataSensor;
use Illuminate\Http\Request;
use App\Models\TinggiTanaman;
use App\Http\Controllers\Controller;

class RiwayatController extends Controller
{
    public function index(Request $request): View
    {
        $sideMenu = $this->getSideMenuList($request);
        $tinggi_tanaman = TinggiTanaman::activeTinggiDataWithDetails();
        $data_sensor = DataSensor::dataSensorWithDetails();

        return view('pages.riwayat.index', [
            'sideMenu' => $sideMenu,
            'tinggiTanaman' => $tinggi_tanaman,
            'data_sensor' => $data_sensor,
        ]);
    }
}
