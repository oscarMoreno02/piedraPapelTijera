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
        Schema::create('mano', function (Blueprint $table) {
            $table->id()->unique();
            $table->integer('id_partida');
            $table->string('mano_usuario1',30);
            $table->string('mano_usuario2',30);
            $table->integer('ganador');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mano');
    }
};
