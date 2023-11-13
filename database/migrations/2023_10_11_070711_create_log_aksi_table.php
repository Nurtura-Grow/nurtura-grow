<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('log_aksi', function (Blueprint $table) {
            $table->id('id_log_aksi');
            $table->foreignId('id_tipe_instruksi');
            $table->foreignId('id_penanaman');
            $table->foreignId('id_rekomendasi_pemupukan')->nullable();
            $table->foreignId('id_rekomendasi_air')->nullable();
            $table->float('durasi');
            // Diisi kalau diisi manual
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('deleted_by')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_aksi');
    }
};
