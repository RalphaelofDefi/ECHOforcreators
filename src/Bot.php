<?php
namespace EchoBot;

use Telegram\Bot\Api;

class Bot {
    private $telegram;

    public function __construct($token) {
        $this->telegram = new Api($token);
    }

    public function handle() {
        $update = $this->telegram->getWebhookUpdate();
        $chatId = $update['message']['chat']['id'];
        $text = $update['message']['text'];

        switch ($text) {
            case '/start':
                $this->sendMessage($chatId, "Welcome to Echo! Use /register to link your social media accounts.");
                break;

            case '/register':
                $this->sendOAuthLinks($chatId);
                break;

            case '/post':
                $this->sendMessage($chatId, "Which platform would you like to post to?");
                break;

            default:
                $this->sendMessage($chatId, "Unknown command. Use /help for a list of commands.");
                break;
        }
    }

    private function sendMessage($chatId, $text) {
        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $text,
        ]);
    }

    private function sendOAuthLinks($chatId) {
        $text = "Authenticate your accounts:\n" .
                "1. [Facebook](https://your-auth-link.com/facebook)\n" . //get auuth link and replace
                "2. [Twitter](https://your-auth-link.com/twitter)";
        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'Markdown',
        ]);
    }
}
