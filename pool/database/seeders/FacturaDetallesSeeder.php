<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacturaDetallesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('factura_detalles')->insert([
            ['id_factura' => '1',
            'id_producto' => '3',
            'cantidad' => '2',
            'subtotal' => '30000',
            'created_at' => now(),
            'updated_at' => now(),],

            ['id_factura' => '1',
            'id_producto' => '1',
            'cantidad' => '2',
            'subtotal' => '6000',
            'created_at' => now(),
            'updated_at' => now(),],

            ['id_factura' => '2',
            'id_producto' => '2',
            'cantidad' => '2',
            'subtotal' => '3000',
            'created_at' => now(),
            'updated_at' => now(),],
        ]);
    }
}
