<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekomendasiPemupukan extends Model
{
    use HasFactory;
    protected $table = 'rekomendasi_pemupukan';
    protected $primaryKey = 'id_rekomendasi_pemupukan';
    protected $guarded = [
        'id_rekomendasi_pemupukan'
    ];
}
