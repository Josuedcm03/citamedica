<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('empleado_especialidad')->truncate();
        DB::table('especialidad')->truncate();

        DB::table('especialidad')->insert([
            ['id' => 1, 'nombre' => 'Medicina General'],
            ['id' => 2, 'nombre' => 'Cardiologia'],
            ['id' => 3, 'nombre' => 'Dermatologia'],
            ['id' => 4, 'nombre' => 'Pediatria'],
        ]);
    }
}
