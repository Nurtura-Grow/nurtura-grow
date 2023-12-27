<?php

namespace App\Http\Controllers\Pages\PengendalianManual;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Message;
use App\Models\Penanaman;
use App\Models\TinggiTanaman;
use App\Models\InformasiLahan;
use App\Models\FertilizerController;
use App\Models\RekomendasiPemupukan;

class TinggiTanamanController extends Controller
{
    public function search_tanggal(Request $request, $id)
    {
        if ($request->ajax()) {
            $tanggal_tanam = Penanaman::find($id)->tanggal_tanam;

            return response()->json([
                'tanggal_tanam' => $tanggal_tanam,
            ], 200);
        } else {
            return abort(Response::HTTP_NOT_FOUND);
        }
    }

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

        return view('pages.data-manual.tinggi-tanaman', [
            'sideMenu' => $sideMenu,
            'seluruhLahan' => $lahan,
            'tanggalSekarang' => $tanggalSekarang,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_penanaman = $request->input('id_penanaman');
        // Fetch the 'penanaman' record
        $penanaman = Penanaman::find($id_penanaman);

        // Check if 'status_hidup' is equal to 0
        if ($penanaman && $penanaman->status_hidup == 0) {
            return abort(Response::HTTP_NOT_FOUND);
        }

        $tanggal_pencatatan = $this->formatDateDatabase($request->input('tanggal_pencatatan'));
        $tinggi_tanaman = $request->input('tinggi_tanaman');
        $satuan = $request->input('satuan');

        // Convert to mm
        switch ($satuan) {
            case "cm":
                $tinggi_tanaman *= 10;
                break;

            case "mm":
                break;

            default:
                return abort(Response::HTTP_NOT_FOUND);
        }

        $hst = TinggiTanaman::getHST($id_penanaman, $tanggal_pencatatan);
        if ($hst < 0) {
            return redirect()->back()->withInput()->withErrors('tanggal_catat', 'Tanggal pencatatan tidak valid');
        }

        $idTinggiTanaman = TinggiTanaman::create([
            "id_penanaman" => $id_penanaman,
            "tinggi_tanaman_mm" => $tinggi_tanaman,
            "hari_setelah_tanam" => $hst,
            "tanggal_pengukuran" => $tanggal_pencatatan,
            "created_by" => Auth::user()->id_user,
        ])->id_tinggi_tanaman;

        // Request ke ML untuk rekomendasi pemupukan
        $this->requestRekomendasiPemupukan($idTinggiTanaman, $tinggi_tanaman, $hst);

        return redirect()->route('riwayat.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $sideMenu = $this->getSideMenuList($request);

        $tinggi_tanaman = TinggiTanaman::find($id);

        if (!$tinggi_tanaman) {
            return abort(Response::HTTP_NOT_FOUND);
        }

        $penanaman = $tinggi_tanaman->penanaman()->first();
        $tinggi_tanaman->id_penanaman = $penanaman->id_penanaman;
        $tinggi_tanaman->nama_penanaman = $penanaman->nama_penanaman;
        $tinggi_tanaman->tanggal_pengukuran = $this->formatDateUI($tinggi_tanaman->tanggal_pengukuran);

        $lahan = InformasiLahan::activeLahanData();
        foreach ($lahan as $informasiLahan) {
            $informasiLahan->load(['penanaman' => function ($query) {
                $query->whereNull('deleted_at')->whereNull('deleted_by');
            }]);
        }

        return view('pages.data-manual.edit.tinggi-tanaman', [
            'sideMenu' => $sideMenu,
            'tanaman' => $tinggi_tanaman,
            'seluruhLahan' => $lahan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tinggiTanaman = TinggiTanaman::find($id);
        if (!$tinggiTanaman) {
            return abort(Response::HTTP_NOT_FOUND);
        }

        $id_penanaman = $request->input('id_penanaman');
        // Fetch the 'penanaman' record
        $penanaman = Penanaman::find($id_penanaman);

        // Check if 'status_hidup' is equal to 0
        if ($penanaman && $penanaman->status_hidup == 0) {
            return abort(Response::HTTP_NOT_FOUND);
        }

        $tanggal_pencatatan = $this->formatDateDatabase($request->input('tanggal_pencatatan'));

        $hst = TinggiTanaman::getHST($id_penanaman, $tanggal_pencatatan);
        if ($hst < 0) {
            return redirect()->back()->withInput()->withErrors('tanggal_catat', 'Tanggal pencatatan tidak valid');
        }

        $tinggi_tanaman = $request->input('tinggi_tanaman');
        $satuan = $request->input('satuan');
        // Convert to mm
        switch ($satuan) {
            case "cm":
                $tinggi_tanaman *= 10;
                break;

            case "mm":
                break;

            default:
                return abort(Response::HTTP_NOT_FOUND);
        }

        $tinggiTanaman->update([
            "id_penanaman" => $id_penanaman,
            "tinggi_tanaman_mm" => $tinggi_tanaman,
            "hari_setelah_tanam" => $hst,
            "tanggal_pengukuran" => $tanggal_pencatatan,
            "updated_by" => Auth::user()->id_user,
            "updated_at" => now(),
        ]);

        // Request ke ML untuk rekomendasi pemupukan
        $this->requestRekomendasiPemupukan($id, $tinggi_tanaman, $hst);

        return redirect()->route('riwayat.index');
    }

    private function requestRekomendasiPemupukan($idTinggiTanaman, $tinggiTanaman, $hst)
    {
        $debit = 7; // Liter per menit
        $link = config('services.link_integrasi') . '/ml/fertilizer';
        $response = Http::post($link, [
            'tinggi_tanaman' => $tinggiTanaman,
            'hst' => $hst,
        ]);

        if ($response->successful()) {
            $response = $response->json();
            $response = $response['data'];

            $durasi = $response['waktu'];
            $volume_liter = $durasi / 60 * $debit;

            $isiPesan = $response['message'] == "" ? "Tidak ada pesan" : $response['message'];
            $pesan = Message::firstOrCreate([
                'message' => $isiPesan,
            ])->id;

            $idRekomendasiPupuk = RekomendasiPemupukan::updateOrCreate([
                'id_tinggi_tanaman' => $idTinggiTanaman,
                'nyalakan_alat' => $response['nyala'] == 1 ? true : false,
                'is_tinggi_optimal' => $response['tinggi_optimal'] == 1 ? true : false,
                'durasi_detik' => $durasi,
                'jumlah_rekomendasi_ml' => $volume_liter * 1000, // dijadikan mL
                'pesan' => $pesan,
                'tanggal_rekomendasi' => now(),
            ])->id_rekomendasi_pupuk;

            Alert::info('Rekomendasi Pemupukan', 'Rekomendasi pemupukan berhasil dibuat, rekomendasi machine learning: ' . $isiPesan);

            if ($response['nyala'] == 1) {
                $id_penanaman = TinggiTanaman::find($idTinggiTanaman)->penanaman->first()->id_penanaman;

                // Buat Fertilizer Controller
                FertilizerController::create([
                    'mode' => 'auto',
                    'id_penanaman' => $id_penanaman,
                    'id_rekomendasi_pupuk' => $idRekomendasiPupuk,
                    'volume_liter' => $volume_liter,
                    'durasi_detik' => $durasi,
                    'willSend' => 1,
                    'isSent' => 0,
                    'waktu_mulai' => now()->addMinute()->format('Y-m-d H:i:00'),
                    'waktu_selesai' => now()->addSeconds($durasi)->format('Y-m-d H:i:00'),
                    'created_at' => now(),
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tinggiTanaman = TinggiTanaman::find($id);
        if (!$tinggiTanaman) {
            return abort(Response::HTTP_NOT_FOUND);
        }

        $tinggiTanaman->update([
            "deleted_by" => Auth::user()->id_user,
            "deleted_at" => now(),
        ]);

        return redirect()->route('riwayat.index');
    }
}
