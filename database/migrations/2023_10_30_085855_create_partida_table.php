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
        Schema::create('partida', function (Blueprint $table) {
            $table->id()->unique();
            $table->integer('usuario');
            $table->integer('usuario2');
            $table->integer('puntuacion_usuario')->default(0);
            $table->integer('puntuacion_usuario2')->default(0);
            $table->integer('finalizada')->default(0);
            $table->integer('rondas_restantes')->default(5);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partida');
    }
};
