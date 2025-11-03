<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1) Rename base table medico -> empleado
        if (Schema::hasTable('medico')) {
            Schema::rename('medico', 'empleado');
        }

        // 2) Update cita.medico_id -> cita.empleado_id and indexes/FKs
        if (Schema::hasTable('cita')) {
            Schema::table('cita', function (Blueprint $table) {
                if (!Schema::hasColumn('cita', 'empleado_id')) {
                    $table->unsignedBigInteger('empleado_id')->nullable()->after('paciente_id');
                }
            });

            // Copy data from medico_id to empleado_id if both exist
            if (Schema::hasColumn('cita', 'medico_id') && Schema::hasColumn('cita', 'empleado_id')) {
                DB::statement('UPDATE cita SET empleado_id = medico_id');
            }

            Schema::table('cita', function (Blueprint $table) {
                // Drop old unique index if exists
                try { $table->dropUnique('ux_cita_medico_fhi'); } catch (Throwable $e) {}

                // Drop FK on medico_id then column
                if (Schema::hasColumn('cita', 'medico_id')) {
                    try { $table->dropForeign(['medico_id']); } catch (Throwable $e) {}
                    $table->dropColumn('medico_id');
                }

                // Add FK to empleado and new unique index
                $table->foreign('empleado_id')->references('id')->on('empleado')->cascadeOnUpdate()->restrictOnDelete();
                $table->unique(['empleado_id', 'fecha_hora_inicio'], 'ux_cita_empleado_fhi');
            });
        }

        // 3) Rename horario_medico -> horario_empleado and column medico_id -> empleado_id
        if (Schema::hasTable('horario_medico')) {
            Schema::rename('horario_medico', 'horario_empleado');
        }

        if (Schema::hasTable('horario_empleado')) {
            Schema::table('horario_empleado', function (Blueprint $table) {
                // Add new column first
                if (!Schema::hasColumn('horario_empleado', 'empleado_id')) {
                    $table->unsignedBigInteger('empleado_id')->nullable()->after('id');
                }
            });

            // Copy data from medico_id to empleado_id
            if (Schema::hasColumn('horario_empleado', 'medico_id') && Schema::hasColumn('horario_empleado', 'empleado_id')) {
                DB::statement('UPDATE horario_empleado SET empleado_id = medico_id');
            }

            Schema::table('horario_empleado', function (Blueprint $table) {
                // Drop old index if present
                try { $table->dropIndex('ix_horario_medico'); } catch (Throwable $e) {}

                // Drop old FK/column
                if (Schema::hasColumn('horario_empleado', 'medico_id')) {
                    try { $table->dropForeign(['medico_id']); } catch (Throwable $e) {}
                    $table->dropColumn('medico_id');
                }

                // Add FK to empleado and new composite index
                $table->foreign('empleado_id')->references('id')->on('empleado')->cascadeOnUpdate()->cascadeOnDelete();
                $table->index(['empleado_id', 'dia_semana', 'hora_inicio'], 'ix_horario_empleado');
            });
        }

        // 4) Replace pivot medico_especialidad -> empleado_especialidad
        if (!Schema::hasTable('empleado_especialidad')) {
            Schema::create('empleado_especialidad', function (Blueprint $table) {
                $table->unsignedBigInteger('empleado_id');
                $table->unsignedBigInteger('especialidad_id');

                $table->primary(['empleado_id', 'especialidad_id']);

                $table->foreign('empleado_id', 'fk_ee_empleado')
                    ->references('id')->on('empleado')
                    ->cascadeOnUpdate()->cascadeOnDelete();

                $table->foreign('especialidad_id', 'fk_ee_especialidad')
                    ->references('id')->on('especialidad')
                    ->cascadeOnUpdate()->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('medico_especialidad')) {
            // Migrate data
            DB::statement('INSERT IGNORE INTO empleado_especialidad (empleado_id, especialidad_id)
                           SELECT medico_id, especialidad_id FROM medico_especialidad');
            // Drop old pivot
            Schema::drop('medico_especialidad');
        }
    }

    public function down(): void
    {
        // Best-effort down migration
        // 1) Restore pivot table
        if (!Schema::hasTable('medico_especialidad') && Schema::hasTable('empleado_especialidad')) {
            Schema::create('medico_especialidad', function (Blueprint $table) {
                $table->unsignedBigInteger('medico_id');
                $table->unsignedBigInteger('especialidad_id');
                $table->primary(['medico_id', 'especialidad_id']);
            });
            DB::statement('INSERT IGNORE INTO medico_especialidad (medico_id, especialidad_id)
                           SELECT empleado_id, especialidad_id FROM empleado_especialidad');
            Schema::drop('empleado_especialidad');
        }

        // 2) Revert horario_empleado
        if (Schema::hasTable('horario_empleado')) {
            Schema::table('horario_empleado', function (Blueprint $table) {
                try { $table->dropIndex('ix_horario_empleado'); } catch (Throwable $e) {}
                if (!Schema::hasColumn('horario_empleado', 'medico_id')) {
                    $table->unsignedBigInteger('medico_id')->nullable();
                }
            });
            if (Schema::hasColumn('horario_empleado', 'empleado_id') && Schema::hasColumn('horario_empleado', 'medico_id')) {
                DB::statement('UPDATE horario_empleado SET medico_id = empleado_id');
            }
            Schema::table('horario_empleado', function (Blueprint $table) {
                try { $table->dropForeign(['empleado_id']); } catch (Throwable $e) {}
                $table->dropColumn('empleado_id');
                $table->index(['medico_id', 'dia_semana', 'hora_inicio'], 'ix_horario_medico');
            });
            Schema::rename('horario_empleado', 'horario_medico');
        }

        // 3) Revert cita.empleado_id -> medico_id
        if (Schema::hasTable('cita')) {
            Schema::table('cita', function (Blueprint $table) {
                try { $table->dropUnique('ux_cita_empleado_fhi'); } catch (Throwable $e) {}
                if (!Schema::hasColumn('cita', 'medico_id')) {
                    $table->unsignedBigInteger('medico_id')->nullable()->after('paciente_id');
                }
            });
            if (Schema::hasColumn('cita', 'empleado_id') && Schema::hasColumn('cita', 'medico_id')) {
                DB::statement('UPDATE cita SET medico_id = empleado_id');
            }
            Schema::table('cita', function (Blueprint $table) {
                try { $table->dropForeign(['empleado_id']); } catch (Throwable $e) {}
                $table->dropColumn('empleado_id');
                $table->unique(['medico_id', 'fecha_hora_inicio'], 'ux_cita_medico_fhi');
            });
        }

        // 4) Rename empleado -> medico
        if (Schema::hasTable('empleado')) {
            Schema::rename('empleado', 'medico');
        }
    }
};

