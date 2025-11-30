<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('cita')) {
            return;
        }

        // Si ya estamos 100% en empleado_id desde la migración base, no tocar nada.
        if (Schema::hasColumn('cita', 'empleado_id') && ! Schema::hasColumn('cita', 'medico_id')) {
            return;
        }

        Schema::table('cita', function (Blueprint $table) {
            // Ensure we don't keep stale medico indexes in case prior migration partially ran
            try { $table->dropUnique('ux_cita_medico_fhi'); } catch (Throwable $e) {}
            try { $table->dropForeign(['medico_id']); } catch (Throwable $e) {}

            if (Schema::hasColumn('cita', 'medico_id') && ! Schema::hasColumn('cita', 'empleado_id')) {
                $table->unsignedBigInteger('empleado_id')->nullable()->after('paciente_id');
            }
        });

        if (Schema::hasColumn('cita', 'medico_id') && Schema::hasColumn('cita', 'empleado_id')) {
            DB::statement('UPDATE cita SET empleado_id = medico_id');
        }

        Schema::table('cita', function (Blueprint $table) {
            if (Schema::hasColumn('cita', 'medico_id')) {
                try { $table->dropColumn('medico_id'); } catch (Throwable $e) {}
            }

            if (! Schema::hasColumn('cita', 'empleado_id')) {
                return;
            }

            $table->foreign('empleado_id')->references('id')->on('empleado')->cascadeOnUpdate()->restrictOnDelete();
            $table->unique(['empleado_id', 'fecha_hora_inicio'], 'ux_cita_empleado_fhi');
        });
    }

    public function down(): void
    {
        // No-op safety rollback: keep cita with empleado_id
    }
};
