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

$openAi = new OpenAi($API_KEY);
$result = $openAi->images()->variation([
    "image" => fopen(__DIR__ . '/assets/dog.png', 'rb'),
    'size' => '256x256',
    'n' => 1
]);

echo json_encode($result, JSON_PRETTY_PRINT) . "\n";
