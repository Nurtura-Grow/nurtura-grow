<?php

namespace App\Http\Controllers\Pages;

use App\Models\InformasiLahan;
use App\Http\Controllers\Controller;
use App\Http\Requests\InformasiLahanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data_lahan = InformasiLahan::get();

        foreach ($data_lahan as $lahan) {
            $lahan->new_nama = strtolower(str_replace(" ", "-", $lahan->nama_lahan));
        }

        $sideMenu = $this->getSideMenuList($request);
        return view('pages.lahan.index', [
            'sideMenu' => $sideMenu,
            'seluruhLahan' => $data_lahan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data_lahan = InformasiLahan::get();
        $sideMenu = $this->getSideMenuList($request);
        return view('pages.lahan.create', [
            'sideMenu' => $sideMenu,
            'seluruhLahan' => $data_lahan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nama_lahan = $request->input('nama_lahan');
        $deskripsi = $request->input('deskripsi');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // Replace , with . in longitude and latitude
        $longitude = str_replace(',', '.', $longitude);
        $latitude = str_replace(',', '.', $latitude);

        InformasiLahan::create([
            'nama_lahan' => $nama_lahan,
            'deskripsi' => $deskripsi,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'created_by' => Auth::user()->id_user,
        ]);

        return redirect()->route('lahan.index');
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
