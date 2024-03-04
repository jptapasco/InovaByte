<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('productos')->insert([
            ['nombre' => 'Cerveza',
            'categoria' => 'alcoholicas',
            'unidad_medida' => 'unidad',
            'cantidad' => 100,
            'punto_reorden' => 20,
            'precio_compra' => 2000,
            'precio_venta' => 3000,
            'descripcion' => 'La mejor cerveza de la laif',
            'url' => 'cerveza.jpg',
            'created_at' => now(),
            'updated_at' => now(),],

            ['nombre' => 'Pepsi',
            'categoria' => 'no_alcoholicas',
            'unidad_medida' => 'paquete',
            'cantidad' => 50,
            'punto_reorden' => 10,
            'precio_compra' => 1000,
            'precio_venta' => 1500,
            'descripcion' => 'Mejor que la Coca-Cola',
            'url' => 'pepsi.jpg',
            'created_at' => now(),
            'updated_at' => now(),],

            ['nombre' => 'Hamburguesa',
            'categoria' => 'comida',
            'unidad_medida' => 'unidad',
            'cantidad' => 30,
            'punto_reorden' => 5,
            'precio_compra' => 13000,
            'precio_venta' => 15000,
            'descripcion' => 'Carne de origen desconocido',
            'url' => 'hambuerguesa.jpg',
            'created_at' => now(),
            'updated_at' => now(),],

            ['nombre' => 'Papas',
            'categoria' => 'snacks',
            'unidad_medida' => 'unidad',
            'cantidad' => 20,
            'punto_reorden' => 5,
            'precio_compra' => 2000,
            'precio_venta' => 2500,
            'descripcion' => 'Tiene más aire que papas',
            'url' => 'papas.jpg',
            'created_at' => now(),
            'updated_at' => now(),],
        ]);
    }
}