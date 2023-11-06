<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InformasiLahan;

class LahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InformasiLahan::firstOrCreate([
            'nama_lahan' => 'Lahan 1',
            'deskripsi' => 'Ini lahan pertama',
            'latitude' => -7.710903,
            'longitude' => 111.678924,
            'kecamatan' => 'Madiun Regency',
            'kota' => 'East Java',
            'alamat' => '7MQH+JH Kare, Madiun Regency, East Java, Indonesia',
            'created_by' => 1
        ]);
    }
}
