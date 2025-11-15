<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        $wallets = [
            'uno'    => 1,
            'dos'    => 2,
            'tres'   => 3,
            'cuatro' => 4,
            'cinco'  => 5,
        ];

        foreach ($wallets as $key => $value) {
            echo $key .PHP_EOL;
        }
    }
}
