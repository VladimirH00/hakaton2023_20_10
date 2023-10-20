<?php

namespace App\Models\Specialist;

use App\Models\Meeting\Meeting;
use App\Models\Meeting\MeetingSpecialist;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property int $description
 *
 * @property Meeting[] $meetings
 * @property SpecialistLink[] $specialistLink
 *
 */
class Specialist extends Model
{
    use HasFactory;

    protected $table = 'specialists';
    public $timestamps = false;

    /**
     * @return BelongsToMany
     */
    public function meetings()
    {
        return $this->belongsToMany(
            MeetingSpecialist::class,
            'meeting_specialist',
            'meeting_id',
            'specialist_id'
        );
    }

    /**
     * @return HasMany
     */
    public function specialistLink()
    {
        return $this->hasMany(SpecialistLink::class, 'specialist_id');
    }
}
