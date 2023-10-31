<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogAksi extends Model
{
    use HasFactory;
    protected $table = 'log_aksi';
    protected $primaryKey = 'id_log_aksi';
    protected $guarded = [
        'id_log_aksi'
    ];

    public function rekomendasi_pengairan(): BelongsTo
    {
        return $this->belongsTo(RekomendasiPengairan::class, 'id_rekomendasi_air', 'id_rekomendasi_air');
    }

    public function rekomendasi_pemupukan(): BelongsTo
    {
        return $this->belongsTo(RekomendasiPemupukan::class, 'id_rekomendasi_pemupukan', 'id_rekomendasi_pemupukan');
    }

    public function penanaman(): BelongsTo
    {
        return $this->belongsTo(Penanaman::class, 'id_penanaman', 'id_penanaman');
    }

    public function sop_pemupukan(): BelongsTo
    {
        return $this->belongsTo(SopPemupukan::class, 'id_sop_pemupukan', 'id_sop_pemupukan');
    }

    public function tipe_instruksi(): BelongsTo
    {
        return $this->belongsTo(TipeInstruksi::class, 'id_tipe_instruksi', 'id_tipe_instruksi');
    }
}
