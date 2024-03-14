<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MesasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mesas')->insert([
            ['id_tipo_mesas' => '1',
            'id_mesera_asignada' => null,
            'id_cliente_asignado' => null,
            'estado' => 'activo',
            'numero' => '1',
            'created_at' => now(),
            'updated_at' => now(),],

            ['id_tipo_mesas' => '2',
            'id_mesera_asignada' => null,
            'id_cliente_asignado' => null,
            'estado' => 'activo',
            'numero' => '2',
            'created_at' => now(),
            'updated_at' => now(),],

            ['id_tipo_mesas' => '3',
            'id_mesera_asignada' => null,
            'id_cliente_asignado' => null,
            'estado' => 'activo',
            'numero' => '3',
            'created_at' => now(),
            'updated_at' => now(),],
        ]);
    }
}