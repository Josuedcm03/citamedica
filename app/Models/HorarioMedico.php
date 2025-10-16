<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HorarioMedico extends Model
{
    protected $table = 'horario_medico';
    public $timestamps = false;

    protected $fillable = [
        'medico_id',
        'dia_semana',
        'hora_inicio',
        'hora_fin',
        'consultorio_id',
    ];

    /** @return BelongsTo<Medico,HorarioMedico> */
    public function medico(): BelongsTo
    {
        return $this->belongsTo(Medico::class, 'medico_id');
    }

    /** @return BelongsTo<Consultorio,HorarioMedico> */
    public function consultorio(): BelongsTo
    {
        return $this->belongsTo(Consultorio::class, 'consultorio_id');
    }
}
