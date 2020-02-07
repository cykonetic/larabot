<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;

class BotManController extends Controller
{
    public function handle()
    {
        $botman = app('botman');

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