<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BadgeUnlocked extends Notification
{
    use Queueable;

    public $badge;

    /**
     * Create a new notification instance.
     */
    public function __construct($badge)
    {
        $this->badge = $badge;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->line("Congratulations! You've earned a new badge: {$this->badge->name}.")
            ->action('View Badge', url('/badges'))
            ->line('Keep striving for more achievements!');
    }

    /**
     * Get the array representation of the notification for storage in the database.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'badge_name' => $this->badge->name,
        ];
    }
}
