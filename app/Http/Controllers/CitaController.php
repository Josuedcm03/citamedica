<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cita\PublicarResultadoRequest;
use App\Http\Requests\Cita\StoreCitaRequest;
use App\Http\Requests\Cita\UpdateCitaRequest;
use App\Http\Resources\CitaResource;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CitaController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 15);
        $search = $request->query('search');

        $citas = Cita::query()
            ->with(['paciente', 'empleado', 'consultorio', 'especialidad'])
            ->when($search, function ($query, $value) {
                $query->where('motivo', 'like', "%{$value}%")
                    ->orWhereHas('paciente', function ($pacienteQuery) use ($value) {
                        $pacienteQuery->where('nombre', 'like', "%{$value}%");
                    })
                    ->orWhereHas('empleado', function ($empleadoQuery) use ($value) {
                        $empleadoQuery->where('nombre', 'like', "%{$value}%");
                    });
            })
            ->orderBy('fecha_hora_inicio', 'desc')
            ->paginate($perPage);

        return CitaResource::collection($citas);
    }

    public function store(StoreCitaRequest $request)
    {
        $cita = Cita::create($request->validated());

        return CitaResource::make($cita->load(['paciente', 'empleado', 'consultorio', 'especialidad']))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Cita $cita)
    {
        return CitaResource::make($cita->load(['paciente', 'empleado', 'consultorio', 'especialidad']));
    }

    public function update(UpdateCitaRequest $request, Cita $cita)
    {
        $cita->update($request->validated());

        return CitaResource::make($cita->fresh(['paciente', 'empleado', 'consultorio', 'especialidad']));
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
        return CitaResource::make($cita->fresh(['paciente', 'empleado', 'consultorio', 'especialidad']));
    }

    public function cancelar(Cita $cita)
    {
        $cita->estado = 'cancelada';
        $cita->save();
        return CitaResource::make($cita->fresh(['paciente', 'empleado', 'consultorio', 'especialidad']));
    }

    public function marcarAtendida(Cita $cita)
    {
        $cita->estado = 'atendida';
        $cita->save();
        return CitaResource::make($cita->fresh(['paciente', 'empleado', 'consultorio', 'especialidad']));
    }

    public function publicarResultado(PublicarResultadoRequest $request, Cita $cita)
    {
        $cita->resultado = $request->validated()['resultado'];
        $cita->resultado_publicado_at = now();
        $cita->save();
        return CitaResource::make($cita->fresh(['paciente', 'empleado', 'consultorio', 'especialidad']));
    }
}