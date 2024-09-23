<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_public',
        'is_announcement',
        'location',
        'start_time',
        'start_date',
        'end_time',
        'end_date',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function batches()
    {
        return $this->belongsToMany(Batch::class);
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class);
    }
}
