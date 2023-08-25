<?php

use Thojou\OpenAi\OpenAi;

$API_KEY = $argv[1];

require_once __DIR__ . '/../vendor/autoload.php';

$openAi = new OpenAi($API_KEY);
$result = $openAi->images()->edit([
    "image" => fopen(__DIR__ . '/assets/dog.png', 'rb'),
    "mask" => fopen(__DIR__ . '/assets/dog_mask.png', 'rb'),
    'prompt' => 'A dog inside a basket with a human family portrait in the background.',
    'size' => '256x256',
    'n' => 1
]);

echo json_encode($result, JSON_PRETTY_PRINT) . "\n";
