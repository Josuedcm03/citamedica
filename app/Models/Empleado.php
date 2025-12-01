<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empleado extends Model
{
    protected $table = 'empleado';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    /** @return BelongsToMany<Especialidad> */
    public function especialidades(): BelongsToMany
    {
        return $this->belongsToMany(Especialidad::class, 'empleado_especialidad', 'empleado_id', 'especialidad_id');
    }

    /** @return HasMany<HorarioEmpleado> */
    public function horarios(): HasMany
    {
        return $this->hasMany(HorarioEmpleado::class, 'empleado_id');
    }

    /** @return HasMany<Cita> */
    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class, 'empleado_id');
    }
}

