<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SopPemupukan;
use App\Models\User;

class SopPemupukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id_user = User::first()->id_user;

        // Default Data
        $tinggi_minimal = 0;
        $tinggi_maksimal = 0;
        $pertumbuhan3HariMinimal = 15;
        $jumlah_pupuk = 1.3;
        $jumlah_air = 520;

        // Pemupukan setiap 3 hari sekali (Pupuk Cair)
        for ($i = 0; $i <= 60; $i = $i + 3) {
            SopPemupukan::create([
                "hari_setelah_tanam" => $i,
                "tinggi_tanaman_minimal" => $tinggi_minimal,
                "tinggi_tanaman_maksimal" => $tinggi_maksimal,
                "jumlah_pupuk" => $jumlah_pupuk,
                "jumlah_air" => $jumlah_air,
                "created_by" => $id_user,
            ]);

            // Agar range perbedaan selalu sama, yaitu sebanyak 15 mm setiap 3 hari
            $tinggi_minimal += $pertumbuhan3HariMinimal;
            $tinggi_maksimal = $tinggi_minimal + $pertumbuhan3HariMinimal;
        }
    }
}
