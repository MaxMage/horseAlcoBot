<?php

header('Content-Type: text/html; charset=utf-8');

require_once("vendor/autoload.php");

$configFile = 'config.json';

if (file_exists($configFile)) {
    $configData = file_get_contents($configFile);
    $configs = json_decode($configData, true);
    $bot = new \TelegramBot\Api\Client($configs['api-token']);

    if (!file_exists("registered.bot")) {

        /**
         * file registered.trigger will be created after registration
         */
        $pageUrl = $configs['url'];
        $result = $bot->setWebhook($pageUrl);
        if($result) {
            file_put_contents("registered.bot", time());
        }
    }

    // Mandatory start bot command
    $bot->command('start', function ($message) use ($bot) {
        $answer = "Let's  go drink";
        $bot->sendMessage($message->getChat()->getId(), $answer);
    });

    // help, Mandatory also
    $bot->command('help', function ($message) use ($bot) {
        $answer = "Commands:
            /help - it's not help in morning";
        $bot->sendMessage($message->getChat()->getId(), $answer);
    });

    // run bot
    $bot->run();
}
