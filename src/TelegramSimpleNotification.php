<?php


namespace kirillreutski\TelegramSimpleNotifier; 

class TelegramSimpleNotification {
    public static string $botHash; 
    public static string $chatId; 
    public static function sendMessage($message, $botHash = null, $chatId = null){

        if ($botHash == null) $botHash = static::$botHash;
        if ($chatId == null) $chatId = static::$chatId;

        if ($botHash == null) throw new \Exception('$botHash is not defined!');
        if ($chatId == null) throw new \Exception('$chatId is not defined!');

        $message = str_replace('<br>', "\r\n", $message);
        $url = "https://api.telegram.org/bot" . $botHash . "/sendMessage?chat_id=" . $chatId . "&parse_mode=html&disable_web_page_preview=true";
        $url = $url . "&text=" . urlencode($message);

        return static::sendGetRequest($url, [
            'botHash' => $botHash, 
            'chatId' => $chatId, 
            'message' => $message, 
        ]);
    }

    public static function sendGetRequest($url, $data = []){
        return file_get_contents($url);
    }
}