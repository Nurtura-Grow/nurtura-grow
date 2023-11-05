<?php

namespace App\Http\Controllers\Pages;

use App\Models\InformasiLahan;
use App\Http\Controllers\Controller;
use App\Http\Requests\InformasiLahanRequest;
use Illuminate\Console\View\Components\Info;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data_lahan = InformasiLahan::activeLahanData();

        // Replace space with dash and make it lowercase
        foreach ($data_lahan as $lahan) {
            $lahan->new_nama = strtolower(str_replace(" ", "-", $lahan->nama_lahan));
        }

        $sideMenu = $this->getSideMenuList($request);
        return view('pages.lahan.index', [
            'sideMenu' => $sideMenu,
            'seluruhLahan' => $data_lahan,
            'search' => $request->input('search'),
        ]);
    }

    public function search_lahan(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->input('search');

            // Perform the search in your database
            $data_lahan = InformasiLahan::where('nama_lahan', 'like', '%' . $search . '%')
                ->orWhere('kecamatan', 'like', '%' . $search . '%')
                ->orWhere('kota', 'like', '%' . $search . '%')
                ->orWhere('alamat', 'like', '%' . $search . '%')
                ->where('deleted_by', null)->where('deleted_at', null)
                ->get();

            foreach ($data_lahan as $lahan) {
                $lahan->new_nama = strtolower(str_replace(" ", "-", $lahan->nama_lahan));
            }

            // Return the search results as JSON
            return response()->json([
                'data_lahan' => $data_lahan,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data_lahan = InformasiLahan::activeLahanData();
        $sideMenu = $this->getSideMenuList($request);
        return view('pages.lahan.create', [
            'sideMenu' => $sideMenu,
            'seluruhLahan' => $data_lahan,
        ]);
    }

    private function getKecamatanKota($latitude, $longitude)
    {
        $response = Http::withQueryParameters([
            'latlng' => $latitude . ',' . $longitude,
            'key' => env('VITE_GOOGLE_MAPS_API_KEY'),
        ])->get('https://maps.googleapis.com/maps/api/geocode/json');

        // Kalau gagal mendapatkan data dari google maps api
        if ($response->failed()) {
            return redirect()->back()->withInput()->with('add_lahan', 'Gagal menambahkan lahan. Silahkan coba lagi.');
        }

        $response = $response->json()['results'][0];

        // Kecamatan, Kota, Alamat
        $kecamatan = $response['address_components'][3]['long_name'];
        $kota = $response['address_components'][4]['long_name'];
        $alamat = $response['formatted_address'];

        return [
            'kecamatan' => $kecamatan,
            'kota' => $kota,
            'alamat' => $alamat,
        ];
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

        // Get kecamatan, kota, and alamat from google maps api
        $kecamatan_kota_alamat = $this->getKecamatanKota($latitude, $longitude);
        $kecamatan = $kecamatan_kota_alamat['kecamatan'];
        $kota = $kecamatan_kota_alamat['kota'];
        $alamat = $kecamatan_kota_alamat['alamat'];

        InformasiLahan::create([
            'nama_lahan' => $nama_lahan,
            'deskripsi' => $deskripsi,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'kecamatan' => $kecamatan,
            'kota' => $kota,
            'alamat' => $alamat,
            'created_by' => Auth::user()->id_user,
        ]);

        return redirect()->route('lahan.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $infoLahan = InformasiLahan::find($id);
        if ($infoLahan) {
            return view('pages.lahan.edit', [
                'sideMenu' => $this->getSideMenuList($request),
                'seluruhLahan' => InformasiLahan::activeLahanData(),
                'lahan' => $infoLahan,
            ]);
        }

        return abort(Response::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $nama_lahan = $request->input('nama_lahan');
        $deskripsi = $request->input('deskripsi');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // Replace , with . in longitude and latitude
        $longitude = str_replace(',', '.', $longitude);
        $latitude = str_replace(',', '.', $latitude);

        $kecamatan_kota_alamat = $this->getKecamatanKota($latitude, $longitude);
        $kecamatan = $kecamatan_kota_alamat['kecamatan'];
        $kota = $kecamatan_kota_alamat['kota'];
        $alamat = $kecamatan_kota_alamat['alamat'];

        $infoLahan = InformasiLahan::find($id);

        if($infoLahan){
            $infoLahan->update([
                "nama_lahan" => $nama_lahan,
                "deskripsi" => $deskripsi,
                "latitude" => $latitude,
                "longitude" => $longitude,
                "kecamatan" => $kecamatan,
                "kota" => $kota,
                "alamat" => $alamat,
                "updated_at" => now(),
                "updated_by" => Auth::user()->id_user,
            ]);

            return redirect()->route('lahan.index');
        } else {
            return abort(Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        InformasiLahan::find($id)->update([
            "deleted_at" => now(),
            "deleted_by" => Auth::user()->id_user,
        ]);

        return redirect()->route('lahan.index');
    }
}
