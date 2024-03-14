<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            ['documento' => '1004',
            'nombres' => 'Damaez',
            'telefono' => '3146877896',
            'rol' => 'admin',
            'email' => 'dz@gmail.com',
            'email_verified_at' => '2023-03-08 18:29:25',
            'password' => '$2y$12$JGtJE2JwZFoo7tlrxc7Vx.dFyEwCu6f5Mu9XVyh1rLCDSaOb/gIk6',
            'remember_token' => 'B8M31Chi1qvxufeS3FfWhjFXkhb67DCLQFNzFtewJNYb1g1XFRO7HQZajLTp',
            'estado' => 'activo',
            'created_at' => now(),
            'updated_at' => now(),],

            ['documento' => '1003',
            'nombres' => 'JP',
            'telefono' => '316584482',
            'rol' => 'cajero',
            'email' => 'jp@gmail.com',
            'email_verified_at' => '2023-03-08 18:29:25',
            'password' => '$2y$12$JGtJE2JwZFoo7tlrxc7Vx.dFyEwCu6f5Mu9XVyh1rLCDSaOb/gIk6',
            'remember_token' => 'B8M31Chi1qvxufeS3FfWhjFXkhb67DCLQFNzFtewJNYb1g1XFRO7HQZajLTp',
            'estado' => 'activo',
            'created_at' => now(),
            'updated_at' => now(),],

            ['documento' => '1002',
            'nombres' => 'Erick',
            'telefono' => '3158745963',
            'rol' => 'mesera',
            'email' => 'erick@gmail.com',
            'email_verified_at' => '2023-03-08 18:29:25',
            'password' => '$2y$12$JGtJE2JwZFoo7tlrxc7Vx.dFyEwCu6f5Mu9XVyh1rLCDSaOb/gIk6',
            'remember_token' => 'B8M31Chi1qvxufeS3FfWhjFXkhb67DCLQFNzFtewJNYb1g1XFRO7HQZajLTp',
            'estado' => 'activo',
            'created_at' => now(),
            'updated_at' => now(),],

            ['documento' => '1003',
            'nombres' => 'Voce',
            'telefono' => '321654987',
            'rol' => 'mesera',
            'email' => 'voce@gmail.com',
            'email_verified_at' => '2023-03-10 18:29:25',
            'password' => '$2y$12$JGtJE2JwZFoo7tlrxc7Vx.dFyEwCu6f5Mu9XVyh1rLCDSaOb/gIk6',
            'remember_token' => 'B8M31Chi1qvxufeS3FfWhjFXkhb67DCLQFNzFtewJNYb1g1XFRO7HQZajLTp',
            'estado' => 'activo',
            'created_at' => now(),
            'updated_at' => now(),],
        ]);
    }
}
