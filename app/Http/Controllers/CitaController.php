<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class CitaController extends Controller
{
    public function index()
    {
        return Cita::query()
            ->with(['paciente', 'empleado', 'consultorio', 'especialidad'])
            ->orderBy('fecha_hora_inicio', 'desc')
            ->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'paciente_id' => 'required|exists:paciente,id',
            'empleado_id' => 'required|exists:empleado,id',
            'consultorio_id' => 'nullable|exists:consultorio,id',
            'especialidad_id' => 'nullable|exists:especialidad,id',
            'fecha_hora_inicio' => 'required|date',
            'duracion_minutos' => 'nullable|integer|min:5|max:480',
            'motivo' => 'nullable|string|max:240',
            'notas' => 'nullable|string',
        ]);
        $cita = Cita::create($data);
        return response()->json($cita->load(['paciente','empleado']), Response::HTTP_CREATED);
    }

    public function show(Cita $cita)
    {
        return $cita->load(['paciente','empleado','consultorio','especialidad']);
    }

    public function update(Request $request, Cita $cita)
    {
        $data = $request->validate([
            'paciente_id' => 'sometimes|exists:paciente,id',
            'empleado_id' => 'sometimes|exists:empleado,id',
            'consultorio_id' => 'nullable|exists:consultorio,id',
            'especialidad_id' => 'nullable|exists:especialidad,id',
            'fecha_hora_inicio' => 'sometimes|date',
            'duracion_minutos' => 'nullable|integer|min:5|max:480',
            'motivo' => 'nullable|string|max:240',
            'notas' => 'nullable|string',
            'estado' => 'nullable|in:pendiente,confirmada,atendida,cancelada',
        ]);
        $cita->update($data);
        return $cita->fresh(['paciente','empleado']);
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();
        return response()->noContent();
    }

    public function confirmar(Cita $cita)
    {
        $cita->estado = 'confirmada';
        $cita->save();
        return $cita;
    }

    public function cancelar(Cita $cita)
    {
        $cita->estado = 'cancelada';
        $cita->save();
        return $cita;
    }

    public function marcarAtendida(Cita $cita)
    {
        $cita->estado = 'atendida';
        $cita->save();
        return $cita;
    }

    public function publicarResultado(Request $request, Cita $cita)
    {
        $data = $request->validate([
            'resultado' => 'required|string',
        ]);
        $cita->resultado = $data['resultado'];
        $cita->resultado_publicado_at = now();
        $cita->save();
        return $cita;
    }
}

