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
        Schema::create('plata_cajeros', function (Blueprint $table) {
            $table->id();
            $table->enum('estado', ['activo', 'finalizado']);
            $table->integer('dinero_inicio_dia');
            $table->integer('dinero_fin_dia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plata_cajeros');
    }
};
