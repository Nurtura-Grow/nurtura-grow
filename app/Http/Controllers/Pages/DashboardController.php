<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\DataSensor;
use App\Models\InformasiLahan;
use App\Models\LogAksi;
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

        $logAksi = LogAksi::logAksiWithDetails();
        $penanaman = collect($penanaman)->sortByDesc('hst')->take($jumlahLahan)->values();

        return view('pages.dashboard', [
            'sideMenu' => $sideMenu,
            'seluruhLahan' => $seluruhLahan,
            'penanaman' => $penanaman,
            'jumlahLahan' => $jumlahLahan,
            'logAksi' => $logAksi,
            'grafik' => [
                'Suhu Udara' => [
                    "name" => 'Suhu Udara',
                    "data" => isset($dataSensor->suhu) ? $dataSensor->suhu : 0,
                    "slug" => "suhu-udara",
                    "persentase" => isset($dataSensor->suhu) ? $dataSensor->suhu : 0,
                    "color" => "rgb(0, 38, 35)"

                ],
                'Kelembapan Udara' => [
                    "name" => "Kelembapan Udara",
                    "data" => isset($dataSensor->kelembapan_udara) ? $dataSensor->kelembapan_udara : 0,
                    "slug" => "kelembapan-udara",
                    "persentase" => isset($dataSensor->kelembapan_udara) ? $dataSensor->kelembapan_udara : 0,
                    "color" => "rgb(87, 180, 146)",
                ],
                'Kelembapan Tanah' => [
                    "name" => 'Kelembapan Tanah',
                    "data" => isset($dataSensor->kelembapan_tanah) ? $dataSensor->kelembapan_tanah : 0,
                    "slug" => "kelembapan-tanah",
                    "persentase" => isset($dataSensor->kelembapan_tanah) ? $dataSensor->kelembapan_tanah : 0,
                    "color" => "rgb(239, 123, 69)",
                ],
                'pH Tanah' => [
                    "name" => 'pH Tanah',
                    "data" => isset($dataSensor->ph_tanah) ? $dataSensor->ph_tanah : 0,
                    "slug" => "ph-tanah",
                    "persentase" => isset($dataSensor->ph_tanah) ? ($dataSensor->ph_tanah / 14 * 100) : 0,
                    "color" => "rgb(246, 174, 45)",
                ],
            ],
            'timestamp' => isset($dataSensor->timestamp_pengukuran)
                ? Carbon::parse($dataSensor->timestamp_pengukuran)->format('d M Y || H:i:s')
                : "Tidak ada data",
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

            // Retrieve sensor data within the specified date range and order by measurement timestamp
            $data = DataSensor::whereBetween('timestamp_pengukuran', [$tanggalDari, $tanggalHingga])
                ->orderBy('timestamp_pengukuran')
                ->get();

            // Retrieve sensor prediction data within the specified date range and order by prediction timestamp
            $prediksi = PrediksiSensor::whereBetween('timestamp_prediksi_sensor', [$tanggalDari, $tanggalHingga])
                ->orderBy('timestamp_prediksi_sensor')
                ->get();

            // Calculate the difference in days between the start and end dates
            $bedaTanggal = Carbon::parse($tanggalDari)->diffInDays($tanggalHingga);

            // Function to format a timestamp item based on a given format
            $groupByFormat = function ($item, $format) {
                return Carbon::parse($item)->format($format);
            };

            // Determine the date format based on the date range selected:
            // Use 'Y-m-d' for last week or last month or if the date difference is more than 1 day;
            // otherwise, use 'Y-m-d H:00:00' to group by hour.
            $format = ($dateChosen == 'last_week' || $dateChosen == 'last_month' || ($dateChosen == 'lainnya' && $bedaTanggal > 1))
                ? 'Y-m-d'
                : 'Y-m-d H:00:00';

            // Group the sensor data by the specified format
            $groupedData = $data->groupBy(fn ($item) => $groupByFormat($item->timestamp_pengukuran, $format));

            // Group the sensor prediction data by the specified format
            $groupedPrediksi = $prediksi->groupBy(fn ($item) => $groupByFormat($item->timestamp_prediksi_sensor, $format));

            // Initialize arrays to store the average values and the formatted timestamps
            $suhuArray = [];
            $kelembapanUdaraArray = [];
            $kelembapanTanahArray = [];
            $phTanahArray = [];
            $timestampPengukuranArray = [];

            // Initialize arrays to store the average prediction values and the formatted timestamps
            $prediksiSuhuArray = [];
            $prediksiKelembapanUdaraArray = [];
            $prediksiKelembapanTanahArray = [];
            $timestampPrediksiArray = [];

            // Rata-rata Pengukuran
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
            $formattedTimestamps = array_map(function ($timestamp) use ($format) {
                return Carbon::parse($timestamp)->format($format);
            }, $timestampPengukuranArray);

            // Change Time Format Prediksi
            $formattedTimestampsPrediksi = array_map(function ($timestamp) use ($format) {
                return Carbon::parse($timestamp)->format($format);
            }, $timestampPrediksiArray);

            // Return the data in JSON format
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
