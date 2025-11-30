<?php

namespace App\Http\Requests\PagoCita;

use Illuminate\Foundation\Http\FormRequest;

class StorePagoCitaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cita_id' => ['required', 'exists:cita,id'],
            'monto' => ['required', 'numeric', 'min:0'],
            'metodo' => ['required', 'string', 'max:40'],
            'estado' => ['nullable', 'in:pendiente,pagado,fallido,reembolsado'],
            'transaccion_ref' => ['nullable', 'string', 'max:120'],
            'pagado_en' => ['nullable', 'date'],
        ];
    }
}