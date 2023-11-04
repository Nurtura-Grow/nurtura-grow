<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\InformasiLahan;
use App\Models\Penanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TanamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sideMenu = $this->getSideMenuList($request);
        // $penanaman = Penanaman::where('deleted_by', null)->where('deleted_at', null)->get();
        $penanaman = Penanaman::with('informasi_lahan')
            ->where('deleted_by', null)
            ->where('deleted_at', null)
            ->get();

        foreach ($penanaman as $tanaman) {
            $tanaman->nama_lahan = $tanaman->informasi_lahan->nama_lahan;
            $tanaman->tanggal_tanam = $this->formatDateUI($tanaman->tanggal_tanam);
            $tanaman->hst = Penanaman::calculateHST($tanaman->id_penanaman);
            $tanaman->persentase = Penanaman::calculateHSTPercentage($tanaman->id_penanaman);
        }

        return view('pages.tanaman.index', [
            'sideMenu' => $sideMenu,
            'seluruhPenanaman' => $penanaman,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $sideMenu = $this->getSideMenuList($request);
        $lahan = InformasiLahan::where('deleted_by', null)->where('deleted_at', null)->get();

        return view('pages.tanaman.create', [
            'sideMenu' => $sideMenu,
            'seluruhLahan' => $lahan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nama_penanaman = $request['nama_penanaman'];
        $keterangan = $request['keterangan'];
        $id_lahan = $request['id_lahan'];
        $tanggal_tanam = $this->formatDateDatabase($request['tanggal_tanaman']);
        $aktif = $request['aktif'];

        Penanaman::create([
            "id_lahan" => $id_lahan,
            "nama_penanaman" => $nama_penanaman,
            "keterangan" => $keterangan,
            "status_hidup" => $aktif == "on" ? true : false,
            "tanggal_tanam" => $tanggal_tanam,
            "created_by" => Auth::user()->id_user,
            "created_at" => now(),
        ]);

        return redirect()->route('tanaman.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
