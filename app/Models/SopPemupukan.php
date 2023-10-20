<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SopPemupukan extends Model
{
    use HasFactory;
    protected $table = 'sop_pemupukan';
    protected $primaryKey = 'id_sop_pemupukan';
    protected $guarded = [
        'id_sop_pemupukan'
    ];
}
