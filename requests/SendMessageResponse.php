<?php

namespace app\requests;

use InvalidArgumentException;

class SendMessageResponse
{
    public bool $ok;

    public int $messageId;

    // Блок from
    public int $fromId;
    public bool $fromIsBot;
    public string $fromFirstname;
    public string $fromUsername;

    // Блок chat
    public int $chatId;
    public string $chatTitle;

    public string $date;
    public string $text;

    public function __construct(string $jsonResponse)
    {
        $data = json_decode($jsonResponse, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException('Invalid JSON response');
        }

        $this->ok = $data['ok'];
        $this->messageId = $data['result']['message_id'];

        $this->fromId = $data['result']['from']['id'];
        $this->fromIsBot = $data['result']['from']['is_bot'];
        $this->fromFirstname = $data['result']['from']['first_name'];
        $this->fromUsername = $data['result']['from']['username'];

        $this->chatId = $data['result']['chat']['id'];
        $this->chatTitle = $data['result']['chat']['title'];

        $this->date = (string)$data['result']['date'];
        $this->text = $data['result']['text'];
    }
}