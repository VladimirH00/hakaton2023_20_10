<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $profiles = [
        ['name' => 'Модератор', 'code' => 'moderator', 'ord' => 1],
        ['name' => 'Обычный пользователь', 'code' => 'user', 'ord' => 2],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('spr_profiles')->insert($this->profiles);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::delete(<<<SQL
delete from spr_profiles
where code = 'moderator' or code = 'user'
SQL
        );
    }
};
