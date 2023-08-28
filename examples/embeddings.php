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
