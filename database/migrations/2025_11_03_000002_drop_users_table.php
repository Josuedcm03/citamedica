<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            Schema::drop('users');
        }
        // Optionally drop related tokens/resets if present
        if (Schema::hasTable('password_reset_tokens')) {
            Schema::drop('password_reset_tokens');
        }
        if (Schema::hasTable('sessions')) {
            // Some apps use sessions table
            // We leave it intact as it's not strictly the users table
        }
    }

    public function down(): void
    {
        // Not recreating the full default users table intentionally
    }
};

