<?php

namespace App\Jobs;

use App\Models\Event;
use App\Models\User;
use App\Notifications\EventNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;

class SendEventEmailToStudents implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function handle()
    {
        try {
            $students = User::whereHas('role', function ($query) {
                $query->where('name', 'Student');
            })
                ->whereHas('sectionUsers', function ($query) {
                    $query->whereIn('section_id', $this->event->sections->pluck('id'))
                        ->where('year', now()->year);
                })
                ->chunk(100, function ($students) {
                    foreach ($students as $student) {
                        $student->notify(new EventNotification($this->event));
                    }
                });

            Log::info('Event notification sent successfully', ['event_id' => $this->event->id]);
        } catch (\Exception $e) {
            Log::error('Failed to send event notification', [
                'event_id' => $this->event->id,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}
