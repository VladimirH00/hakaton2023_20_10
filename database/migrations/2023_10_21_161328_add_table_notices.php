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
        Schema::table('notices', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->timestampsTz();
        });

        Schema::table('notice_users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('notice_id');
            $table->foreign('notice_id')
                ->references('id')
                ->on('notices')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->boolean('is_checked');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notice_users', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['notice_id']);
        });

        Schema::dropIfExists('notices');
        Schema::dropIfExists('notice_users');
    }
};
