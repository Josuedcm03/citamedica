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
        Schema::create('consultorio', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('ubicacion', 120)->nullable();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove FKs that still point to consultorio before dropping the table
        $database = Schema::getConnection()->getDatabaseName();

        foreach (['horario_empleado', 'horario_medico'] as $tableName) {
            if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, 'consultorio_id')) {
                $constraints = DB::select(
                    "SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE
                     WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND COLUMN_NAME = 'consultorio_id'
                     AND REFERENCED_TABLE_NAME = 'consultorio'",
                    [$database, $tableName]
                );

                foreach ($constraints as $constraint) {
                    $constraintName = $constraint->CONSTRAINT_NAME ?? null;
                    if ($constraintName) {
                        try { DB::statement("ALTER TABLE {$tableName} DROP FOREIGN KEY {$constraintName}"); } catch (\Throwable $e) {}
                    }
                }
            }
        }

        Schema::dropIfExists('consultorio');
    }
};
