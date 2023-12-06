<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\DataSensor;
use App\Models\PrediksiSensor;
use Illuminate\Database\Seeder;

class PrediksiSensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataSensor = DataSensor::get();

        foreach ($dataSensor as $sensor) {
            PrediksiSensor::create([
                'id_penanaman' => $sensor->id_penanaman,
                'suhu' => $sensor->suhu + random_int(-2, 2),
                'kelembapan_udara' => $sensor->kelembapan_udara + random_int(-10, 10),
                'kelembapan_tanah' => $sensor->kelembapan_tanah + random_int(-10, 10),
                'timestamp_prediksi_sensor' => Carbon::parse($sensor->timestamp_pengukuran),
            ]);
        }
    }
}
