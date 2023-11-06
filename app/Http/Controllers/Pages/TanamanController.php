<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\InformasiLahan;
use App\Models\Penanaman;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TanamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sideMenu = $this->getSideMenuList($request);
        $penanaman = Penanaman::with('informasi_lahan')
            ->where('deleted_by', null)
            ->where('deleted_at', null)
            ->get();

        foreach ($penanaman as $tanaman) {
            $tanaman->nama_lahan = $tanaman->informasi_lahan->nama_lahan;
            $tanaman->tanggal_tanam = $this->formatDateUI($tanaman->tanggal_tanam);

            if ($tanaman->status_hidup == false) {
                $tanaman->tanggal_panen = $this->formatDateUI($tanaman->tanggal_panen);
            }

            $tanaman->hst = Penanaman::calculateHST($tanaman->id_penanaman);
            $tanaman->persentase = Penanaman::calculateHSTPercentage($tanaman->id_penanaman);
            $tanaman->default_hari = Penanaman::$jumlahHST;
        }

        $penanaman = $penanaman->sortBy('nama_lahan');

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
        $lahan = InformasiLahan::activeLahanData();

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
        $aktif = $request['aktif']  == "on" ? true : false;

        if ($aktif == false) {
            $tanggal_panen = $this->formatDateDatabase($request['tanggal_selesai']);
        }

        Penanaman::create([
            "id_lahan" => $id_lahan,
            "nama_penanaman" => $nama_penanaman,
            "keterangan" => $keterangan,
            "status_hidup" => $aktif,
            "tanggal_tanam" => $tanggal_tanam,
            "tanggal_panen" => $tanggal_panen ?? null,
            "created_by" => Auth::user()->id_user,
            "created_at" => now(),
        ]);

        return redirect()->route('tanaman.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $sideMenu = $this->getSideMenuList($request);
        $lahan = InformasiLahan::activeLahanData();
        $penanaman = Penanaman::where('id_penanaman', $id)->where('deleted_by', null)->where('deleted_at', null)->first();

        // Change format tanggal tanam
        $penanaman->tanggal_tanam = $this->formatDateUI($penanaman->tanggal_tanam);
        $penanaman->tanggal_panen = $this->formatDateUI($penanaman->tanggal_panen);

        if (!$penanaman) {
            return abort(Response::HTTP_NOT_FOUND);
        }

        return view('pages.tanaman.edit', [
            'sideMenu' => $sideMenu,
            'seluruhLahan' => $lahan,
            'penanaman' => $penanaman,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $nama_penanaman = $request['nama_penanaman'];
        $keterangan = $request['keterangan'];
        $id_lahan = $request['id_lahan'];
        $tanggal_tanam = $this->formatDateDatabase($request['tanggal_tanaman']);
        $aktif = $request['aktif'] == "on" ? true : false;

        $penanaman = Penanaman::where('id_penanaman', $id)->where('deleted_by', null)->where('deleted_at', null)->first();
        if (!$penanaman) {
            return abort(Response::HTTP_NOT_FOUND);
        }

        if ($aktif == false) {
            $tanggal_panen = $this->formatDateDatabase($request['tanggal_selesai']);
        }

        $penanaman->update([
            "id_lahan" => $id_lahan,
            "nama_penanaman" => $nama_penanaman,
            "keterangan" => $keterangan,
            "status_hidup" => $aktif,
            "tanggal_tanam" => $tanggal_tanam,
            "tanggal_panen" => $tanggal_panen ?? null,
            "updated_by" => Auth::user()->id_user,
            "updated_at" => now(),
        ]);

        return redirect()->route('tanaman.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penanaman = Penanaman::where('id_penanaman', $id)->where('deleted_by', null)->where('deleted_at', null)->first();
        if (!$penanaman) {
            return abort(Response::HTTP_NOT_FOUND);
        }

        $penanaman->update([
            "deleted_by" => Auth::user()->id_user,
            "deleted_at" => now(),
        ]);

        return redirect()->route('tanaman.index');
    }
}
