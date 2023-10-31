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
        Schema::create('informasi_lahan', function (Blueprint $table) {
            $table->id('id_lahan');
            $table->string('nama_lahan', 50);
            $table->text('deskripsi');
            $table->decimal('latitude', 8, 6);
            $table->decimal('longitude', 9, 6);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_lahan');
    }
};
