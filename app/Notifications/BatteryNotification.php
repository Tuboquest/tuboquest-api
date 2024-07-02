<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BatteryNotification extends Notification
{
    use Queueable;

    protected $batteryLvL;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct($batteryLvL)
    {
        $this->batteryLvL = $batteryLvL;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }
}
