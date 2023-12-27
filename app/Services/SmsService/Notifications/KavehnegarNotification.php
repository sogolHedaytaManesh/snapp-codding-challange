<?php

namespace App\Services\SmsService\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Kavenegar\Laravel\Message\KavenegarMessage;
use Kavenegar\Laravel\Notification\KavenegarBaseNotification;

class KavehnegarNotification extends KavenegarBaseNotification implements ShouldQueue
{
    use Queueable;

    protected  string $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function toKavenegar($notifiable)
    {
        return (new KavenegarMessage($this->data))
            ->from(env('PROVIDER_SENDER_NUMBER'))
            ->to($notifiable);
    }
}
