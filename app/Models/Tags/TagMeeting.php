<?php

namespace App\Models\Tags;

use App\Models\Meeting\Meeting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $tag_id
 * @property string $meeting_id
 */
class TagMeeting extends Model
{
    use HasFactory;

    protected $table = 'tag_meetings';


    /**
     * @return BelongsTo
     */
    public function meetings()
    {
        return $this->belongsTo(Meeting::class, 'meeting_id');
    }

    /**
     * @return BelongsTo
     */
    public function tags()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}
