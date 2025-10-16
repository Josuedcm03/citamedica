<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Especialidad extends Model
{
    protected $table = 'especialidad';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];

    /** @return BelongsToMany<Medico> */
    public function medicos(): BelongsToMany
    {
        return $this->belongsToMany(Medico::class, 'medico_especialidad', 'especialidad_id', 'medico_id');
    }

    /** @return HasMany<Cita> */
    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class, 'especialidad_id');
    }
}
