<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * This function checks if the user is online.
     * If the user has been active in the last 5 minutes, it will return true.
     * 
     * @return bool
     */
    public function isOnline(): bool
    {
        return cache()->has('last-user-activity-' . $this->id) && now()->diffInSeconds(cache()->get('last-user-activity-' . $this->id)) < 300;
    }

    /**
     * This function sets the user as online in the cache.
     * It stores the current timestamp with a key that includes the user's ID.
     */
    public function setOnline()
    {
        cache()->put('last-user-activity-' . $this->id, now(), 300);
    }

    /**
     * This function returns an array of the user's permissions.
     *
     * @return array
     */
    public function getPermissions(): array
    {
        return json_decode($this->permissions, true);
    }

    /**
     * This function checks if the user is an admin.
     * 
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}