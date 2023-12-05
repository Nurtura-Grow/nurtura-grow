<?php

namespace App\Http\Controllers\Pages\PengendalianManual;

use App\Http\Controllers\Controller;
use App\Models\DataSensor;
use App\Models\InformasiLahan;
use Illuminate\Http\Request;

class PengairanController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $sideMenu = $this->getSideMenuList($request);
        $lahan = InformasiLahan::activeLahanData();

        foreach ($lahan as $informasiLahan) {
            $informasiLahan->load(['penanaman' => function ($query) {
                $query->whereNull('deleted_at')->whereNull('deleted_by');
            }]);
        }

        $tanggalSekarang = $this->formatDateUI(now());
        $dataSensor = DataSensor::orderBy('timestamp_pengukuran', 'desc')->first();

        return view('pages.data-manual.pengairan', [
            'sideMenu' => $sideMenu,
            'seluruhLahan' => $lahan,
            'tanggalSekarang' => $tanggalSekarang,
            'grafik' => [
                'Suhu Udara' => [
                    "name" => 'Suhu Udara',
                    "data" => $dataSensor->suhu,
                    "slug" => "suhu-udara",
                    "persentase" => $dataSensor->suhu,
                    "color" => "rgb(0, 38, 35)"
                ],
                'Kelembapan Udara' => [
                    "name" => "Kelembapan Udara",
                    "data" => $dataSensor->kelembapan_udara,
                    "slug" => "kelembapan-udara",
                    "persentase" => $dataSensor->kelembapan_udara,
                    "color" => "rgb(87, 180, 146)",
                ],
                'Kelembapan Tanah' => [
                    "name" => 'Kelembapan Tanah',
                    "data" => $dataSensor->kelembapan_tanah,
                    "slug" => "kelembapan-tanah",
                    "persentase" => $dataSensor->kelembapan_tanah,
                    "color" => "rgb(239, 123, 69)",
                ],
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
