<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadoEspecialidadSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('empleado_especialidad')->truncate();

        DB::table('empleado_especialidad')->insert([
            ['empleado_id' => 1, 'especialidad_id' => 1],
            ['empleado_id' => 1, 'especialidad_id' => 4],
            ['empleado_id' => 2, 'especialidad_id' => 2],
            ['empleado_id' => 2, 'especialidad_id' => 3],
            ['empleado_id' => 3, 'especialidad_id' => 1],
        ]);
    }
}
