<?php

namespace App\Http\Requests\PagoCita;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePagoCitaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'monto' => ['sometimes', 'numeric', 'min:0'],
            'metodo' => ['sometimes', 'string', 'max:40'],
            'estado' => ['nullable', 'in:pendiente,pagado,fallido,reembolsado'],
            'transaccion_ref' => ['nullable', 'string', 'max:120'],
            'pagado_en' => ['nullable', 'date'],
        ];
    }
}