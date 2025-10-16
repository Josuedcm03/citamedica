<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medico extends Model
{
    protected $table = 'medico';
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
        return $this->belongsToMany(Especialidad::class, 'medico_especialidad', 'medico_id', 'especialidad_id');
    }

    /** @return HasMany<HorarioMedico> */
    public function horarios(): HasMany
    {
        return $this->hasMany(HorarioMedico::class, 'medico_id');
    }

    /** @return HasMany<Cita> */
    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class, 'medico_id');
    }
}
