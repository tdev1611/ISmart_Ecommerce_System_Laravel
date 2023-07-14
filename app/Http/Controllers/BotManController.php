<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BotManController extends Controller
{
    //
    public function handle()
{
    $botman = app('botman');

    $botman->hears('hello', function ($bot) {
        $bot->reply('Hello! How can I assist you?');
    });

    $botman->listen();
}

}
