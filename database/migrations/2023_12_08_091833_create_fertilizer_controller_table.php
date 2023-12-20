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
        Schema::create('fertilizer_controller', function (Blueprint $table) {
            $table->id('id_fertilizer_controller');
            $table->string('mode', 10);
            $table->foreignId('id_penanaman')->nullable();
            $table->foreignId('id_rekomendasi_pupuk')->nullable();
            $table->integer('volume_liter');
            $table->integer('durasi_detik');
            $table->boolean('willSend');
            $table->boolean('isSent');
            $table->timestamp('waktu_mulai')->nullable();
            $table->timestamp('waktu_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fertilizer_controller');
    }
};
