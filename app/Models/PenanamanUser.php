<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenanamanUser extends Model
{
    use HasFactory;
    protected $table = 'penanaman_user';
    protected $primaryKey = 'id_user_penanaman';
    protected $guarded = [
        'id_user_penanaman'
    ];
}
