<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
     use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'location',
        'banner_image',
    ];

    /**
     * An event can have many users (registered for it).
     */
    public function users()
    {
        // By default, Laravel assumes the pivot table name 'event_user'
        // and foreign keys 'event_id' and 'user_id'.
        // If you named them differently, you would pass them as arguments here.
        return $this->belongsToMany(User::class);
    }
}
