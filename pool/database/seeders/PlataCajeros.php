<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlataCajeros extends Seeder
{
    public function run(): void
    {
        DB::table('plata_cajeros')->insert([
            ['estado' => 'activo',
            'dinero_inicio_dia' => 10000,
            'dinero_fin_dia' => 10000,
            'created_at' => now(),
            'updated_at' => now(),],
        ]);
    }
}