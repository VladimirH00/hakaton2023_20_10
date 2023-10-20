<?php

namespace App\Models\Calendar;

use App\Models\Meeting\Meeting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $meeting_id
 * @property string $date_begin
 * @property string $duration
 *
 * @property Meeting[] $meetings
 *
 */
class Calendar extends Model
{
    use HasFactory;

    protected $table = 'calendar';
    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function meetings()
    {
        return $this->belongsTo(Meeting::class, 'meeting_id');
    }
}
