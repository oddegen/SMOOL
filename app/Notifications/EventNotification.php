<?php

namespace App\Notifications;

use App\Models\Event;
use App\Settings\SchoolSettings;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class EventNotification extends Notification
{
    use Queueable, SerializesModels;

    protected $event;

    /**
     * Create a new notification instance.
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->from(app(SchoolSettings::class)->email, app(SchoolSettings::class)->name)
            ->greeting('Hello ' . $notifiable->name)
            ->subject('Event Notification')
            ->line('There is a new event.')
            ->line('Event Name: ' . $this->event->title)
            ->action('View Event', route('filament.admin.resources.events.view', $this->event))
            ->line('Thank you for using our application.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
