<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class createProductontify extends Notification
{
    use Queueable;
    public $store;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($store)
    {
        //
        $this->store = $store;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            "user_id" => auth()->user()->id,
            "name" => $this->store['ProductName'],
            "Image" => $this->store['productImage']
        ];
    }
}
