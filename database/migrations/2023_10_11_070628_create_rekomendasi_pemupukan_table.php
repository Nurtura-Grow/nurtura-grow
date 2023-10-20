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
        Schema::create('rekomendasi_pemupukan', function (Blueprint $table) {
            $table->id('id_rekomendasi_pemupukan');
            $table->foreignId('id_tinggi_tanaman');
            $table->float('jumlah_rekomendasi');
            $table->timestamp('tanggal_rekomendasi')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekomendasi_pemupukan');
    }
};
