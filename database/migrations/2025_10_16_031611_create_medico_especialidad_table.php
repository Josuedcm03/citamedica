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
        Schema::create('empleado_especialidad', function (Blueprint $table) {
            $table->unsignedBigInteger('empleado_id');
            $table->unsignedBigInteger('especialidad_id');

            $table->primary(['empleado_id', 'especialidad_id']);

            $table->foreign('empleado_id', 'fk_me_empleado')
                ->references('id')->on('empleado')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreign('especialidad_id', 'fk_me_especialidad')
                ->references('id')->on('especialidad')
                ->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleado_especialidad');
    }
};
