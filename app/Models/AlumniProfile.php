<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class AlumniProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'graduation_year',
        'major',
        'current_job_title',
        'current_company',
        'skills',
        'bio',
        'is_mentor',
        'linkedin_url',
    ];

    protected $casts = [
        'is_mentor' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
