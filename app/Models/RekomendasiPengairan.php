<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RekomendasiPengairan extends Model
{
    use HasFactory;
    protected $table = 'rekomendasi_pengairan';
    protected $primaryKey = 'id_rekomendasi_air';
    protected $guarded = [
        'id_rekomendasi_air'
    ];

    public function penanaman(): BelongsTo
    {
        return $this->belongsTo(Penanaman::class, 'id_penanaman', 'id_penanaman');
    }

    public function log_aksi(): BelongsTo
    {
        return $this->belongsTo(LogAksi::class, 'id_log_aksi', 'id_log_aksi');
    }
}
