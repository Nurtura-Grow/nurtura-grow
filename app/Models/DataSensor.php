<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataSensor extends Model
{
    use HasFactory;
    protected $table = 'data_sensor';
    protected $primaryKey = 'id_sensor';
    protected $guarded = [
        'id_sensor'
    ];
    public $timestamps = false;
    public static function dataSensorWithDetails()
    {
        return self::with(['penanaman', 'penanaman.informasi_lahan'])
            ->get()
            ->sortBy('timestamp_pengukuran');
            //->map(function ($data_sensor) {
            //    $penanaman = $data_sensor->penanaman->first();
            //    $lahan = $penanaman->informasi_lahan->first();
            //    $data_sensor->nama_lahan = $lahan->nama_lahan;
            //    $data_sensor->nama_penanaman = $penanaman->nama_penanaman;
            //    $data_sensor->attribute_timestamp = Carbon::parse($data_sensor->timestamp_pengukuran)->toIso8601String();
            //    $data_sensor->timestamp_pengukuran = Carbon::parse($data_sensor->timestamp_pengukuran)->format('d M Y H:i:s');
            //    return $data_sensor;
            //});
    }

    public function rekomendasi_pengairan(): HasOne
    {
        return $this->hasOne(RekomendasiPengairan::class, 'id_sensor', 'id_sensor');
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
