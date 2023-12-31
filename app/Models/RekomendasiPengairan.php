<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class RekomendasiPengairan extends Model
{
    use HasFactory;
    protected $table = 'rekomendasi_pengairan';
    protected $primaryKey = 'id_rekomendasi_air';
    protected $guarded = [
        'id_rekomendasi_air'
    ];

    public function data_sensor(): BelongsTo
    {
        return $this->belongsTo(DataSensor::class, 'id_sensor', 'id_sensor');
    }

    public function log_aksi(): BelongsTo
    {
        return $this->belongsTo(LogAksi::class, 'id_log_aksi', 'id_log_aksi');
    }

    public function kondisi_message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'kondisi', 'id');
    }

    public function saran_message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'saran', 'id');
    }
}
