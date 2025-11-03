<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PacienteController extends Controller
{
    public function index()
    {
        return Paciente::query()->orderBy('id', 'desc')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:120',
            'documento' => 'required|string|max:60',
            'fecha_nacimiento' => 'nullable|date',
            'telefono' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:120',
        ]);
        $paciente = Paciente::create($data);
        return response()->json($paciente, Response::HTTP_CREATED);
    }

    public function show(Paciente $paciente)
    {
        return $paciente;
    }

    public function update(Request $request, Paciente $paciente)
    {
        $data = $request->validate([
            'nombre' => 'sometimes|required|string|max:120',
            'documento' => 'sometimes|required|string|max:60',
            'fecha_nacimiento' => 'nullable|date',
            'telefono' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:120',
        ]);
        $paciente->update($data);
        return $paciente;
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return response()->noContent();
    }
}

