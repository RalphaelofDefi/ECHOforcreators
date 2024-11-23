<?php
namespace EchoBot;

use PDO;

class Database {
    private $pdo;

    public function __construct($config) {
        $dsn = "mysql:host={$config['host']};dbname={$config['name']}";
        $this->pdo = new PDO($dsn, $config['user'], $config['password']);
    }

    public function saveOAuthToken($chatId, $platform, $token) {
        $stmt = $this->pdo->prepare("INSERT INTO tokens (chat_id, platform, token) VALUES (?, ?, ?)");
        $stmt->execute([$chatId, $platform, $token]);
    }

    public function getOAuthToken($chatId, $platform) {
        $stmt = $this->pdo->prepare("SELECT token FROM tokens WHERE chat_id = ? AND platform = ?");
        $stmt->execute([$chatId, $platform]);
        return $stmt->fetchColumn();
    }
}
