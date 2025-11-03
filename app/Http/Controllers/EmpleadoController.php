<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmpleadoController extends Controller
{
    public function index()
    {
        return Empleado::query()->orderBy('id', 'desc')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:120',
            'telefono' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:120|unique:empleado,email',
            'activo' => 'boolean',
        ]);
        $empleado = Empleado::create($data);
        return response()->json($empleado, Response::HTTP_CREATED);
    }

    public function show(Empleado $empleado)
    {
        return $empleado;
    }

    public function update(Request $request, Empleado $empleado)
    {
        $data = $request->validate([
            'nombre' => 'sometimes|required|string|max:120',
            'telefono' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:120|unique:empleado,email,' . $empleado->id,
            'activo' => 'boolean',
        ]);
        $empleado->update($data);
        return $empleado;
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return response()->noContent();
    }
}

