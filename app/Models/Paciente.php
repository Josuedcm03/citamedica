<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paciente extends Model
{
    protected $table = 'paciente';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'documento',
        'fecha_nacimiento',
        'telefono',
        'email',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    /** @return HasMany<Cita> */
    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class, 'paciente_id');
    }
}
