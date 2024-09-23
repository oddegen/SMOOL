<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function batches()
    {
        return $this->belongsToMany(Batch::class)->withPivot('year');
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
