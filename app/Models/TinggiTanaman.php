<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class TinggiTanaman extends Model
{
    use HasFactory;
    protected $table = 'tinggi_tanaman';
    protected $primaryKey = 'id_tinggi_tanaman';
    protected $guarded = [
        'id_tinggi_tanaman'
    ];

    public static function getHST($id_penanaman, $tanggal_pencatatan)
    {
        $penanaman = Penanaman::find($id_penanaman);

        if (!$penanaman) {
            // Handle case where penanaman is not found
            return -1;
        }

        $tanggal_tanam = Carbon::parse($penanaman->tanggal_tanam);
        $tanggal_pencatatan = Carbon::parse($tanggal_pencatatan);

        if ($tanggal_pencatatan < $tanggal_tanam) {
            return -2;
        } else {
            $hst = $tanggal_pencatatan->diffInDays($tanggal_tanam);
            return $hst;
        }
    }

    public static function activeTinggiDataWithDetails()
    {
        return self::with(['penanaman.informasi_lahan', 'userCreatedBy', 'rekomendasi_pemupukan.message'])
            ->whereNull('deleted_by')
            ->whereNull('deleted_at')
            ->get()
            // ->map(function ($tinggi) {
            //     $penanaman = $tinggi->penanaman->first();
            //     $tinggi->nama_penanaman = $penanaman->nama_penanaman;
            //     $tinggi->nama_lahan = $penanaman->informasi_lahan->first()->nama_lahan;
            //     $tinggi->created_by = $tinggi->userCreatedBy->first()->nama;
            //     $tinggi->tanggal_tanam = app('App\Http\Controllers\Controller')->formatDateUI($penanaman->tanggal_tanam);
            //     $tinggi->ditambahkan_pada = app('App\Http\Controllers\Controller')->formatDateUI($tinggi->tanggal_pengukuran);
            //     return $tinggi;
            // })
            ->sortBy([
                ['nama_penanaman', 'asc'],
                ['hari_setelah_tanam', 'asc'],
            ]);
    }


    public static function activeTinggiData()
    {
        return self::where('deleted_by', null)->where('deleted_at', null)->get();
    }

    public function penanaman(): BelongsTo
    {
        return $this->belongsTo(Penanaman::class, 'id_penanaman', 'id_penanaman');
    }

    public function rekomendasi_pemupukan(): HasOne
    {
        return $this->hasOne(RekomendasiPemupukan::class, 'id_tinggi_tanaman', 'id_tinggi_tanaman');
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
