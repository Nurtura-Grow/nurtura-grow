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
        $sideMenu = $this->getSideMenuList($request);
        return view('pages.lahan.create', [
            'sideMenu' => $sideMenu
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // Replace , with . in longitude and latitude
        $data['longitude'] = str_replace(',', '.', $data['longitude']);
        $data['latitude'] = str_replace(',', '.', $data['latitude']);

        InformasiLahan::create([
            ...$data,
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
