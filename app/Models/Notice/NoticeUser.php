<?php

namespace App\Models\Notice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 * @property int $user_id
 * @property int $notice_id
 */
class NoticeUser extends Model
{
    use HasFactory;
}
