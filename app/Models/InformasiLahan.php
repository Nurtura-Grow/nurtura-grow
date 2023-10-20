<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiLahan extends Model
{
    use HasFactory;
    protected $table = 'informasi_lahan';
    protected $primaryKey = 'id_informasi_lahan';
    protected $guarded = [
        'id_informasi_lahan'
    ];
}
