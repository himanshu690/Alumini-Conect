<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function alumniProfile()
    {
        return $this->hasOne(AlumniProfile::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function rsvpEvents()
    {
        return $this->belongsToMany(Event::class)->withPivot('status')->withTimestamps();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function mentorshipsAsMentor()
    {
        return $this->hasMany(MentorshipRelation::class, 'mentor_id');
    }

    public function mentorshipsAsMentee()
    {
        return $this->hasMany(MentorshipRelation::class, 'mentee_id');
    }
}
