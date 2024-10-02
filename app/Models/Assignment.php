<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'title',
        'description',
        'due_date',
        'status',
        'section_id', // Add this line if not already present
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function getStatusAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
