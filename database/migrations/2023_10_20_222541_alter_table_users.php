<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('email_verified_at');
            $table->dropColumn('password');
            $table->string('firstname');
            $table->string('surname');
            $table->string('patronymic');
            $table->date('birthday');
            $table->integer('profile_id');
            $table->foreign('profile_id')
                ->references('id')
                ->on('spr_profiles')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['profile_id']);
            $table->string('name');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->dropColumn('firstname');
            $table->dropColumn('surname');
            $table->dropColumn('patronymic');
            $table->dropColumn('birthday');
            $table->dropColumn('profile_id');


        });

    }
};
