<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailApprovalNotification extends Notification
{
    use Queueable;

    /**
     * @var array $reqattend
     */
    protected $reqattend;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reqattend)
    {
        $this->reqattend = $reqattend;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting($this->reqattend['greeting'])
                    ->line($this->reqattend['body'])
                    ->action($this->reqattend['actionText'], $this->reqattend['actionURL'])
                    ->line($this->reqattend['thanks']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

