<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Builder;

class SectionUser extends Pivot
{
    use HasFactory;

    protected $table = 'section_user';

    protected $fillable = ['section_id', 'student_id', 'teacher_id', 'year'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function scopeCurrentYear(Builder $query): void
    {
        $query->where('year', now()->year);
    }
}
