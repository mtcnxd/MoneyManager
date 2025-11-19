<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Telegram extends Notification
{
    use Queueable;

    protected $api = null;
    protected $chatId = null;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->api    = config('services.telegram.api');
        $this->chatId = config('services.telegram.chat_id');
    }

    public function send(string $message) : void
    {
        dd(self::$chatId);
    }
}
