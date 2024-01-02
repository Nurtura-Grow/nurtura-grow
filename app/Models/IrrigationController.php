<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IrrigationController extends Model
{
    use HasFactory;
    protected $table = 'irrigation_controller';
    protected $guarded = ['id_irrigation_controller'];
    protected $primaryKey = 'id_irrigation_controller';
    public $timestamps = true;

    public function log_aksi()
    {
        return $this->hasMany(LogAksi::class, 'id_irrigation_controller', 'id_irrigation_controller');
    }

    public function penanaman()
    {
        return $this->belongsTo(Penanaman::class, 'id_penanaman', 'id_penanaman');
    }

    public function rekomendasi_pengairan()
    {
        return $this->belongsTo(RekomendasiPengairan::class, 'id_rekomendasi_pengairan', 'id_rekomendasi_pengairan');
    }
}
