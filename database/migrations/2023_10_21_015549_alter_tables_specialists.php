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
        Schema::table('specialists', function (Blueprint $table) {
            $table->dropColumn('description');
        });

        Schema::table('specialists', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->string('code', 255);
        });

        Schema::table('specialist_links', function (Blueprint $table) {
            $table->dropColumn('ord');
        });

        Schema::table('specialist_links', function (Blueprint $table) {
            $table->integer('ord')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('specialists', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('code');
        });

        Schema::table('specialists', function (Blueprint $table) {
            $table->text('description');
        });

        Schema::table('specialist_links', function (Blueprint $table) {
            $table->dropColumn('ord');
        });

        Schema::table('specialist_links', function (Blueprint $table) {
            $table->integer('ord');
        });
    }
};
