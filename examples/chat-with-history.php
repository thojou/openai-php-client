<?php

declare(strict_types=1);

/*
 * This file is part of OpenAi PHP Client.
 *
 * (c) Thomas Joußen <tjoussen91@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Thojou\OpenAi\OpenAi;

$API_KEY = $argv[1];

require_once __DIR__ . '/../vendor/autoload.php';

$messages = [
    [ 'role' => 'system', 'content' => 'You are an expert in answering simple math problems'],
    [ 'role' => 'user', 'content' => 'What is 4 + 6?']
];

$openAi = new OpenAi($API_KEY);
$result = $openAi->chat()->completion([
    'model' => 'gpt-3.5-turbo',
    'messages' => $messages
]);

echo json_encode($result, JSON_PRETTY_PRINT) . "\n";

// Add answer and new message to $message array
$messages = [
    [ 'role' => 'assistant', 'content' => $result['choices'][0]['message']['content']],
    [ 'role' => 'user', 'content' => 'Reduce by 5']
];

$result = $openAi->chat()->completion([
    'model' => 'gpt-3.5-turbo',
    'messages' => $messages
]);

echo json_encode($result, JSON_PRETTY_PRINT) . "\n";
