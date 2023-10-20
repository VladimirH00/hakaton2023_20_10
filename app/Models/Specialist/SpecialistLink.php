<?php

namespace App\Models\Specialist;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $path
 * @property int $specialist_id
 * @property int ord
 *
 */
class SpecialistLink extends Model
{
    use HasFactory;

    protected $table = 'specialist_links';
    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function specialist()
    {
        return $this->belongsTo(Specialist::class, 'specialist_id');
    }
}
