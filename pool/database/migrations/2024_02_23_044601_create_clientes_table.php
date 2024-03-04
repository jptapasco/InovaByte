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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('documento', 30);
            $table->string('nombres', 50);
            $table->string('telefono', 50);
            $table->string('horas_jugadas', 50);
            $table->string('horas_regalo', 50);
            $table->enum('estado', ['activo', 'inactivo']);
            $table->dateTime('ultima_visita')->now();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};