<?php

namespace App\Models\Meeting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $meeting_id
 * @property int $specialist_id
 */
class MeetingSpecialist extends Model
{
    use HasFactory;

    protected $table = 'meeting_specialists';
    public $timestamps = false;
}
