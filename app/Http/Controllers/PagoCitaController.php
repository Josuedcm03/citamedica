<?php

namespace App\Http\Controllers;

use App\Http\Requests\PagoCita\StorePagoCitaRequest;
use App\Http\Requests\PagoCita\UpdatePagoCitaRequest;
use App\Http\Resources\PagoCitaResource;
use App\Models\PagoCita;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PagoCitaController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 15);
        $search = $request->query('search');

        $pagos = PagoCita::query()
            ->with(['cita.paciente', 'cita.empleado'])
            ->when($search, function ($query, $value) {
                $query->where('transaccion_ref', 'like', "%{$value}%")
                    ->orWhere('metodo', 'like', "%{$value}%")
                    ->orWhereHas('cita', function ($citaQuery) use ($value) {
                        $citaQuery->where('motivo', 'like', "%{$value}%");
                    });
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);

        return PagoCitaResource::collection($pagos);
    }

    public function store(StorePagoCitaRequest $request)
    {
        $pago = PagoCita::create($request->validated());

        return PagoCitaResource::make($pago->load(['cita.paciente', 'cita.empleado']))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PagoCita $pago_cita)
    {
        return PagoCitaResource::make($pago_cita->load(['cita.paciente', 'cita.empleado']));
    }

    public function update(UpdatePagoCitaRequest $request, PagoCita $pago_cita)
    {
        $pago_cita->update($request->validated());

        return PagoCitaResource::make($pago_cita->load(['cita.paciente', 'cita.empleado']));
    }

    public function destroy(PagoCita $pago_cita)
    {
        $pago_cita->delete();
        return response()->noContent();
    }
}