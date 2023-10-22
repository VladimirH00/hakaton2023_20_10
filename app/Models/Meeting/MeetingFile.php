<?php

namespace App\Models\Meeting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $file_path
 * @property int $meeting_id
 * @property int $size
 * @property string $created_at
 * @property string $deleted_at
 *
 * @property Meeting $meeting
 *
 */
class MeetingFile extends Model
{
    use HasFactory;

    protected $table = 'meeting_files';

    /**
     * @return BelongsTo
     */
    public function meeting()
    {
        return $this->belongsTo(MeetingFile::class, 'meeting_id');
    }
}
