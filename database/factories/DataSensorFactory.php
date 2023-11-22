<?php

namespace Database\Factories;

use App\Models\Penanaman;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataSensor>
 */
class DataSensorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_penanaman' => Penanaman::where('alat_terpasang', true)->first()->id_penanaman,
            'suhu' => random_int(20, 40),
            'kelembapan_udara' => random_int(0, 100),
            'kelembapan_tanah' => random_int(0, 100),
            'ph_tanah' => random_int(0, 14),
            'timestamp_pengukuran' => fake()->unique()->dateTimeThisMonth('+1 days')->format('Y-m-d H:i:s'),
        ];
    }
}
