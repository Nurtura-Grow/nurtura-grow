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
        Schema::create('tinggi_tanaman', function (Blueprint $table) {
            $table->id('id_tinggi_tanaman');
            $table->foreignId('id_penanaman');
            $table->float('tinggi_tanaman');
            $table->integer('hari_setelah_tanam');
            $table->timestamp('tanggal_pengukuran')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tinggi_tanaman');
    }
};
