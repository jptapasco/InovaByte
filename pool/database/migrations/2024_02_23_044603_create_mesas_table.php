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
        Schema::create('mesas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tipo_mesas');
            $table->unsignedBigInteger('id_mesera_asignada')->nullable();
            $table->foreign('id_tipo_mesas')->references('id')->on('tipo_mesas');
            $table->foreign('id_mesera_asignada')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mesas');
    }
};