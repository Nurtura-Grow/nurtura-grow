<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InformasiLahan extends Model
{
    use HasFactory;
    protected $table = 'informasi_lahan';
    protected $primaryKey = 'id_lahan';
    protected $guarded = [
        'id_lahan'
    ];

    public static function activeLahanData()
    {
        return self::where('deleted_by', null)->where('deleted_at', null)->orderBy('nama_lahan')->get();
    }

    public function data_sensor(): HasMany
    {
        return $this->hasMany(DataSensor::class, 'id_lahan', 'id_lahan');
    }

    public function penanaman(): HasMany
    {
        return $this->hasMany(Penanaman::class, 'id_lahan', 'id_lahan');
    }
}
