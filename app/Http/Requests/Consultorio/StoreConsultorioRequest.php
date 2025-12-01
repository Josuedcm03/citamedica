<?php

namespace App\Http\Requests\Consultorio;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultorioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:50'],
            'ubicacion' => ['nullable', 'string', 'max:120'],
        ];
    }
}
