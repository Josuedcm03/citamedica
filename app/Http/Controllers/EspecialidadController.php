<?php

namespace App\Http\Controllers;

use App\Http\Requests\Especialidad\StoreEspecialidadRequest;
use App\Http\Requests\Especialidad\UpdateEspecialidadRequest;
use App\Http\Resources\EspecialidadResource;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EspecialidadController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 15);
        $search = $request->query('search');

        $especialidades = Especialidad::query()
            ->when($search, function ($query, $value) {
                $query->where('nombre', 'like', "%{$value}%");
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);

        return EspecialidadResource::collection($especialidades);
    }

    public function store(StoreEspecialidadRequest $request)
    {
        $especialidad = Especialidad::create($request->validated());

        return EspecialidadResource::make($especialidad)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Especialidad $especialidade)
    {
        return EspecialidadResource::make($especialidade);
    }

    public function update(UpdateEspecialidadRequest $request, Especialidad $especialidade)
    {
        $especialidade->update($request->validated());

        return EspecialidadResource::make($especialidade);
    }

    public function destroy(Especialidad $especialidade)
    {
        $especialidade->delete();
        return response()->noContent();
    }
}
