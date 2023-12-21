<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogAksi extends Model
{
    use HasFactory;
    protected $table = 'log_aksi';
    protected $primaryKey = 'id_log_aksi';
    protected $guarded = [
        'id_log_aksi'
    ];

    // function logAksiWithDetails
    public static function logAksiWithDetails()
    {
        $irrigationControllers = IrrigationController::get()->map(function ($control) {
            $control->tipe = 'pengairan';
            return $control;
        });
        $fertilizerControllers = FertilizerController::get()->map(function ($control) {
            $control->tipe = 'pemupukan';
            return $control;
        });

        $dataCombined = $irrigationControllers->merge($fertilizerControllers);

        if ($dataCombined->isNotEmpty()) {
            // willSend, isSent, sedangBerjalan
            $statusMapping = [
                '000' => 'Dihapus',
                '00' => "Tidak dijalankan",
                '10' => "Belum berjalan",
                '111' => "Sedang berjalan",
                '110' => "Sudah Selesai",
            ];

            $dataCombined->load(['penanaman'])->each(function ($item) use ($statusMapping) {
                $item->nama_penanaman = $item->penanaman->nama_penanaman ?? '';
                $item->nama_lahan = $item->penanaman->informasi_lahan->nama_lahan ?? '';
                $item->mode = Str::ucfirst($item->mode);
                $item->perintah_akan_dikirim = $item->willSend ? 'Ya' : 'Tidak';
                $item->perintah_terkirim = $item->isSent;

                $sedangBerjalan = optional($item->log_aksi->first())->sedang_berjalan;
                $statusKey = implode('', [$item->willSend, $item->isSent, $sedangBerjalan]);

                if ($item->deleted_at != null && $item->deleted_by != null) {
                    $statusKey = '000';
                }

                $item->status = $statusMapping[$statusKey] ?? 'Status tidak diketahui';
                $item->aksi = false;

                switch ($statusKey) {
                    case '10':
                        $item->aksi = true;

                    case '00':
                        $item->aksi = true;
                }

                // BaseController formatDateUI
                $item->waktu_mulai = app('App\Http\Controllers\Controller')->formatDateTimeUI($item->waktu_mulai);
                $item->waktu_selesai = app('App\Http\Controllers\Controller')->formatDateTimeUI($item->waktu_selesai);
            });
        }

        return $dataCombined;
    }


    public function penanaman(): BelongsTo
    {
        return $this->belongsTo(Penanaman::class, 'id_penanaman', 'id_penanaman');
    }

    public function irrigation_controller(): BelongsTo
    {
        return $this->belongsTo(IrrigationController::class, 'id_irrigation_controller', 'id_irrigation_controller');
    }

    public function fertilizer_controller(): BelongsTo
    {
        return $this->belongsTo(FertilizerController::class, 'id_fertilizer_controller', 'id_fertilizer_controller');
    }

    public function tipe_instruksi(): BelongsTo
    {
        return $this->belongsTo(TipeInstruksi::class, 'id_tipe_instruksi', 'id_tipe_instruksi');
    }
}
