<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penanaman extends Model
{
    use HasFactory;
    protected $table = 'penanaman';
    protected $primaryKey = 'id_penanaman';
    protected $guarded = [
        'id_penanaman'
    ];
}
