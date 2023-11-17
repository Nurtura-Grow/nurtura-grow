<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SopPemupukan extends Model
{
    use HasFactory;
    protected $table = 'sop_pemupukan';
    protected $primaryKey = 'id_sop_pemupukan';
    protected $guarded = [
        'id_sop_pemupukan'
    ];

    public function log_aksi(): HasMany
    {
        return $this->hasMany(LogAksi::class, 'id_sop_pemupukan', 'id_sop_pemupukan');
    }

    // Created By, Updated By, Deleted By
    public function userCreatedBy(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id_user');
    }

    public function userUpdatedBy(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id_user');
    }

    public function userDeletedBy(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'deleted_by', 'id_user');
    }
}
