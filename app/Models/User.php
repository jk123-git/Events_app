<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // For API tokens (used by Breeze for Sanctum)
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    // use HasFactory, Notifiable;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
     * Check if the user has a specific role.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role)
    {
        return $this->role === $role;
    }

    /**
     * Check if the user is an admin (convenience method).
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * Check if the user is a regular user (convenience method).
     *
     * @return bool
     */
    public function isUser()
    {
        return $this->hasRole('user');
    }
     /**
     * A user can register for many events.
     */
    public function events()
    {
        // By default, Laravel assumes the pivot table name 'event_user'
        // and foreign keys 'event_id' and 'user_id'.
        // return $this->belongsToMany(Event::class);
        return $this->belongsToMany(Event::class, 'event_user')->withTimestamps();
    }
}
