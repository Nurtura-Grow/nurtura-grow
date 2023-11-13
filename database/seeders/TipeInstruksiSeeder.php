<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipeInstruksi;
use App\Models\User;

class TipeInstruksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id_user = User::first()->id_user;

        TipeInstruksi::create([
            "nama_tipe" => "pemupukan",
            "created_by" => $id_user
        ]);

        TipeInstruksi::create([
            "nama_tipe" => "pengairan",
            "created_by" => $id_user
        ]);
    }
}
