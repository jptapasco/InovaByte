<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoMesasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipo_mesas')->insert([

            ['nombre_mesa' => 'pool',
            'created_at' => now(),
            'updated_at' => now(),],

            ['nombre_mesa' => 'tres_bandas',
            'created_at' => now(),
            'updated_at' => now(),],

            ['nombre_mesa' => 'mesa_clientes',
            'created_at' => now(),
            'updated_at' => now(),],
            
        ]);
    }
}