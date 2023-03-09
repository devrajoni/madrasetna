<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ContactMail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($data = null)
    {
        $this->data = (object) $data;
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
            ->subject("New Contact: ")
            ->line(new HtmlString("You got a new contact message.<br /><br />"))
            ->line(new HtmlString("<h3>Name: {$this->data->name}</h3>"))
            ->line(new HtmlString("<h3>Email: {$this->data->email}</h3>"))
            ->line(new HtmlString("<h3>Phone: {$this->data->phone}</h3>"));
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
