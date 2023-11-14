<?php

namespace App\Http\Controllers\Pages\PengendalianManual;

use App\Models\InformasiLahan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $tanggal_pencatatan =$this->formatDateDatabase($request->input('tanggal_pencatatan'));
        $tinggi_tanaman = $request->input('tinggi_tanaman');
        $satuan = $request->input('satuan');

        if($satuan) 
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
