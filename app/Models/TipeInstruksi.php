<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeInstruksi extends Model
{
    use HasFactory;
    protected $table = 'tipe_instruksi';
    protected $primaryKey = 'id_tipe_instruksi';
    protected $guarded = [
        'id_tipe_instruksi'
    ];
}
