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
        Schema::create('medico_especialidad', function (Blueprint $table) {
            $table->unsignedBigInteger('medico_id');
            $table->unsignedBigInteger('especialidad_id');

            $table->primary(['medico_id', 'especialidad_id']);

            $table->foreign('medico_id', 'fk_me_medico')
                ->references('id')->on('medico')
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
        Schema::dropIfExists('medico_especialidad');
    }
};
