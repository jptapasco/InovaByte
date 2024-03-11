<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ClientesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(TipoMesasSeeder::class);
        $this->call(MesasSeeder::class);
        $this->call(ProductosSeeder::class);
        $this->call(FacturasSeeder::class);
        $this->call(FacturaDetallesSeeder::class);
        $this->call(PlataCajeros::class);
        $this->call(UsuarioObservaciones::class);
    }
}