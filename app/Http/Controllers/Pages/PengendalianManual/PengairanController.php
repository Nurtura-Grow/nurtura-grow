<?php

namespace App\Http\Controllers\Pages\PengendalianManual;

use Carbon\Carbon;
use App\Models\DataSensor;
use Illuminate\Http\Request;
use App\Models\InformasiLahan;
use App\Http\Controllers\Controller;
use App\Models\IrrigationController;
use App\Models\LogAksi;
use App\Models\SOPPengairan;
use RealRashid\SweetAlert\Facades\Alert;

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

        // Get the latest irrigation log
        $latestIrrigationLog = LogAksi::whereHas('tipe_instruksi', function ($query) {
            $query->where('nama_tipe', 'pengairan');
        })->latest('created_at')->first();


        // Retrieve irrigation controller information
        $irrigationController = $latestIrrigationLog->irrigation_controller ?? null;

        // Get the next recommended irrigation and the next manual irrigation
        $rekomendasiPenyiraman = $this->getNextIrrigation('auto');
        $penyiramanSelanjutnya = $this->getNextIrrigation('manual');

        // Prepare the response data
        $pengairanData = [
            'terakhir' => $latestIrrigationLog ? $this->formatIrrigationData($irrigationController) : null,
            'rekomendasi' => $rekomendasiPenyiraman ? $this->formatIrrigationData($rekomendasiPenyiraman) : null,
            'selanjutnya' => ($rekomendasiPenyiraman || $penyiramanSelanjutnya) ? $this->formatIrrigationData($penyiramanSelanjutnya) : null,
        ];

        $tanggalSekarang = $this->formatDateUI(now());
        $dataSensor = DataSensor::orderBy('timestamp_pengukuran', 'desc')->first();
        $sopPengairan = SOPPengairan::get();
        $result = [];

        foreach ($sopPengairan as $sop) {
            $result[$sop->nama . '_min'] = $sop->min;
            $result[$sop->nama . '_max'] = $sop->max;
        }

        return view('pages.data-manual.pengairan', [
            'sideMenu' => $sideMenu,
            'seluruhLahan' => $lahan,
            'tanggalSekarang' => $tanggalSekarang,
            'pengairan' => $pengairanData,
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
            ],
            'sopPengairan' => $result,
        ]);
    }

    // Helper function to format irrigation data
    private function formatIrrigationData($irrigationController)
    {
        return [
            'tanggal' => $this->formatDateUI($irrigationController->waktu_mulai),
            'waktu_mulai' => $this->formatTimeUI($irrigationController->waktu_mulai),
            'waktu_selesai' => $this->formatTimeUI($irrigationController->waktu_selesai),
            'volume' => $irrigationController->volume_liter,
            'id_irrigation_controller' => $irrigationController->id_irrigation_controller,
        ];
    }

    // Helper function to get the next irrigation based on mode
    private function getNextIrrigation($mode)
    {
        return IrrigationController::where('mode', $mode)
            ->where('waktu_mulai', '>=', now())
            ->where('willSend', 1)
            ->where('isSent', 0)
            ->orderBy('waktu_mulai')
            ->first();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Get the minutes from request
        $minutes = intval($request->durasi);

        // Convert minutes to seconds
        $seconds = $minutes * 60;

        $irrigationController = IrrigationController::where('mode', 'auto')
            ->where('waktu_mulai', '>=', now())
            ->where('willSend', 1)
            ->where('isSent', 0)
            ->orderBy('waktu_mulai', 'asc') // the nearest next time
            ->first();

        if ($irrigationController) {
            $irrigationController->update([
                'willSend' => 0,
                'updated_by' => auth()->user()->id_user,
                'updated_at' => now(),
            ]);
        }

        $volume = $request->satuan == "L" ? $request->volume_pengairan : $request->volume_pengairan * 1000;

        $waktuMulaiInput = Carbon::parse($request->waktu_mulai);
        $waktuSelesaiInput = Carbon::parse($request->waktu_selesai);
        $currentTime = now()->addMinute()->format('Y-m-d H:i:00');

        $waktuMulai = $waktuMulaiInput < $currentTime ? $currentTime : $waktuMulaiInput;
        $waktuSelesai = $waktuMulaiInput < $currentTime ? $waktuMulaiInput->addSeconds($seconds) : $waktuSelesaiInput;

        IrrigationController::create([
            'mode' => 'manual',
            'id_penanaman' => $request->id_penanaman,
            'id_rekomendasi_air' => null,
            'volume_liter' => $volume,
            'durasi_detik' => $seconds,
            'willSend' => 1,
            'isSent' => 0,
            'waktu_mulai' => $waktuMulai,
            'waktu_selesai' => $waktuSelesai,
            'created_at' => now(),
            'created_by' => auth()->user()->id_user,
        ]);

        return redirect()->route('riwayat.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $sideMenu = $this->getSideMenuList($request);

        $irrigation_controller = IrrigationController::find($id);

        if ($irrigation_controller->isSent == 1 || !$irrigation_controller || $irrigation_controller->mode != 'manual') {
            abort(400);
        }

        $irrigation_controller->nama_penanaman = $irrigation_controller->penanaman->nama_penanaman;
        $irrigation_controller->tanggal_pengairan = $this->formatDateUI($irrigation_controller->waktu_mulai);

        $irrigation_controller->waktu_mulai = $this->formatTimeUI($irrigation_controller->waktu_mulai);
        $irrigation_controller->waktu_selesai = $this->formatTimeUI($irrigation_controller->waktu_selesai);


        return view('pages.data-manual.edit.pengairan', [
            'sideMenu' => $sideMenu,
            'irrigation_controller' => $irrigation_controller,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $irrigation_controller = IrrigationController::find($id);
        if ($irrigation_controller->isSent == 1 || !$irrigation_controller || $irrigation_controller->mode != 'manual') {
            abort(400);
        }

        // Get the minutes from request
        $minutes = intval($request->durasi);

        // Convert minutes to seconds
        $seconds = $minutes * 60;

        $volume = $request->satuan == "L" ? $request->volume_pengairan : $request->volume_pengairan * 1000;

        $waktuMulaiInput = Carbon::parse($request->waktu_mulai);
        $waktuSelesaiInput = Carbon::parse($request->waktu_selesai);
        $currentTime = now()->addMinute()->format('Y-m-d H:i:00');

        $waktuMulai = $waktuMulaiInput < $currentTime ? $currentTime : $waktuMulaiInput;
        $waktuSelesai = $waktuMulaiInput < $currentTime ? $waktuMulaiInput->addSeconds($seconds) : $waktuSelesaiInput;

        $irrigation_controller->update([
            'volume_liter' => $volume,
            'durasi_detik' => $seconds,
            'waktu_mulai' => $waktuMulai,
            'waktu_selesai' => $waktuSelesai,
            'updated_at' => now(),
            'updated_by' => auth()->user()->id_user,
        ]);

        return redirect()->route('riwayat.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $irrigation_controller = IrrigationController::find($id);
        if ($irrigation_controller->isSent == 1 || !$irrigation_controller || $irrigation_controller->mode != 'manual') {
            abort(400);
        }

        $irrigation_controller->update([
            'willSend' => 0,
            'deleted_at' => now(),
            'deleted_by' => auth()->user()->id_user,
        ]);

        return redirect()->route('riwayat.index');
    }

    /**
     * Update SOP Pengairan
     */
    public function updateSOP(Request $request)
    {
        $formData = $request->except(['_method', '_token']);

        foreach ($formData as $nama => $values) {
            SOPPengairan::where('nama', $nama)->update([
                'min' => $values[0],
                'max' => $values[1],
            ]);
        }

        Alert::success('Sukses', 'Data SOP Pengairan telah diubah!');
        return redirect()->route('manual.pengairan.create');
    }
}
