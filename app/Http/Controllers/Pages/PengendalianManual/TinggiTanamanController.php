<?php

namespace App\Http\Controllers\Pages\PengendalianManual;

use App\Models\InformasiLahan;
use App\Http\Controllers\Controller;
use App\Models\TinggiTanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TinggiTanamanController extends Controller
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

        return view('pages.data-manual.tinggi-tanaman', [
            'sideMenu' => $sideMenu,
            'seluruhLahan' => $lahan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_penanaman = $request->input('id_penanaman');
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
                return response()->json([
                    "status" => "400",
                    "message" => "Satuan tidak dikenali",
                ], 400);
        }

        $hst = TinggiTanaman::getHST($id_penanaman, $tanggal_pencatatan);
        if ($hst === null) {
            return response()->json([
                "status" => "400",
                "message" => "Penanaman tidak ditemukan",
            ], 400);
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
