<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAksi extends Model
{
    use HasFactory;
    protected $table = 'log_aksi';
    protected $primaryKey = 'id_log_aksi';
    protected $guarded = [
        'id_log_aksi'
    ];
}
