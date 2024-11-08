<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AchievementUnlocked extends Notification
{
    use Queueable;

    public $achievement;

    /**
     * Create a new notification instance.
     */
    public function __construct($achievement)
    {
        $this->achievement = $achievement;
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
            ->line("Congratulations! You've unlocked a new achievement: {$this->achievement->name}.")
            ->action('View Achievement', url('/achievements'))
            ->line('Keep up the great work!');
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
            'achievement_name' => $this->achievement->name,
        ];
    }
}
