<?php

namespace App\Http\Controllers;

use App\Http\Requests\Empleado\StoreEmpleadoRequest;
use App\Http\Requests\Empleado\UpdateEmpleadoRequest;
use App\Http\Resources\EmpleadoResource;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 15);
        $search = $request->query('search');

        $empleados = Empleado::query()
            ->when($search, function ($query, $value) {
                $query->where('nombre', 'like', "%{$value}%")
                    ->orWhere('email', 'like', "%{$value}%");
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);

        return EmpleadoResource::collection($empleados);
    }

    public function store(StoreEmpleadoRequest $request)
    {
        $empleado = Empleado::create($request->validated());

        return EmpleadoResource::make($empleado)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Empleado $empleado)
    {
        return EmpleadoResource::make($empleado);
    }

    public function update(UpdateEmpleadoRequest $request, Empleado $empleado)
    {
        $empleado->update($request->validated());

        return EmpleadoResource::make($empleado);
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return response()->noContent();
    }
}