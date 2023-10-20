<?php

namespace App\Models\Tags;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $ord
 *
 * @property TagMeeting[] $tagsMeetings
 * @property TagMeeting[] $meetings
 *
 */
class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';
    public $timestamps = false;

    /**
     * @return HasMany
     */
    public function tagsMeetings()
    {
        return $this->hasMany(TagMeeting::class, 'tag_id');
    }

    /**
     * @return BelongsToMany
     */
    public function meetings()
    {
        return $this->belongsToMany(
            TagMeeting::class,
            'tags_meeting',
            'tag_id',
            'meeting_id'
        );
    }
}
