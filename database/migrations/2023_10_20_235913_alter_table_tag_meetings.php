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
        Schema::table('tag_meetings', function (Blueprint $table) {
            $table->dropForeign(['tag_id']);
            $table->dropForeign(['meeting_id']);
        });

        Schema::drop('tag_meetings');

        Schema::create('tag_meetings', function (Blueprint $table) {
            $table->id();
            $table->integer('tag_id');
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('meeting_id');
            $table->foreign('meeting_id')
                ->references('id')
                ->on('meetings')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(['tag_id', 'meeting_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tag_meetings', function (Blueprint $table) {
            $table->dropForeign(['tag_id']);
            $table->dropForeign(['meeting_id']);
        });

        Schema::drop('tag_meetings');

        Schema::create('tag_meetings', function (Blueprint $table) {
            $table->id();
            $table->integer('tag_id');
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('meeting_id');
            $table->foreign('meeting_id')
                ->references('id')
                ->on('meetings')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->dropColumn(['id']);
            $table->primary(['tag_id', 'meeting_id'], 'tag_id_meeting_id_primary');
        });
    }
};
