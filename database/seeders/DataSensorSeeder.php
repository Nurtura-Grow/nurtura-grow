<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\DataSensor;
use Illuminate\Database\Seeder;

class DataSensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startTimestamp = Carbon::parse('2024-01-11 12:37:02');
        $endTimestamp = Carbon::parse('2024-01-12 10:37:02');

        while ($startTimestamp <= $endTimestamp) {
            DataSensor::create([
                'id_penanaman' => 1,
                'suhu' => random_int(25, 33),
                'kelembapan_udara' => random_int(50, 80),
                'kelembapan_tanah' => random_int(50, 80),
                'ph_tanah' => random_int(5, 7),
                'timestamp_pengukuran' => $startTimestamp->format('Y-m-d H:i:s'),
            ]);

            $startTimestamp = $startTimestamp->addMinutes(10);
        }
    }
}
