<?php

namespace App\Models\Spr;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $code
 *
 */
class SprProfile extends Model
{
    use HasFactory;

    protected $table = 'spr_profiles';
    public $timestamps = false;
}
