<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SOPPengairan;

class SopPengairanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SOPPengairan::insert([
            [
                'nama' => 'temperature',
                'min' => '25',
                'max' => '33',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'humidity',
                'min' => '60',
                'max' => '69',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'soil moisture',
                'min' => '50',
                'max' => '69',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
