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
            $table->integer('type_id');
            $table->foreign('type_id')
                ->references('id')
                ->on('specialist_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('specialist_types', function (Blueprint $table){
            $table->id();
            $table->string('name', 255);
            $table->string('icon_path', 255);
            $table->string('color', 25);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('specialists', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
            $table->dropColumn('type_id');
        });

        Schema::dropIfExists('specialist_types');
    }
};
