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
        Schema::create('sop_pemupukan', function (Blueprint $table) {
            $table->id('id_sop_pemupukan');
            $table->integer('hari_setelah_tanam');
            $table->float('tinggi_tanaman');
            $table->float('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sop_pemupukan');
    }
};
