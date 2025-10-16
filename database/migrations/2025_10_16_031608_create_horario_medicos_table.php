<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('horario_medico', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medico_id')->constrained('medico')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedTinyInteger('dia_semana'); // 0..6
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->foreignId('consultorio_id')->nullable()->constrained('consultorio')->cascadeOnUpdate()->nullOnDelete();

            $table->index(['medico_id', 'dia_semana', 'hora_inicio'], 'ix_horario_medico');
        });

        // Checks
        DB::statement("ALTER TABLE horario_medico ADD CONSTRAINT ck_hm_dia CHECK (dia_semana BETWEEN 0 AND 6)");
        DB::statement("ALTER TABLE horario_medico ADD CONSTRAINT ck_hm_horas CHECK (hora_inicio < hora_fin)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horario_medico');
    }
};
