<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property string $expires_at
 * @property string $created_at
 * @property string $deleted_at
 *
 * @property User $user
 *
 */
class UserAuth extends Model
{
    use HasFactory;

    protected $table = 'user_auths';

    /**
     * @return void
     */
    public function user()
    {
        $this->belongsTo(User::class, 'user_id');
    }
}
