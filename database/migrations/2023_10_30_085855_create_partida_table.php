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
            $table->integer('puntuacion_usuario');
            $table->integer('puntuacion_usuario2');
            $table->integer('finalizada');
            $table->integer('rondas_restantes');
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
