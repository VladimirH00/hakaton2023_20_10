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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('code', 255);
            $table->integer('ord');
        });

        Schema::create('specialists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
        });

        Schema::create('meeting_specialists', function (Blueprint $table) {
            $table->id();
            $table->integer('meeting_id');
            $table->foreign('meeting_id')
                ->references('id')
                ->on('meetings')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('specialist_id');
            $table->foreign('specialist_id')
                ->references('id')
                ->on('specialists')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });



        Schema::create('specialist_links', function (Blueprint $table) {
            $table->id();
            $table->string('path', 512);
            $table->integer('specialist_id');
            $table->foreign('specialist_id')
                ->references('id')
                ->on('specialists')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('ord');
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('code', 255);
            $table->integer('ord');
        });

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


        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->integer('meeting_id');
            $table->foreign('meeting_id')
                ->references('id')
                ->on('meetings')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamp('date_begin');
            $table->timestamp('duration');
        });

        Schema::create('meeting_files', function (Blueprint $table) {
            $table->id();
            $table->string('file_path', 512);
            $table->integer('meeting_id');
            $table->foreign('meeting_id')
                ->references('id')
                ->on('meetings')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('size');
            $table->timestampTz('created_at');
            $table->timestampTz('deleted_at');
        });

        Schema::create('meeting_chats', function (Blueprint $table) {
            $table->id();
            $table->integer('meeting_id');
            $table->foreign('meeting_id')
                ->references('id')
                ->on('meetings')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('meeting_chat_messages', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->integer('meeting_chat_id');
            $table->foreign('meeting_chat_id')
                ->references('id')
                ->on('meeting_chats')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestampTz('created_at');
            $table->timestampTz('deleted_at');
        });

        Schema::create('spr_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('code', 255);
            $table->integer('ord');
        });

        Schema::create('user_auths', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('token', 512);
            $table->timestampTz('expires_at');
            $table->timestampTz('created_at');
            $table->timestampTz('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meeting_specialists', function (Blueprint $table) {
            $table->dropForeign(['meeting_id']);
            $table->dropForeign(['specialist_id']);
        });
        Schema::table('specialist_links', function (Blueprint $table) {
            $table->dropForeign(['specialist_id']);
        });
        Schema::table('tag_meetings', function (Blueprint $table) {
            $table->dropForeign(['tag_id']);
            $table->dropForeign(['meeting_id']);
        });
        Schema::table('calendars', function (Blueprint $table) {
            $table->dropForeign(['meeting_id']);
        });
        Schema::table('meeting_files', function (Blueprint $table) {
            $table->dropForeign(['meeting_id']);
        });

        Schema::table('meeting_chats', function (Blueprint $table) {
            $table->dropForeign(['meeting_id']);
        });

        Schema::table('meeting_chat_messages', function (Blueprint $table) {
            $table->dropForeign(['meeting_chat_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('user_auths', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('meetings');
        Schema::dropIfExists('specialists');
        Schema::dropIfExists('meeting_specialists');
        Schema::dropIfExists('specialist_links');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('tag_meetings');
        Schema::dropIfExists('calendars');
        Schema::dropIfExists('meeting_files');
        Schema::dropIfExists('meeting_chats');
        Schema::dropIfExists('meeting_chat_messages');
        Schema::dropIfExists('spr_profiles');
        Schema::dropIfExists('user_auths');
    }
};
