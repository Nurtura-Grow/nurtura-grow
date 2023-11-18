<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InformasiLahan;
use App\Models\Penanaman;
use App\Models\User;

class LahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id_user = User::first()->id_user;
        InformasiLahan::firstOrCreate([
            'nama_lahan' => 'Lahan 1',
            'deskripsi' => 'Ini lahan pertama',
            'latitude' => -7.710903,
            'longitude' => 111.678924,
            'kecamatan' => 'Madiun Regency',
            'kota' => 'East Java',
            'alamat' => '7MQH+JH Kare, Madiun Regency, East Java, Indonesia',
            'created_by' => $id_user
        ]);

        Penanaman::firstOrCreate([
            'id_lahan' => InformasiLahan::first()->id_lahan,
            'nama_penanaman' => 'Penanaman Bawang Merah 1',
            'keterangan' => 'Ini tanaman Bawang Merah',
            'tanggal_tanam' => now(),
            'tanggal_panen' => null,
            'status_hidup' => true,
            'created_by' => $id_user,
            'alat_terpasang' => true,
        ]);
    }
}
