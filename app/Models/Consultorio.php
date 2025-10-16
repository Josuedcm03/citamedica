<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Consultorio extends Model
{
    protected $table = 'consultorio';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'ubicacion',
    ];

    /** @return HasMany<HorarioMedico> */
    public function horariosMedicos(): HasMany
    {
        return $this->hasMany(HorarioMedico::class, 'consultorio_id');
    }

    /** @return HasMany<Cita> */
    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class, 'consultorio_id');
    }
}
