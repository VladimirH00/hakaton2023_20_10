<?php

namespace App\Models\Meeting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $meeting_id
 *
 * @property MeetingChatMessage[] $messages
 * @property Meeting $meeting
 */
class MeetingChat extends Model
{
    use HasFactory;

    protected $table = 'meeting_chats';
    public $timestamps = false;

    /**
     * @return HasMany
     */
    public function messages()
    {
        return $this->hasMany(MeetingChatMessage::class);
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class, 'meeting_id');
    }
}
