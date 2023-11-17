<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $guarded = [
        'id_user'
    ];

    public function penanaman_user(): HasMany
    {
        return $this->hasMany(Penanaman::class, 'id_user', 'id_user');
    }

    // Relationship Created By, Updated By, Deleted By dkk

}
