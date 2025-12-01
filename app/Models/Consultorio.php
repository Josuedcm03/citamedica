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

    /** @return HasMany<HorarioEmpleado> */
    public function horariosEmpleados(): HasMany
    {
        return $this->hasMany(HorarioEmpleado::class, 'consultorio_id');
    }

    /** @return HasMany<Cita> */
    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class, 'consultorio_id');
    }
}
