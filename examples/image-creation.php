<?php

use Thojou\OpenAi\OpenAi;

$API_KEY = $argv[1];

require_once __DIR__ . '/../vendor/autoload.php';

$openAi = new OpenAi($API_KEY);
$result = $openAi->images()->generation([
    'prompt' => 'An image of a real forest in the morning',
    'size' => '256x256',
]);

echo "Image: {$result['data'][0]['url']}\n";
