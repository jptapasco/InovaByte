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
            ['id_usuario' => 2,
            'observacion' => 'La mesera coquetea con los clientes',
            'created_at' => now(),
            'updated_at' => now(),],

            ['id_usuario' => 2,
            'observacion' => 'La mesera se durmió en pleno turno',
            'created_at' => now(),
            'updated_at' => now(),],

            ['id_usuario' => 2,
            'observacion' => 'Le tiró la cerveza a un cliente (merecido)',
            'created_at' => now(),
            'updated_at' => now(),],
        ]);
    }
}
