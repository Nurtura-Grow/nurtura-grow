<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekomendasiPengairan extends Model
{
    use HasFactory;
    protected $table = 'rekomendasi_pengairan';
    protected $primaryKey = 'id_rekomendasi_air';
    protected $guarded = [
        'id_rekomendasi_air'
    ];
}
