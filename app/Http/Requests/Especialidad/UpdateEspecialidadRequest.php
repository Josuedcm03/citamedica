<?php

namespace App\Http\Requests\Especialidad;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEspecialidadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $especialidadId = $this->route('especialidade')?->id ?? null;

        return [
            'nombre' => ['sometimes', 'required', 'string', 'max:100', 'unique:especialidad,nombre,' . $especialidadId],
        ];
    }
}
