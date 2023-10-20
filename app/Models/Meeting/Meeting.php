<?php

namespace App\Models\Meeting;

use App\Models\Calendar\Calendar;
use App\Models\Tags\Tag;
use App\Models\Tags\TagMeeting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $meeting_id
 * @property int $date_begin
 * @property int $duration
 *
 * @property Calendar[] $calendars
 * @property Tag[] $tags
 */
class Meeting extends Model
{
    use HasFactory;

    protected $table = 'meetings';
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function calendars()
    {
        return $this->hasMany(Calendar::class, 'meeting_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(TagMeeting::class, 'tags_meeting', 'meeting_id', 'tag_id');
    }

    /**
     * @return HasOne
     */
    public function meetingChat()
    {
        return $this->hasOne(MeetingChat::class, 'meeting_id');
    }
}
