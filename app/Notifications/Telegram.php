<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Telegram extends Notification
{
    use Queueable;

    static function send(string $text)
    {
        $token = 'bot8373335422:AAHcXOLPxVUZHMg5gQW1Zb_FZ7itqeuIm6I';

        $url = 'https://api.telegram.org/'. $token .'/sendMessage';
        
        $response = Http::post($url, array(
            "chat_id"    => '-5014845636',
            "text" 	     => $text,
            "parse_mode" => "HTML"
        ));

        if ($response->getStatusCode() == 400){
            throw new \Exception(
                sprintf("Error Processing Request: %s", $response['description'])
            );
        }
    }
}
