<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Penanaman extends Model
{
    use HasFactory;
    protected $table = 'penanaman';
    protected $primaryKey = 'id_penanaman';
    protected $guarded = [
        'id_penanaman'
    ];

    public function data_sensor(): HasMany
    {
        return $this->hasMany(DataSensor::class, 'id_penanaman', 'id_penanaman');
    }

    public function informasi_lahan(): BelongsTo
    {
        return $this->belongsTo(InformasiLahan::class, 'id_lahan', 'id_lahan');
    }

    public function log_aksi(): HasMany
    {
        return $this->hasMany(LogAksi::class, 'id_penanaman', 'id_penanaman');
    }

    public function penanaman_user(): HasOne
    {
        return $this->hasOne(PenanamanUser::class, 'id_penanaman', 'id_penanaman');
    }

    public function rekomendasi_pengairan(): HasMany
    {
        return $this->hasMany(RekomendasiPengairan::class, 'id_penanaman', 'id_penanaman');
    }

    public function tinggi_tanaman(): HasMany
    {
        return $this->hasMany(TinggiTanaman::class, 'id_penanaman', 'id_penanaman');
    }
}
