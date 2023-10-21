<?php

namespace App\Models\Notice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $ord
 */
class Notice extends Model
{
    use HasFactory;

    protected $table = 'notices';
    public $timestamps = true;
}
