<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->enum('categoria', ['alcoholicas', 'no_alcoholicas', 'comida', 'snacks']);
            $table->enum('unidad_medida', ['unidad', 'paquete', 'canasta']);
            $table->integer('cantidad');
            $table->integer('punto_reorden');
            $table->integer('precio_compra');
            $table->integer('precio_venta');
            $table->text('descripcion');
            $table->longText('url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
