<?php

use Thojou\OpenAi\OpenAi;

$API_KEY = $argv[1];

require_once __DIR__ . '/../vendor/autoload.php';

$inputs = [
    'I went to the store.',
    'I went to the park.',
    'I love bananas.',
];

$openAi = new OpenAi($API_KEY);
$result = $openAi->embeddings()->embedding([
    'model' => 'text-embedding-ada-002',
    'input' => $inputs
]);

echo json_encode($result, JSON_PRETTY_PRINT) . "\n";

