<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataSensor extends Model
{
    use HasFactory;
    protected $table = 'data_sensor';
    protected $primaryKey = 'id_sensor';
    protected $guarded = [
        'id_sensor'
    ];

    public function sumber_data_sensor(): BelongsTo
    {
        return $this->belongsTo(SumberDataSensor::class, 'id_sumber_data', 'id_sumber_data');
    }

    public function informasi_lahan(): BelongsTo
    {
        return $this->belongsTo(InformasiLahan::class, 'id_lahan', 'id_lahan');
    }

    public function penanaman(): BelongsTo
    {
        return $this->belongsTo(Penanaman::class, 'id_penanaman', 'id_penanaman');
    }
}
