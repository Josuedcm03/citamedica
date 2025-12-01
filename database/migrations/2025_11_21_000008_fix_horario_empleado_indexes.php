<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('horario_empleado')) {
            return;
        }

        // Si ya existe empleado_id sin rastro de medico_id, no es necesario ajustar nada.
        if (Schema::hasColumn('horario_empleado', 'empleado_id') && ! Schema::hasColumn('horario_empleado', 'medico_id')) {
            return;
        }

        Schema::table('horario_empleado', function (Blueprint $table) {
            if (! Schema::hasColumn('horario_empleado', 'empleado_id')) {
                $table->unsignedBigInteger('empleado_id')->nullable()->after('id');
            }
        });

        if (Schema::hasColumn('horario_empleado', 'medico_id') && Schema::hasColumn('horario_empleado', 'empleado_id')) {
            DB::statement('UPDATE horario_empleado SET empleado_id = medico_id');
        }

        Schema::table('horario_empleado', function (Blueprint $table) {
            if (Schema::hasColumn('horario_empleado', 'medico_id')) {
                try { $table->dropForeign(['medico_id']); } catch (Throwable $e) {}
            }

            try { $table->dropIndex('ix_horario_medico'); } catch (Throwable $e) {}

            if (Schema::hasColumn('horario_empleado', 'medico_id')) {
                try { $table->dropColumn('medico_id'); } catch (Throwable $e) {}
            }

            if (Schema::hasColumn('horario_empleado', 'empleado_id')) {
                $table->foreign('empleado_id')->references('id')->on('empleado')->cascadeOnUpdate()->cascadeOnDelete();
                $table->index(['empleado_id', 'dia_semana', 'hora_inicio'], 'ix_horario_empleado');
            }
        });
    }

    public function down(): void
    {
        // No rollback; mantiene la estructura con empleado_id
    }
};
