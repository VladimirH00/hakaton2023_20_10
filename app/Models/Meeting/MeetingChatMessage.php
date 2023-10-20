<?php

namespace App\Models\Meeting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $content
 * @property int $meeting_id
 * @property int $user_id
 * @property string $created_at
 * @property string $deleted_at
 *
 */
class MeetingChatMessage extends Model
{
    use HasFactory;

    protected $table = 'meeting_chat_messages';

    public function chat()
    {
        return $this->belongsTo(MeetingChat::class, 'meeting_id');
    }
}
