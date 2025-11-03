<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cita extends Model
{
    protected $table = 'cita';
    public $timestamps = false;

    protected $fillable = [
        'paciente_id',
        'empleado_id',
        'consultorio_id',
        'especialidad_id',
        'fecha_hora_inicio',
        'duracion_minutos',
        'estado',
        'motivo',
        'notas',
        'creado_en',
        'resultado',
        'resultado_publicado_at',
    ];

    protected $casts = [
        'fecha_hora_inicio' => 'datetime',
        'duracion_minutos' => 'integer',
        'resultado_publicado_at' => 'datetime',
    ];

    /** @return BelongsTo<Paciente,Cita> */
    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    /** @return BelongsTo<Empleado,Cita> */
    public function empleado(): BelongsTo
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    /** @return BelongsTo<Consultorio,Cita> */
    public function consultorio(): BelongsTo
    {
        return $this->belongsTo(Consultorio::class, 'consultorio_id');
    }

    /** @return BelongsTo<Especialidad,Cita> */
    public function especialidad(): BelongsTo
    {
        return $this->belongsTo(Especialidad::class, 'especialidad_id');
    }
}
