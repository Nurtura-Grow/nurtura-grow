<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SumberDataSensor;
use App\Models\User;

class SumberDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id_user = User::first()->id_user;
        SumberDataSensor::create([
            "nama_sumber_data" => "ESP Master",
            "created_by" => $id_user,
        ]);

        SumberDataSensor::create([
            "nama_sumber_data" => "ESP Slave",
            "created_by" => $id_user,
        ]);

        SumberDataSensor::create([
            "nama_sumber_data" => "Rata-Rata",
            "created_by" => $id_user,
        ]);

        SumberDataSensor::create([
            "nama_sumber_data" => "Manual",
            "created_by" => $id_user,
        ]);
    }
}
