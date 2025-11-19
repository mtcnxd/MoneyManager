<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ShoppingBook;
use App\Http\Controllers\BitsoController as Bitso;

class HelloWorld extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:hello-world';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bitso = new Bitso();
        echo 'Connecting';

        for ($i=0; $i<=5; $i++) {
            echo '.';
            sleep(1);
        }

        echo PHP_EOL;

        $ticker = $bitso->getTicker();

        echo ShoppingBook::orderBy('id', 'desc')->first()->price;
    }
}
