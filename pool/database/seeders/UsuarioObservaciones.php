<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioObservaciones extends Seeder
{
    public function run(): void
    {
        DB::table('usuario_observaciones')->insert([
            ['id_usuario' => 3,
            'observacion' => 'La mesera coquetea con los clientes',
            'created_at' => now(),
            'updated_at' => now(),],

            ['id_usuario' => 3,
            'observacion' => 'La mesera se durmió en pleno turno',
            'created_at' => now(),
            'updated_at' => now(),],

            ['id_usuario' => 4,
            'observacion' => 'Le tiró la cerveza a un cliente',
            'created_at' => now(),
            'updated_at' => now(),],
        ]);
    }
}
