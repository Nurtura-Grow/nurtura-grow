<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinggiTanaman extends Model
{
    use HasFactory;
    protected $table = 'tinggi_tanaman';
    protected $primaryKey = 'id_tinggi_tanaman';
    protected $guarded = [
        'id_tinggi_tanaman'
    ];
}
