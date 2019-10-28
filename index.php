<?php
header('Content-Type: text/html; charset=utf-8');
// подрубаем API
require_once("vendor/autoload.php");

$configFile = 'config.json';

//$token = "961713659:AAEY9gRjjPpp9u1LB0pebiFJ30jh3Mjg-2c";
if (file_exists($configFile)) {
    $configData = file_get_contents($configFile);
    $configs = json_decode($configData, true);
    $bot = new \TelegramBot\Api\Client($configs['api-token']);

    if (!file_exists("registered.bot")) {

        /**
         * file registered.trigger will be created after registration
         */
        $pageUrl = "https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        $result = $bot->setWebhook($pageUrl);
        if($result) {
            file_put_contents("registered.bot", time());
        }
    }
}
