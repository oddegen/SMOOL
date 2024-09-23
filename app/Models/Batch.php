<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class)->withPivot('year');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
