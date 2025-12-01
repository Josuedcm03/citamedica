<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PacienteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('paciente')->truncate();

        DB::table('paciente')->insert([
            [
                'id' => 1,
                'nombre' => 'Ana Rivas',
                'documento' => 'CC-1001',
                'fecha_nacimiento' => '1990-04-10',
                'telefono' => '3001112233',
                'email' => 'ana.rivas@example.com',
            ],
            [
                'id' => 2,
                'nombre' => 'Miguel Torres',
                'documento' => 'CC-1002',
                'fecha_nacimiento' => '1985-09-02',
                'telefono' => '3004445566',
                'email' => 'miguel.torres@example.com',
            ],
            [
                'id' => 3,
                'nombre' => 'Lucia Perez',
                'documento' => 'CC-1003',
                'fecha_nacimiento' => '2001-12-15',
                'telefono' => '3007778899',
                'email' => 'lucia.perez@example.com',
            ],
        ]);
    }
}
