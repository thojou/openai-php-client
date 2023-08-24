<?php

use Thojou\OpenAi\OpenAi;

$API_KEY = $argv[1];

require_once __DIR__ . '/../vendor/autoload.php';

$file = fopen('https://cdn.openai.com/whisper/draft-20220920a/multilingual.wav', 'rb');

$openAi = new OpenAi($API_KEY);
$result = $openAi->audio()->translation([
    'model' => 'whisper-1',
    'file' => $file
]);

echo $result['text'] . "\n";
