<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DataSensor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            LahanSeeder::class,
            TipeInstruksiSeeder::class,
            SopPemupukanSeeder::class,
            // DataSensorSeeder::class,
            // PrediksiSensorSeeder::class,
        ]);
    }
}
