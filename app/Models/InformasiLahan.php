<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InformasiLahan extends Model
{
    use HasFactory;
    protected $table = 'informasi_lahan';
    protected $primaryKey = 'id_informasi_lahan';
    protected $guarded = [
        'id_informasi_lahan'
    ];

    public function data_sensor(): HasMany
    {
        return $this->hasMany(DataSensor::class, 'id_lahan', 'id_lahan');
    }

    public function penanaman(): HasMany
    {
        return $this->hasMany(Penanaman::class, 'id_lahan', 'id_lahan');
    }
}
