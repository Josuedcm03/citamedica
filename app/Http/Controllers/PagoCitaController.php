<?php

namespace App\Http\Controllers;

use App\Models\PagoCita;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PagoCitaController extends Controller
{
    public function index()
    {
        return PagoCita::query()->with('cita')->orderBy('id', 'desc')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cita_id' => 'required|exists:cita,id',
            'monto' => 'required|numeric|min:0',
            'metodo' => 'required|string|max:40',
            'estado' => 'nullable|in:pendiente,pagado,fallido,reembolsado',
            'transaccion_ref' => 'nullable|string|max:120',
            'pagado_en' => 'nullable|date',
        ]);
        $pago = PagoCita::create($data);
        return response()->json($pago->load('cita'), Response::HTTP_CREATED);
    }

    public function show(PagoCita $pago_cita)
    {
        return $pago_cita->load('cita');
    }

    public function update(Request $request, PagoCita $pago_cita)
    {
        $data = $request->validate([
            'monto' => 'sometimes|numeric|min:0',
            'metodo' => 'sometimes|string|max:40',
            'estado' => 'nullable|in:pendiente,pagado,fallido,reembolsado',
            'transaccion_ref' => 'nullable|string|max:120',
            'pagado_en' => 'nullable|date',
        ]);
        $pago_cita->update($data);
        return $pago_cita->load('cita');
    }

    public function destroy(PagoCita $pago_cita)
    {
        $pago_cita->delete();
        return response()->noContent();
    }
}
