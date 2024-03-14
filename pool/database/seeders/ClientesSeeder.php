<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('clientes')->insert([
            ['documento' => '0',
            'nombres' => 'Invitado',
            'telefono' => '0',
            'horas_jugadas' => '0',
            'horas_regalo' => '0',
            'estado' => 'activo',
            'ultima_visita' => now(),
            'created_at' => now(),
            'updated_at' => now(),],

            ['documento' => '101',
            'nombres' => 'Juan Perez',
            'telefono' => '5551234',
            'horas_jugadas' => '10',
            'horas_regalo' => '2',
            'estado' => 'activo',
            'ultima_visita' => now(),
            'created_at' => now(),
            'updated_at' => now(),],

            ['documento' => '102',
            'nombres' => 'Maria Rodriguez',
            'telefono' => '555678',
            'horas_jugadas' => '5',
            'horas_regalo' => '1',
            'estado' => 'activo',
            'ultima_visita' => now(),
            'created_at' => now(),
            'updated_at' => now(),],

            ['documento' => '103',
            'nombres' => 'Pedro Gomez',
            'telefono' => '5559876',
            'horas_jugadas' => '8',
            'horas_regalo' => '1',
            'estado' => 'activo',
            'ultima_visita' => now(),
            'created_at' => now(),
            'updated_at' => now(),],

            ['documento' => '104',
            'nombres' => 'Ana Martinez',
            'telefono' => '5554321',
            'horas_jugadas' => '12',
            'horas_regalo' => '3',
            'estado' => 'activo',
            'ultima_visita' => now(),
            'created_at' => now(),
            'updated_at' => now(),],

            ['documento' => '105',
            'nombres' => 'Luis Hernandez',
            'telefono' => '55565465',
            'horas_jugadas' => '15',
            'horas_regalo' => '3',
            'estado' => 'activo',
            'ultima_visita' => now(),
            'created_at' => now(),
            'updated_at' => now(),],
        ]);
        
    }
}
