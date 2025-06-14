<?php

function callOpenAI($prompt) {
    $apiKey = 'PUT YOUR OWN API KEY HERE';
    $url = 'https://openrouter.ai/api/v1/chat/completions';

    $data = [
        'model' => 'openai/gpt-3.5-turbo',
        'messages' => [
            ['role' => 'user', 'content' => $prompt]
        ],
    ];

    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey,
        'HTTP-Referer: http://localhost/projet-assistant-rh',  // Obligatoire pour OpenRouter
        'X-Title: Assistant RH IA'
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);
    return $result['choices'][0]['message']['content'] ?? json_encode($result);
}
