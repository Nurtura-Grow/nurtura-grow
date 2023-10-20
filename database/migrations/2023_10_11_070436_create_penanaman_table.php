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
        Schema::create('penanaman', function (Blueprint $table) {
            $table->id('id_penanaman');
            $table->foreignId('id_lahan');
            $table->boolean('status_hidup');
            $table->timestamp('tanggal_tanam')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penanaman');
    }
};
