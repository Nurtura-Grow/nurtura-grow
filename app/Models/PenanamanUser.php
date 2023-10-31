<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenanamanUser extends Model
{
    use HasFactory;
    protected $table = 'penanaman_user';
    protected $primaryKey = 'id_user_penanaman';
    protected $guarded = [
        'id_user_penanaman'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function penanaman(): BelongsTo
    {
        return $this->belongsTo(Penanaman::class, 'id_penanaman', 'id_penanaman');
    }
}
