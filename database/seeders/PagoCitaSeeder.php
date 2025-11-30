<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PagoCitaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pago_cita')->truncate();

        $base = Carbon::now()->startOfDay();

        DB::table('pago_cita')->insert([
            [
                'id' => 1,
                'cita_id' => 1,
                'monto' => 55000,
                'metodo' => 'tarjeta',
                'estado' => 'pagado',
                'transaccion_ref' => 'TX-10001',
                'pagado_en' => $base->copy()->addDay()->setTime(8, 15),
                'creado_en' => $base->copy()->addDay()->setTime(8, 0),
            ],
            [
                'id' => 2,
                'cita_id' => 2,
                'monto' => 65000,
                'metodo' => 'efectivo',
                'estado' => 'pendiente',
                'transaccion_ref' => null,
                'pagado_en' => null,
                'creado_en' => $base->copy()->addDay()->setTime(9, 45),
            ],
            [
                'id' => 3,
                'cita_id' => 4,
                'monto' => 40000,
                'metodo' => 'transferencia',
                'estado' => 'pagado',
                'transaccion_ref' => 'TX-10002',
                'pagado_en' => $base->copy()->subDay()->setTime(14, 45),
                'creado_en' => $base->copy()->subDay()->setTime(14, 30),
            ],
        ]);
    }
}
