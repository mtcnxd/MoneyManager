<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Services\FallingPrice;
use App\Http\Controllers\BitsoController as Bitso;

class FallingPriceNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify-falling-price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(FallingPrice $fallingPrice)
    {
        $results = DB::table('shopping_list')
            ->where('status','Active')
            ->where('notified', false)
            ->get();

        $bitso  = new Bitso();
        $ticker = $bitso->getTicker();

        foreach ($results as $currency){
            $book = $currency->book;

            $result = array_filter($ticker, function($object) use ($book){
                return $object->book === $book;
            });

            $lastTickerPrice = array_values($result)[0]->last;

            $validated = $fallingPrice->dropPriceValidation($currency->price, $lastTickerPrice, $currency);

            echo sprintf('Current lost: %s => %s'.PHP_EOL, $book, $validated);
        }
    }
}
