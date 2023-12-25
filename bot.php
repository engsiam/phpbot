<?php

use Discord\Discord;

require_once('./vendor/autoload.php');
require_once('./key.php');

$key = getKey();
$discord = new Discord(['token' => $key]);

$discord->on('ready', function (Discord $discord) {
    echo "bot is ready" . PHP_EOL;

    $discord->on('message', function ($message) {
        $content = $message->content;

        // Compare message content case-insensitively
        if (strtolower($content) === '!joke') {
            // API link
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://official-joke-api.appspot.com/random_joke');
            $joke = json_decode($response->getBody());
            $joke = $joke->setup;
            $message->reply($joke);
        }
    });
});

$discord->run();