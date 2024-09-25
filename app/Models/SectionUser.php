<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SectionUser extends Pivot
{
    use HasFactory;

    protected $table = 'section_user';

    protected $fillable = ['section_id', 'student_id', 'teacher_id', 'year'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
