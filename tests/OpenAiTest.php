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

namespace Thojou\OpenAi\Tests;

use PHPUnit\Framework\TestCase;
use Thojou\OpenAi\Endpoint\Audio;
use Thojou\OpenAi\Endpoint\Chat;
use Thojou\OpenAi\Endpoint\Embeddings;
use Thojou\OpenAi\Endpoint\Endpoint;
use Thojou\OpenAi\Endpoint\Files;
use Thojou\OpenAi\Endpoint\FineTunes;
use Thojou\OpenAi\Endpoint\FineTuning;
use Thojou\OpenAi\Endpoint\Images;
use Thojou\OpenAi\Endpoint\Models;
use Thojou\OpenAi\Endpoint\Moderations;
use Thojou\OpenAi\OpenAi;

class OpenAiTest extends TestCase
{
    /**
     * @param class-string<Endpoint> $className
     * @param string $endpointName
     *
     * @return void
     *
     * @dataProvider provideEndpointData
     */
    public function testApiEndpoints(string $className, string $endpointName): void
    {
        $openAi = new OpenAi("secretKey");

        $this->assertInstanceOf($className, $openAi->$endpointName());
        $this->assertSame($openAi->$endpointName(), $openAi->$endpointName());
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function provideEndpointData(): array
    {
        return [
            Audio::class => [Audio::class, 'audio'],
            Chat::class => [Chat::class, 'chat'],
            Embeddings::class => [Embeddings::class, 'embeddings'],
            Files::class => [Files::class, 'files'],
            FineTuning::class => [FineTuning::class, 'fineTuning'],
            Images::class => [Images::class, 'images'],
            Moderations::class => [Moderations::class, 'moderation'],
            Models::class => [Models::class, 'models'],
        ];
    }

}
