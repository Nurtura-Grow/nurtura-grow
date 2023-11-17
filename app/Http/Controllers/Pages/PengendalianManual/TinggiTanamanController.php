<?php

namespace App\Http\Controllers\Pages\PengendalianManual;

use App\Http\Controllers\Controller;
use App\Models\Penanaman;
use App\Models\TinggiTanaman;
use App\Models\InformasiLahan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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

        TinggiTanaman::create([
            "id_penanaman" => $id_penanaman,
            "tinggi_tanaman_mm" => $tinggi_tanaman,
            "hari_setelah_tanam" => $hst,
            "tanggal_pengukuran" => $tanggal_pencatatan,
            "created_by" => Auth::user()->id_user,
        ]);

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

        return redirect()->route('riwayat.index');
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
