<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CitaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cita')->truncate();

        $base = Carbon::now()->startOfDay();

        DB::table('cita')->insert([
            [
                'id' => 1,
                'paciente_id' => 1,
                'empleado_id' => 1,
                'consultorio_id' => 1,
                'especialidad_id' => 1,
                'fecha_hora_inicio' => $base->copy()->addDays(1)->setTime(9, 0),
                'duracion_minutos' => 30,
                'estado' => 'confirmada',
                'motivo' => 'Chequeo general y resultados de laboratorio',
                'notas' => 'Paciente refiere malestar general leve.',
                'resultado' => null,
                'resultado_publicado_at' => null,
            ],
            [
                'id' => 2,
                'paciente_id' => 2,
                'empleado_id' => 2,
                'consultorio_id' => 1,
                'especialidad_id' => 2,
                'fecha_hora_inicio' => $base->copy()->addDays(1)->setTime(10, 0),
                'duracion_minutos' => 30,
                'estado' => 'pendiente',
                'motivo' => 'Dolor en el pecho al hacer ejercicio',
                'notas' => 'Solicita evaluacion cardiaca inicial.',
                'resultado' => null,
                'resultado_publicado_at' => null,
            ],
            [
                'id' => 3,
                'paciente_id' => 3,
                'empleado_id' => 2,
                'consultorio_id' => 3,
                'especialidad_id' => 3,
                'fecha_hora_inicio' => $base->copy()->addDays(2)->setTime(11, 30),
                'duracion_minutos' => 30,
                'estado' => 'pendiente',
                'motivo' => 'Consulta por erupcion cutanea',
                'notas' => 'Se programo como telemedicina.',
                'resultado' => null,
                'resultado_publicado_at' => null,
            ],
            [
                'id' => 4,
                'paciente_id' => 1,
                'empleado_id' => 1,
                'consultorio_id' => 2,
                'especialidad_id' => 4,
                'fecha_hora_inicio' => $base->copy()->subDay()->setTime(15, 30),
                'duracion_minutos' => 45,
                'estado' => 'atendida',
                'motivo' => 'Control pediatrico',
                'notas' => 'Paciente pediatrico con buen progreso.',
                'resultado' => 'Se recomienda continuar control trimestral.',
                'resultado_publicado_at' => $base->copy()->subDay()->setTime(18, 0),
            ],
        ]);
    }
}
