<?php

namespace App\Models;

use Carbon\Carbon;
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

    public static function getHST($id_penanaman, $tanggal_pencatatan)
    {
        $penanaman = Penanaman::find($id_penanaman);

        if (!$penanaman) {
            // Handle case where penanaman is not found
            return null;
        }

        $tanggal_tanam = Carbon::parse($penanaman->tanggal_tanam);
        $tanggal_pencatatan = Carbon::parse($penanaman->tanggal_pencatatan);

        // Calculate HST in days
        $hst = $tanggal_pencatatan->diffInDays($tanggal_tanam);
        return $hst;
    }

    public function penanaman(): BelongsTo
    {
        return $this->belongsTo(Penanaman::class, 'id_penanaman', 'id_penanaman');
    }

    public function rekomendasi_pemupukan(): HasMany
    {
        return $this->hasMany(RekomendasiPemupukan::class, 'id_rekomendasi_pemupukan', 'id_rekomendasi_pemupukan');
    }
}
