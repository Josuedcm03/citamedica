<?php

namespace App\Http\Controllers;

use App\Http\Requests\Paciente\StorePacienteRequest;
use App\Http\Requests\Paciente\UpdatePacienteRequest;
use App\Http\Resources\PacienteResource;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PacienteController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 15);
        $search = $request->query('search');

        $pacientes = Paciente::query()
            ->when($search, function ($query, $value) {
                $query->where(function ($subQuery) use ($value) {
                    $subQuery->where('nombre', 'like', "%{$value}%")
                        ->orWhere('documento', 'like', "%{$value}%");
                });
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);

        return PacienteResource::collection($pacientes);
    }

    public function store(StorePacienteRequest $request)
    {
        $paciente = Paciente::create($request->validated());

        return PacienteResource::make($paciente)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Paciente $paciente)
    {
        return PacienteResource::make($paciente);
    }

    public function update(UpdatePacienteRequest $request, Paciente $paciente)
    {
        $paciente->update($request->validated());

        return PacienteResource::make($paciente);
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return response()->noContent();
    }
}