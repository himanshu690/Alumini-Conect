<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class MentorshipRelation extends Model
{
    use HasFactory;

    protected $table = 'mentorship_relations';

    protected $fillable = [
        'mentor_id',
        'mentee_id',
        'status',
        'message',
    ];

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function mentee()
    {
        return $this->belongsTo(User::class, 'mentee_id');
    }
}
