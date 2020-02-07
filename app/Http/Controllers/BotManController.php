<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\LaravelCache;
use BotMan\BotMan\Messages\Incoming\Answer;

class BotManController extends Controller
{
    public function handle()
    {
        $config = [
            'matchingData' => [
                'driver' => 'web',
            ],
        ];

        $cache = new LaravelCache();

        $botman = BotManFactory::create($config, $cache);

        $botman->hears('{message}', function (BotMan $botman, $message) {
            if ($message == 'hi') {
                $this->askName($botman);
            } else {
                $botman->reply("write 'hi' for testing...");
            }
        });

        $botman->listen();
    }

    public function askName(BotMan $botman)
    {
        $botman->ask('Hello! What is your Name?', function (Answer $answer) {
            $name = $answer->getText();

            $this->say('Nice to meet you '.$name);
        });
    }
}
