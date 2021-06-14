<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RemindNotification extends Notification
{
    use Queueable;

    protected $item;
    protected $shop;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($item, $shop)
    {
        $this->item = $item;
        $this->shop = $shop;
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
                    ->subject('予約リマインド通知')
                    ->line($notifiable->name . "様")
                    ->line("店名：" . $this->shop->name)
                    ->line("来店日時：" . $this->item->visited_on)
                    ->line("来店人数：" . $this->item->number_of_visiters)
                    ->action('Reseへログイン', url('http://localhost:8080/login'))
                    ->salutation('Rese運営より');
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
