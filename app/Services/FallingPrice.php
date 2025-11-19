<?php
namespace App\Services;

use Illuminate\Support\Number;
use App\Notifications\Telegram;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Support\Helpers;
use Illuminate\Notifications\Notification;

class FallingPrice
{
    public function dropPriceValidation(float $price, float $ticker, $currency) : string
    {
        $percentage = Helpers::calculatePercentage($price, $ticker);
        $ticker     = Number::currency($ticker);

        if ($percentage < -5){
            $this->notify(new Telegram,
                sprintf('Current price: <b>%s</b> price drops below: <b>%s</b>', $ticker, $percentage)
            );
            /*
            DB::table('shopping_list')->where('id', $currency->id)->update([
                'notified' => true,
                'updated_at => Carbon::now(),
            ]);
            */
            sleep(1);
        }

        return $percentage;
    }

    public function notify(Notification $notificator, string $message)
    {
        try {
            return $notificator->send($message);
        }

        catch (\Exception $e){
            return sprintf('Error: %e', $e->getMessage());
        }
    }
}
