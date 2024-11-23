<?php
require_once '../vendor/autoload.php';
require_once '../src/Bot.php';

use EchoBot\Bot;

// Get environment variables
$telegramToken = getenv('TELEGRAM_TOKEN');

// Create bot instance and process updates
$bot = new Bot($telegramToken);
$bot->handle();
