<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pago_cita', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cita_id')->constrained('cita')->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('monto', 10, 2);
            $table->string('metodo', 40); // efectivo, tarjeta, transferencia, etc.
            $table->enum('estado', ['pendiente', 'pagado', 'fallido', 'reembolsado'])->default('pendiente');
            $table->string('transaccion_ref', 120)->nullable();
            $table->timestamp('pagado_en')->nullable();
            $table->timestamp('creado_en')->useCurrent();

            $table->index(['cita_id', 'estado'], 'ix_pago_cita_estado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pago_cita');
    }
};

