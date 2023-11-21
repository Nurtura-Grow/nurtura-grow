<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\DataSensor;
use App\Models\InformasiLahan;
use App\Models\Penanaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $sideMenu = $this->getSideMenuList($request);
        $seluruhLahan = InformasiLahan::activeLahanData();

        $penanaman = Penanaman::activePenanamanData();
        $jumlahLahan = 6;

        foreach ($penanaman as $tanaman) {
            $tanaman->nama_lahan = $tanaman->informasi_lahan->nama_lahan;
            $tanaman->tanggal_tanam = $this->formatDateUI($tanaman->tanggal_tanam);

            $tanaman->hst = Penanaman::calculateHST($tanaman->id_penanaman);
            $tanaman->persentase = Penanaman::calculateHSTPercentage($tanaman->id_penanaman);
            $tanaman->default_hari = Penanaman::$jumlahHST;
        }

        $dataSensor = DataSensor::latest()->first();

        $penanaman = collect($penanaman)->sortByDesc('hst')->take($jumlahLahan)->values();

        return view('pages.dashboard', [
            'sideMenu' => $sideMenu,
            'seluruhLahan' => $seluruhLahan,
            'penanaman' => $penanaman,
            'jumlahLahan' => $jumlahLahan,
            'grafik' => [
                'Suhu Udara' => [
                    "name" => 'Suhu Udara',
                    "data" => $dataSensor->suhu,
                    "slug" => "suhu-udara",
                    "color" => "rgb(0, 38, 35)"

                ],
                'Kelembapan Udara' => [
                    "name" => "Kelembapan Udara",
                    "data" => $dataSensor->kelembapan_udara,
                    "slug" => "kelembapan-udara",
                    "color" => "rgb(87, 180, 146)",
                ],
                'Kelembapan Tanah' => [
                    "name" => 'Kelembapan Tanah',
                    "data" => $dataSensor->kelembapan_tanah,
                    "slug" => "kelembapan-tanah",
                    "color" => "rgb(239, 123, 69)",
                ],
                'pH Tanah' => [
                    "name" => 'pH Tanah',
                    "data" => $dataSensor->ph_tanah,
                    "slug" => "ph-tanah",
                    "color" => "rgb(246, 174, 45)",
                ],
            ],
            'timestamp' => Carbon::parse($dataSensor->timestamp_pengukuran)->format('d M Y || H:i:s'),
        ]);
    }

    public function data(Request $request)
    {
        // Receive json data
        if ($request->ajax()) {
            $dateChosen = $request->input('dateChosen');
            $tanggalDari = $request->input('tanggalDari');
            $tanggalHingga = $request->input('tanggalHingga');

            switch ($dateChosen) {
                case 'today':
                    $tanggalDari = Carbon::today()->startOfDay()->toDateTimeString();
                    $tanggalHingga = Carbon::today()->endOfDay()->toDateTimeString();
                    break;
                case 'yesterday':
                    $tanggalDari = Carbon::yesterday()->startOfDay()->toDateTimeString();
                    $tanggalHingga = Carbon::yesterday()->endOfDay()->toDateTimeString();
                    break;
                    // Last 7 Days
                case 'last_week':
                    $tanggalDari = Carbon::today()->subDays(6)->startOfDay()->toDateTimeString();
                    $tanggalHingga = Carbon::today()->endOfDay()->toDateTimeString();
                    break;
                    // Last 30 Dayes
                case 'last_month':
                    $tanggalDari = Carbon::today()->subDays(29)->startOfDay()->toDateTimeString();
                    $tanggalHingga = Carbon::today()->endOfDay()->toDateTimeString();
                    break;
                default:
                    $tanggalDari = Carbon::parse($tanggalDari)->startOfDay()->toDateTimeString();
                    $tanggalHingga = Carbon::parse($tanggalHingga)->endOfDay()->toDateTimeString();
                    break;
            }

            $data = DataSensor::whereBetween('timestamp_pengukuran', [$tanggalDari, $tanggalHingga])->orderBy('timestamp_pengukuran')->get();

            $suhuArray = $data->pluck('suhu')->toArray();
            $kelembapanUdaraArray = $data->pluck('kelembapan_udara')->toArray();
            $kelembapanTanahArray = $data->pluck('kelembapan_tanah')->toArray();
            $phTanahArray = $data->pluck('ph_tanah')->toArray();
            $timestampPengukuranArray = $data->pluck('timestamp_pengukuran')->toArray();

            $formattedTimestamps = array_map(function ($timestamp) {
                return Carbon::parse($timestamp)->format('d M Y H:i:s');
            }, $timestampPengukuranArray);

            return response()->json([
                'data' => [
                    "suhu" => $suhuArray,
                    "kelembapan_udara" => $kelembapanUdaraArray,
                    "kelembapan_tanah" => $kelembapanTanahArray,
                    "ph_tanah" => $phTanahArray,
                    "timestamp_pengukuran" => $formattedTimestamps,
                ],
            ], 200);
        }
    }
}
