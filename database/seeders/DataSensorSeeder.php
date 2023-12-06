<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\DataSensor;
use App\Models\Penanaman;
use Illuminate\Database\Seeder;

class DataSensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Set the initial date and time
        $startDate = now()->setHour(7)->setMinute(0)->setSecond(0);

        for ($i = 0; $i < 100; $i++){
            DataSensor::create([
                'id_penanaman' => Penanaman::where('alat_terpasang', true)->first()->id_penanaman,
                'suhu' => random_int(20, 40),
                'kelembapan_udara' => random_int(0, 100),
                'kelembapan_tanah' => random_int(0, 100),
                'ph_tanah' => random_int(0, 14),
                'timestamp_pengukuran' => $startDate->addHours(1),
            ]);
        }
    }
}
