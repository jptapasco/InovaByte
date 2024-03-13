<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacturasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('facturas')->insert([
            ['id_mesa' => '1',
            'id_cliente' => '2',
            'id_vendedor' => '2',
            'total' => '130000',
            'hora_inicio' => '2024-03-02 01:26:40',
            'hora_fin' => '2024-03-02 02:30:10',
            'created_at' => now(),
            'updated_at' => now(),],
        ]);
    }
}