<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberDataSensor extends Model
{
    use HasFactory;

    protected $table = 'sumber_data_sensor';
    protected $primaryKey = 'id_sumber_data';
    protected $guarded = [
        'id_sumber_data'
    ];
}
