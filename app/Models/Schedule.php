<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'starts_at',
        'ends_at',
        'section_id',
        'user_id',
        'subject_id',
        'batch_id',
        'school_year',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function generateWeeklySchedules()
    {
        $startDate = Carbon::parse($this->starts_at);
        $endDate = Carbon::parse($this->school_year . '-12-31'); // Assuming school year ends on December 31

        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            if ($currentDate != $startDate) {
                $this->createWeeklySchedule($currentDate);
            }
            $currentDate->addWeek();
        }
    }

    private function createWeeklySchedule($date)
    {
        $duration = $this->ends_at->diffInSeconds($this->starts_at);

        self::create([
            'starts_at' => $date->setTimeFrom($this->starts_at),
            'ends_at' => $date->copy()->setTimeFrom($this->starts_at)->addSeconds($duration),
            'section_id' => $this->section_id,
            'user_id' => $this->user_id,
            'subject_id' => $this->subject_id,
            'batch_id' => $this->batch_id,
            'school_year' => $this->school_year,
        ]);
    }

    public function hasOverlap()
    {
        return self::where('user_id', $this->user_id)
            ->where('id', '!=', $this->id)
            ->where(function ($query) {
                $query->whereTime('starts_at', '<', $this->ends_at)
                    ->whereTime('ends_at', '>', $this->starts_at);
            })
            ->exists();
    }
}
