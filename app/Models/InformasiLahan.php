<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class InformasiLahan extends Model
{
    use HasFactory;
    protected $table = 'informasi_lahan';
    protected $primaryKey = 'id_lahan';
    protected $guarded = [
        'id_lahan'
    ];

    public static function activeLahanDataWithNewNama()
    {
        return self::activeLahanData()->map(function ($lahan) {
            $lahan->new_nama = Str::slug($lahan->nama_lahan);
            return $lahan;
        });
    }
    public static function activeLahanData()
    {
        return self::where('deleted_by', null)->where('deleted_at', null)->orderBy('nama_lahan')->get();
    }

    public function penanaman(): HasMany
    {
        return $this->hasMany(Penanaman::class, 'id_lahan', 'id_lahan');
    }

    public function data_sensor(): HasManyThrough
    {
        return $this->hasManyThrough(DataSensor::class, Penanaman::class, 'id_lahan', 'id_penanaman', 'id_lahan', 'id_penanaman');
    }

    public function rekomendasi_pengairan(): HasManyThrough
    {
        return $this->hasManyThrough(RekomendasiPengairan::class, Penanaman::class, 'id_lahan', 'id_penanaman', 'id_lahan', 'id_penanaman');
    }

    public function rekomendasi_pemupukan(): HasManyThrough
    {
        return $this->hasManyThrough(RekomendasiPemupukan::class, Penanaman::class, 'id_lahan', 'id_penanaman', 'id_lahan', 'id_penanaman');
    }

    // Created By, Updated By, Deleted By
    public function userCreatedBy(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id_user');
    }

    public function userUpdatedBy(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id_user');
    }

    public function userDeletedBy(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'deleted_by', 'id_user');
    }
}
