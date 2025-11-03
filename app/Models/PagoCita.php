<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PagoCita extends Model
{
    protected $table = 'pago_cita';
    public $timestamps = false;

    protected $fillable = [
        'cita_id',
        'monto',
        'metodo',
        'estado',
        'transaccion_ref',
        'pagado_en',
        'creado_en',
    ];

    protected $casts = [
        'monto' => 'decimal:2',
        'pagado_en' => 'datetime',
        'creado_en' => 'datetime',
    ];

    /** @return BelongsTo<Cita,PagoCita> */
    public function cita(): BelongsTo
    {
        return $this->belongsTo(Cita::class, 'cita_id');
    }
}

