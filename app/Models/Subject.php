<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
    ];

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->where('role_id', 2);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function gradingComponents()
    {
        return $this->hasMany(GradeComponent::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
