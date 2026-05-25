<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'event_date',
        'location',
        'image_path',
        'max_participants',
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attendees()
    {
        return $this->belongsToMany(User::class)->withPivot('status')->withTimestamps();
    }
}
