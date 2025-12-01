<?php

namespace App\Http\Requests\Cita;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCitaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'paciente_id' => ['sometimes', 'exists:paciente,id'],
            'empleado_id' => ['sometimes', 'exists:empleado,id'],
            'consultorio_id' => ['nullable', 'exists:consultorio,id'],
            'especialidad_id' => ['nullable', 'exists:especialidad,id'],
            'fecha_hora_inicio' => ['sometimes', 'date'],
            'duracion_minutos' => ['nullable', 'integer', 'min:5', 'max:480'],
            'motivo' => ['nullable', 'string', 'max:240'],
            'notas' => ['nullable', 'string'],
            'estado' => ['nullable', 'in:pendiente,confirmada,atendida,cancelada'],
        ];
    }
}