<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mesas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tipo_mesas');
            $table->unsignedBigInteger('id_mesera_asignada')->nullable();
            $table->unsignedBigInteger('id_cliente_asignado')->nullable();
            $table->enum('estado', ['activo', 'inactivo']);
            $table->integer('numero');
            $table->foreign('id_mesera_asignada')->references('id')->on('users');
            $table->foreign('id_cliente_asignado')->references('id')->on('clientes');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mesas');
    }
};