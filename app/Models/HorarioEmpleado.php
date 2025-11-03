<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HorarioEmpleado extends Model
{
    protected $table = 'horario_empleado';
    public $timestamps = false;

    protected $fillable = [
        'empleado_id',
        'dia_semana',
        'hora_inicio',
        'hora_fin',
        'consultorio_id',
    ];

    /** @return BelongsTo<Empleado,HorarioEmpleado> */
    public function empleado(): BelongsTo
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    /** @return BelongsTo<Consultorio,HorarioEmpleado> */
    public function consultorio(): BelongsTo
    {
        return $this->belongsTo(Consultorio::class, 'consultorio_id');
    }
}

