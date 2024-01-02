<?php

namespace App\Http\Controllers\Pages\PengendalianManual;

use Carbon\Carbon;
use App\Models\LogAksi;
use Illuminate\Http\Request;
use App\Models\InformasiLahan;
use App\Http\Controllers\Controller;
use App\Models\FertilizerController;

class PemupukanController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $sideMenu = $this->getSideMenuList($request);
        $lahan = InformasiLahan::activeLahanData();

        $tanggalSekarang = $this->formatDateUI(now());

        foreach ($lahan as $informasiLahan) {
            $informasiLahan->load(['penanaman' => function ($query) {
                $query->whereNull('deleted_at')->whereNull('deleted_by');
            }]);
        }

        // Get the latest fertilizer log
        $latestFertilizerController = LogAksi::whereHas('tipe_instruksi', function ($query) {
            $query->where('nama_tipe', 'pemupukan');
        })->latest('created_at')->first();

        // Retrieve fertilizer controller information
        $fertilizerController = $latestFertilizerController->fertilizer_controller ?? null;

        // Get the next recommended fertilizer and the next manual fertilizer
        $rekomendasiPemupukan = $this->getNextfertilizer('auto');
        $pemupukanSelanjutnya = $this->getNextfertilizer('manual');

        // Prepare the response data
        $pemupukanData = [
            'terakhir' => $fertilizerController ? $this->formatfertilizerData($fertilizerController) : null,
            'rekomendasi' => $rekomendasiPemupukan ? $this->formatfertilizerData($rekomendasiPemupukan) : null,
            'selanjutnya' => ($rekomendasiPemupukan || $pemupukanSelanjutnya) ? $this->formatfertilizerData($pemupukanSelanjutnya) : null,
        ];

        return view('pages.data-manual.pemupukan', [
            'sideMenu' => $sideMenu,
            'seluruhLahan' => $lahan,
            'tanggalSekarang' => $tanggalSekarang,
            'pemupukan' => $pemupukanData,
        ]);
    }

    // Helper function to format fertilizer data
    private function formatfertilizerData($fertilizerController)
    {
        return [
            'tanggal' => $this->formatDateUI($fertilizerController->waktu_mulai),
            'waktu_mulai' => $this->formatTimeUI($fertilizerController->waktu_mulai),
            'waktu_selesai' => $this->formatTimeUI($fertilizerController->waktu_selesai),
            'volume' => $fertilizerController->volume_liter,
            'id_fertilizer_controller' => $fertilizerController->id_fertilizer_controller,
        ];
    }

    // Helper function to get the next fertilizer based on mode
    private function getNextfertilizer($mode)
    {
        return FertilizerController::where('mode', $mode)
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
        $fertilizerController = FertilizerController::where('mode', 'auto')
            ->where('waktu_mulai', '>=', now())
            ->where('willSend', 1)
            ->where('isSent', 0)
            ->orderBy('waktu_mulai', 'asc') // the nearest next time
            ->first();

        if ($fertilizerController) {
            $fertilizerController->update([
                'willSend' => 0,
                'updated_by' => auth()->user()->id_user,
                'updated_at' => now(),
            ]);
        }

        $volume = $request->satuan == "L" ? $request->volume_pemupukan : $request->volume_pemupukan * 1000;

        $waktuMulaiInput = Carbon::parse($request->waktu_mulai);
        $waktuSelesaiInput = Carbon::parse($request->waktu_selesai);
        $currentTime = now()->addMinute()->format('Y-m-d H:i:00');

        $waktuMulai = $waktuMulaiInput < $currentTime ? $currentTime : $waktuMulaiInput;
        $waktuSelesai = $waktuMulaiInput < $currentTime ? $waktuMulaiInput->addSeconds($seconds) : $waktuSelesaiInput;

        FertilizerController::create([
            'mode' => 'manual',
            'id_penanaman' => $request->id_penanaman,
            'id_rekomendasi_pupuk' => null,
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

        $fertilizer_controller = FertilizerController::find($id);

        if ($fertilizer_controller->isSent == 1 || !$fertilizer_controller || $fertilizer_controller->mode != 'manual') {
            abort(400);
        }

        $fertilizer_controller->nama_penanaman = $fertilizer_controller->penanaman->nama_penanaman;
        $fertilizer_controller->tanggal_pemupukan  = $this->formatDateUI($fertilizer_controller->waktu_mulai);

        $fertilizer_controller->waktu_mulai = $this->formatTimeUI($fertilizer_controller->waktu_mulai);
        $fertilizer_controller->waktu_selesai = $this->formatTimeUI($fertilizer_controller->waktu_selesai);


        return view('pages.data-manual.edit.pemupukan', [
            'sideMenu' => $sideMenu,
            'fertilizer_controller' => $fertilizer_controller,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fertilizer_controller = FertilizerController::find($id);
        if ($fertilizer_controller->isSent == 1 || !$fertilizer_controller || $fertilizer_controller->mode != 'manual') {
            abort(400);
        }

        // Get the minutes from request
        $minutes = intval($request->durasi);

        // Convert minutes to seconds
        $seconds = $minutes * 60;

        $volume = $request->satuan == "L" ? $request->volume_pemupukan : $request->volume_pemupukan * 1000;

        $waktuMulaiInput = Carbon::parse($request->waktu_mulai);
        $waktuSelesaiInput = Carbon::parse($request->waktu_selesai);
        $currentTime = now()->addMinute()->format('Y-m-d H:i:00');

        $waktuMulai = $waktuMulaiInput < $currentTime ? $currentTime : $waktuMulaiInput;
        $waktuSelesai = $waktuMulaiInput < $currentTime ? $waktuMulaiInput->addSeconds($seconds) : $waktuSelesaiInput;

        $fertilizer_controller->update([
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
        $fertilizer_controller = FertilizerController::find($id);
        if ($fertilizer_controller->isSent == 1 || !$fertilizer_controller || $fertilizer_controller->mode != 'manual') {
            abort(400);
        }

        $fertilizer_controller->update([
            'willSend' => 0,
            'deleted_at' => now(),
            'deleted_by' => auth()->user()->id_user,
        ]);

        return redirect()->route('riwayat.index');
    }
}
