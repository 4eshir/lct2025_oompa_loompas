<?php

namespace app\services;

use app\requests\SendMessageResponse;

class DevelopmentBot
{
    private const API_KEY = '8391807798:AAGEmIm4hL0rFhyoWtQskkZ3_jzujgUktvI';
    private const BOT_ID = '-4839121793';

    public function sendMessage(string $text, array $keyboard = []): SendMessageResponse
    {
        $getQuery = array(
            "chat_id" 	=> self::BOT_ID,
            "text"  	=> $text,
            "parse_mode" => "html",
        );

        $keyboard = json_encode(array(
            'keyboard' => $keyboard,
            'one_time_keyboard' => TRUE,
            'resize_keyboard' => TRUE,
        ));

        $ch = curl_init("https://api.telegram.org/bot". self::API_KEY ."/sendMessage?" . http_build_query($getQuery) . "&reply_markup=" . $keyboard);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);

        $resultQuery = curl_exec($ch);
        curl_close($ch);

        return new SendMessageResponse($resultQuery);
    }
}