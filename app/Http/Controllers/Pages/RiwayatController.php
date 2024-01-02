<?php

namespace App\Http\Controllers\Pages;

use Illuminate\View\View;
use App\Models\DataSensor;
use Illuminate\Http\Request;
use App\Models\TinggiTanaman;
use App\Models\LogAksi;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class RiwayatController extends Controller
{
    public function index(Request $request): View
    {
        $sideMenu = $this->getSideMenuList($request);
        $tinggi_tanaman = TinggiTanaman::activeTinggiDataWithDetails();
        $data_sensor = DataSensor::dataSensorWithDetails();

        $logAksi = LogAksi::logAksiWithDetails();
        foreach($data_sensor as $data){
            $data->nama_lahan = $data->penanaman->informasi_lahan->nama_lahan;
            $data->nama_penanaman = $data->penanaman->nama_penanaman;
            $data->attribute_timestamp = Carbon::parse($data->timestamp_pengukuran)->toIso8601String();
            $data->timestamp_pengukuran = Carbon::parse($data->timestamp_pengukuran)->format('d M Y H:i:s');
        }

        foreach($tinggi_tanaman as $tinggi){
            $tinggi->nama_lahan = $tinggi->penanaman->informasi_lahan->nama_lahan;
            $tinggi->nama_penanaman = $tinggi->penanaman->nama_penanaman;
            $tinggi->rekomendasi_pemupukan = $tinggi->rekomendasi_pemupukan->message->message;
            $tinggi->created_by = $tinggi->userCreatedBy->first()->nama;
            $tinggi->tanggal_tanam = app('App\Http\Controllers\Controller')->formatDateUI($tinggi->penanaman->tanggal_tanam);
            $tinggi->ditambahkan_pada = app('App\Http\Controllers\Controller')->formatDateUI($tinggi->tanggal_pengukuran);
        }

        return view('pages.riwayat.index', [
            'sideMenu' => $sideMenu,
            'tinggiTanaman' => $tinggi_tanaman,
            'data_sensor' => $data_sensor,
            'logAksi' => $logAksi,
        ]);
    }
}
