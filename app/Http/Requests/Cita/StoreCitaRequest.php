<?php

namespace App\Http\Requests\Cita;

use Illuminate\Foundation\Http\FormRequest;

class StoreCitaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'paciente_id' => ['required', 'exists:paciente,id'],
            'empleado_id' => ['required', 'exists:empleado,id'],
            'consultorio_id' => ['nullable', 'exists:consultorio,id'],
            'especialidad_id' => ['nullable', 'exists:especialidad,id'],
            'fecha_hora_inicio' => ['required', 'date'],
            'duracion_minutos' => ['nullable', 'integer', 'min:5', 'max:480'],
            'motivo' => ['nullable', 'string', 'max:240'],
            'notas' => ['nullable', 'string'],
        ];
    }
}