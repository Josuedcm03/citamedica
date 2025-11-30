<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\PagoCita */
class PagoCitaResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'cita_id' => $this->cita_id,
            'monto' => $this->monto,
            'metodo' => $this->metodo,
            'estado' => $this->estado,
            'transaccion_ref' => $this->transaccion_ref,
            'pagado_en' => $this->pagado_en,
            'cita' => new CitaResource($this->whenLoaded('cita')),
        ];
    }
}