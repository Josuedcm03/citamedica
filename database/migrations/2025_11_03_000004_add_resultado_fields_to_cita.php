<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('cita')) {
            Schema::table('cita', function (Blueprint $table) {
                if (!Schema::hasColumn('cita', 'resultado')) {
                    $table->text('resultado')->nullable()->after('notas');
                }
                if (!Schema::hasColumn('cita', 'resultado_publicado_at')) {
                    $table->timestamp('resultado_publicado_at')->nullable()->after('resultado');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('cita')) {
            Schema::table('cita', function (Blueprint $table) {
                if (Schema::hasColumn('cita', 'resultado_publicado_at')) {
                    $table->dropColumn('resultado_publicado_at');
                }
                if (Schema::hasColumn('cita', 'resultado')) {
                    $table->dropColumn('resultado');
                }
            });
        }
    }
};

