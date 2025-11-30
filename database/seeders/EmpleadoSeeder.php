<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('empleado')->truncate();

        DB::table('empleado')->insert([
            [
                'id' => 1,
                'nombre' => 'Dra. Laura Martinez',
                'telefono' => '555-1001',
                'email' => 'laura.martinez@example.com',
                'activo' => true,
            ],
            [
                'id' => 2,
                'nombre' => 'Dr. Carlos Gomez',
                'telefono' => '555-1002',
                'email' => 'carlos.gomez@example.com',
                'activo' => true,
            ],
            [
                'id' => 3,
                'nombre' => 'Enf. Sofia Ruiz',
                'telefono' => '555-1003',
                'email' => 'sofia.ruiz@example.com',
                'activo' => false,
            ],
        ]);
    }
}
