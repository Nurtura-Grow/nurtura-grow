<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SOPPengairan extends Model
{
    use HasFactory;
    protected $table = 'sop_pengairan';
    protected $primaryKey = 'id_sop_pengairan';
    protected $guarded = [
        'id_sop_pengairan'
    ];

}
