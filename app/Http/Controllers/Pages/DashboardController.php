<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\DataSensor;
use App\Models\InformasiLahan;
use App\Models\Penanaman;
use App\Models\PrediksiSensor;
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

        $dataSensor = DataSensor::orderBy('timestamp_pengukuran', 'desc')->first();

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
                'pH Tanah' => [
                    "name" => 'pH Tanah',
                    "data" => $dataSensor->ph_tanah,
                    "slug" => "ph-tanah",
                    "persentase" => $dataSensor->ph_tanah / 14 * 100,
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
            $prediksi = PrediksiSensor::whereBetween('timestamp_prediksi_sensor', [$tanggalDari, $tanggalHingga])->orderBy('timestamp_prediksi_sensor')->get();
            $bedaTanggal = Carbon::parse($tanggalDari)->diffInDays($tanggalHingga);

            if ($dateChosen == 'last_week' || $dateChosen == 'last_month' || ($dateChosen == 'lainnya' && $bedaTanggal > 1)) {
                // Group the data by date
                $groupedData = $data->groupBy(function ($item) {
                    return Carbon::parse($item->timestamp_pengukuran)->format('Y-m-d');
                });

                $groupedPrediksi = $prediksi->groupBy(function ($item) {
                    return Carbon::parse($item->timestamp_prediksi_sensor)->format('Y-m-d');
                });

                $suhuArray = [];
                $kelembapanUdaraArray = [];
                $kelembapanTanahArray = [];
                $phTanahArray = [];
                $timestampPengukuranArray = [];

                $prediksiSuhuArray = [];
                $prediksiKelembapanUdaraArray = [];
                $prediksiKelembapanTanahArray = [];
                $timestampPrediksiArray = [];

                // Rata-rata
                foreach ($groupedData as $date => $group) {
                    $suhuArray[] = $group->avg('suhu');
                    $kelembapanUdaraArray[] = $group->avg('kelembapan_udara');
                    $kelembapanTanahArray[] = $group->avg('kelembapan_tanah');
                    $phTanahArray[] = $group->avg('ph_tanah');
                    $timestampPengukuranArray[] = $date;
                }

                // Rata-rata Prediksi
                foreach ($groupedPrediksi as $date => $group) {
                    $prediksiSuhuArray[] = $group->avg('suhu');
                    $prediksiKelembapanUdaraArray[] = $group->avg('kelembapan_udara');
                    $prediksiKelembapanTanahArray[] = $group->avg('kelembapan_tanah');
                    $timestampPrediksiArray[] = $date;
                }

                // Change Time Format
                $formattedTimestamps = array_map(function ($timestamp) {
                    return Carbon::parse($timestamp)->format('d M Y');
                }, $timestampPengukuranArray);

                // Change Time Format Prediksi
                $formattedTimestampsPrediksi = array_map(function ($timestamp) {
                    return Carbon::parse($timestamp)->format('d M Y');
                }, $timestampPrediksiArray);
            } else {
                // Data Normal
                $suhuArray = $data->pluck('suhu')->toArray();
                $kelembapanUdaraArray = $data->pluck('kelembapan_udara')->toArray();
                $kelembapanTanahArray = $data->pluck('kelembapan_tanah')->toArray();
                $phTanahArray = $data->pluck('ph_tanah')->toArray();
                $timestampPengukuranArray = $data->pluck('timestamp_pengukuran')->toArray();

                // Prediksi
                $prediksiSuhuArray = $prediksi->pluck('suhu')->toArray();
                $prediksiKelembapanUdaraArray = $prediksi->pluck('kelembapan_udara')->toArray();
                $prediksiKelembapanTanahArray = $prediksi->pluck('kelembapan_tanah')->toArray();
                $timestampPrediksiArray = $prediksi->pluck('timestamp_prediksi_sensor')->toArray();

                // Change Time Format
                $formattedTimestamps = array_map(function ($timestamp) {
                    return Carbon::parse($timestamp)->format('d M Y H:i:s');
                }, $timestampPengukuranArray);

                // change Time Format Prediksi
                $formattedTimestampsPrediksi = array_map(function ($timestamp) {
                    return Carbon::parse($timestamp)->format('d M Y H:i:s');
                }, $timestampPrediksiArray);
            }

            return response()->json([
                'data' => [
                    "suhu" => $suhuArray,
                    "kelembapan_udara" => $kelembapanUdaraArray,
                    "kelembapan_tanah" => $kelembapanTanahArray,
                    "ph_tanah" => $phTanahArray,
                    "timestamp_pengukuran" => $formattedTimestamps,
                    "tanggalDari" => Carbon::parse($tanggalDari)->format('d M Y H:i:s'),
                    "tanggalHingga" => Carbon::parse($tanggalHingga)->format('d M Y H:i:s'),
                ],
                'prediksi' => [
                    "suhu" => $prediksiSuhuArray,
                    "kelembapan_udara" => $prediksiKelembapanUdaraArray,
                    "kelembapan_tanah" => $prediksiKelembapanTanahArray,
                    "ph_tanah" => 0,
                    "timestamp_prediksi_sensor" => $formattedTimestampsPrediksi,
                ],
            ], 200);
        }
    }
}
