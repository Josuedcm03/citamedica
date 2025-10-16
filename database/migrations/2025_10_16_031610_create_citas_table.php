<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cita', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('paciente')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('medico_id')->constrained('medico')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('consultorio_id')->nullable()->constrained('consultorio')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('especialidad_id')->nullable()->constrained('especialidad')->cascadeOnUpdate()->nullOnDelete();
            $table->dateTime('fecha_hora_inicio');
            $table->unsignedSmallInteger('duracion_minutos')->default(30);
            $table->enum('estado', ['pendiente','confirmada','atendida','cancelada'])->default('pendiente');
            $table->string('motivo', 240)->nullable();
            $table->text('notas')->nullable();
            $table->timestamp('creado_en')->useCurrent();

            $table->unique(['medico_id', 'fecha_hora_inicio'], 'ux_cita_medico_fhi');
            $table->index('paciente_id', 'ix_cita_paciente');
            $table->index('estado', 'ix_cita_estado');
            $table->index('fecha_hora_inicio', 'ix_cita_fhi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cita');
    }
};
