<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Cita */
class CitaResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'paciente_id' => $this->paciente_id,
            'empleado_id' => $this->empleado_id,
            'consultorio_id' => $this->consultorio_id,
            'especialidad_id' => $this->especialidad_id,
            'fecha_hora_inicio' => $this->fecha_hora_inicio,
            'duracion_minutos' => $this->duracion_minutos,
            'estado' => $this->estado,
            'motivo' => $this->motivo,
            'notas' => $this->notas,
            'resultado' => $this->resultado,
            'resultado_publicado_at' => $this->resultado_publicado_at,
            'paciente' => new PacienteResource($this->whenLoaded('paciente')),
            'empleado' => new EmpleadoResource($this->whenLoaded('empleado')),
            'consultorio' => new ConsultorioResource($this->whenLoaded('consultorio')),
            'especialidad' => new EspecialidadResource($this->whenLoaded('especialidad')),
        ];
    }
}