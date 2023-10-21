<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Meeting\MeetingChatMessage;
use App\Models\Spr\SprProfile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Symfony\Component\HttpKernel\Profiler\Profile;

/**
 * @property int $id
 * @property string $firstname
 * @property string $surname
 * @property string $patronymic
 * @property string $birthday
 * @property string $email
 * @property int $profile_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $google_secret_key
 *
 * @property SprProfile $profile
 * @property UserAuth[] $tokens
 * @property MeetingChatMessage[] $messages
 *
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



}
