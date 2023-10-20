<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSensor extends Model
{
    use HasFactory;
    protected $table = 'data_sensor';
    protected $primaryKey = 'id_sensor';
    protected $guarded = [
        'id_sensor'
    ];
}
