<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    // Fillable for mass assignment
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'utype',
        'user_id',
        'last_login_at',
    ];

    // Hidden for serialization
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Boot method to auto-generate user_id
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (!$user->user_id) {
                $user->user_id = self::generateUserId();
            }
        });
    }

    // Generate unique user_id
    public static function generateUserId()
    {
        do {
            $user_id = 'UAC' . rand(10000000, 99999999);
        } while (self::where('user_id', $user_id)->exists());

        return $user_id;
    }
}
