<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TinggiTanaman extends Model
{
    use HasFactory;
    protected $table = 'tinggi_tanaman';
    protected $primaryKey = 'id_tinggi_tanaman';
    protected $guarded = [
        'id_tinggi_tanaman'
    ];

    public function penanaman(): BelongsTo
    {
        return $this->belongsTo(Penanaman::class, 'id_penanaman', 'id_penanaman');
    }

    public function rekomendasi_pemupukan(): HasMany
    {
        return $this->hasMany(RekomendasiPemupukan::class, 'id_rekomendasi_pemupukan', 'id_rekomendasi_pemupukan');
    }
}
