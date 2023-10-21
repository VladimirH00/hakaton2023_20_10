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
        Schema::table('user_auths', function (Blueprint $table) {
            $table->timestampTz('updated_at')->nullable();
            $table->dropColumn('deleted_at')->nullable();
        });

        Schema::table('user_auths', function (Blueprint $table) {
            $table->timestampTz('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_auths', function (Blueprint $table) {
            $table->dropColumn('updated_at');
        });

        Schema::table('user_auths', function (Blueprint $table) {
            $table->timestampTz('deleted_at');
        });
    }
};
