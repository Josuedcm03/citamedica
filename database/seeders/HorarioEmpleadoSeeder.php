<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorarioEmpleadoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('horario_empleado')->truncate();

        DB::table('horario_empleado')->insert([
            [
                'id' => 1,
                'empleado_id' => 1,
                'dia_semana' => 1,
                'hora_inicio' => '08:00:00',
                'hora_fin' => '12:00:00',
                'consultorio_id' => 1,
            ],
            [
                'id' => 2,
                'empleado_id' => 1,
                'dia_semana' => 3,
                'hora_inicio' => '14:00:00',
                'hora_fin' => '18:00:00',
                'consultorio_id' => 2,
            ],
            [
                'id' => 3,
                'empleado_id' => 2,
                'dia_semana' => 2,
                'hora_inicio' => '09:00:00',
                'hora_fin' => '13:00:00',
                'consultorio_id' => 1,
            ],
            [
                'id' => 4,
                'empleado_id' => 2,
                'dia_semana' => 4,
                'hora_inicio' => '10:00:00',
                'hora_fin' => '16:00:00',
                'consultorio_id' => 3,
            ],
            [
                'id' => 5,
                'empleado_id' => 3,
                'dia_semana' => 5,
                'hora_inicio' => '08:00:00',
                'hora_fin' => '12:00:00',
                'consultorio_id' => 2,
            ],
        ]);
    }
}
