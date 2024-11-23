<?php
namespace EchoBot;

class SocialMedia {
    public function postToFacebook($accessToken, $message) {
        // Use Facebook Graph API to post
        $url = "https://graph.facebook.com/me/feed";
        $params = [
            'message' => $message,
            'access_token' => $accessToken,
        ];
        return $this->makeRequest($url, $params);
    }

    public function postToTwitter($accessToken, $message) {
        // Use Twitter API to post
        // Implement your logic here
    }

    private function makeRequest($url, $params) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}
