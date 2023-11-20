<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\InformasiLahan;
use App\Models\Penanaman;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $sideMenu = $this->getSideMenuList($request);
        $seluruhLahan = InformasiLahan::activeLahanData();

        $penanaman = Penanaman::activePenanamanData();

        foreach ($penanaman as $tanaman) {
            $tanaman->nama_lahan = $tanaman->informasi_lahan->nama_lahan;
            $tanaman->tanggal_tanam = $this->formatDateUI($tanaman->tanggal_tanam);

            $tanaman->hst = Penanaman::calculateHST($tanaman->id_penanaman);
            $tanaman->persentase = Penanaman::calculateHSTPercentage($tanaman->id_penanaman);
            $tanaman->default_hari = Penanaman::$jumlahHST;
        }

        $penanaman = collect($penanaman)->sortByDesc('hst')->take(4)->values();

        return view('pages.dashboard', [
            'sideMenu' => $sideMenu,
            'seluruhLahan' => $seluruhLahan,
            'penanaman' => $penanaman,
            'grafik' => [
                'Suhu Udara' => [
                    "name" => 'Suhu Udara',
                    "data" => 20,
                    "slug" => "suhu-udara",
                    "color" => "rgb(0, 38, 35)"

                ],
                'Kelembapan Udara' => [
                    "name" => "Kelembapan Udara",
                    "data" => 30,
                    "slug" => "kelembapan-udara",
                    "color" => "rgb(87, 180, 146)",
                ],
                'Kelembapan Tanah' => [
                    "name" => 'Kelembapan Tanah',
                    "data" => 50,
                    "slug" => "kelembapan-tanah",
                    "color" => "rgb(239, 123, 69)",
                ],
                'pH Tanah' => [
                    "name" => 'pH Tanah',
                    "data" => 80,
                    "slug" => "ph-tanah",
                    "color" => "rgb(246, 174, 45)",
                ],
            ]
        ]);
    }
}
