<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultorioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('consultorio')->truncate();

        DB::table('consultorio')->insert([
            ['id' => 1, 'nombre' => 'Consultorio Norte', 'ubicacion' => 'Piso 1 - Ala A'],
            ['id' => 2, 'nombre' => 'Consultorio Sur', 'ubicacion' => 'Piso 2 - Ala B'],
            ['id' => 3, 'nombre' => 'Telemedicina', 'ubicacion' => 'Videollamada'],
        ]);
    }
}
