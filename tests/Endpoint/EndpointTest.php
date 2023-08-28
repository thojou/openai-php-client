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

namespace Thojou\OpenAi\Tests\Endpoint;

use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Thojou\OpenAi\Endpoint\Audio;
use Thojou\OpenAi\Endpoint\Chat;
use Thojou\OpenAi\Endpoint\Embeddings;
use Thojou\OpenAi\Endpoint\Files;
use Thojou\OpenAi\Endpoint\FineTunes;
use Thojou\OpenAi\Endpoint\FineTuning;
use Thojou\OpenAi\Endpoint\Images;
use Thojou\OpenAi\Endpoint\Models;
use Thojou\OpenAi\Endpoint\Moderations;
use Thojou\OpenAi\RequestHandler;
use Thojou\OpenAi\RequestHandlerInterface;
use Thojou\OpenAi\RequestInterface;

class EndpointTest extends TestCase
{
    /**
     * @param string $endpointClass
     * @param string $endpointName
     * @param string $uri
     * @param string $method
     *
     * @return void
     * @throws \PHPUnit\Framework\MockObject\Exception
     *
     * @dataProvider provideEndpointDataWithBody
     */
    public function testPostEndpoint(string $endpointClass, string $endpointName, string $uri, string $method): void
    {
        $response = ["success" => true];
        $body = ['test' => 'test'];

        $requestHandler = $this->createMock(RequestHandlerInterface::class);
        $requestHandler->method('execute')->with(
            $this->callback(function (RequestInterface $request) use ($uri, $method, $body) {
                return $request->getUrl() === $uri
                    && $request->getMethod() === $method
                    && is_array($request->getHeaders())
                    && $request->getBody() === $body;
            })
        )->willReturn($response);

        $endpoint = new $endpointClass($requestHandler);
        $result = $endpoint->$endpointName($body);

        $this->assertSame($response, $result);
    }

    /**
     * @param string                    $endpointClass
     * @param string                    $endpointName
     * @param string                    $uri
     * @param string                    $method
     * @param array<string, scalar>|null $params
     *
     * @return void
     * @throws \PHPUnit\Framework\MockObject\Exception
     *
     * @dataProvider provideEndpointDataWithoutBody
     */
    public function testOtherEndpoint(
        string $endpointClass,
        string $endpointName,
        string $uri,
        string $method,
        ?array $params = null
    ): void {
        $params ??= [];
        $response = ["success" => true];

        $requestHandler = $this->createMock(RequestHandlerInterface::class);
        $requestHandler->method('execute')->with(
            $this->callback(function (RequestInterface $request) use ($uri, $method, $params) {
                return $request->getUrl() === sprintf($uri, ...$params)
                    && $request->getMethod() === $method
                    && is_array($request->getHeaders());
            })
        )->willReturn($response);

        $endpoint = new $endpointClass($requestHandler);
        $result = $endpoint->$endpointName(...$params);

        $this->assertSame($response, $result);
    }

    /**
     * @return array<string, array<int, mixed>>>
     */
    public static function provideEndpointDataWithoutBody(): array
    {
        return [
            'files list' => [Files::class, 'list', 'files', 'GET'],
            'files delete' => [Files::class, 'delete', 'files', 'DELETE'],
            'files retrieve' => [Files::class, 'retrieve', 'files/%s', 'GET', ["1"]],
            'files content' => [Files::class, 'content', 'files/%s/content', 'GET', ["1"]],
            'fine tuning retrieve' => [FineTuning::class, 'retrieve', 'fine_tuning/jobs/%s', 'GET', ["1"]],
            'fine tuning events' => [FineTuning::class, 'events', 'fine_tuning/jobs/%s/events', 'GET', ["1"]],
            'fine tuning cancel' => [FineTuning::class, 'cancel', 'fine_tuning/jobs/%s/cancel', 'POST', ["1"]],
            'model list' => [Models::class, 'list', 'models', 'GET'],
            'model retrieve' => [Models::class, 'retrieve', 'models/%s', 'GET', ["1"]],
        ];
    }

    /**
     * @return array<string, array<int, mixed>>>
     */
    public static function provideEndpointDataWithBody(): array
    {
        return [
            'audio transcription' => [Audio::class, 'transcription', 'audio/transcriptions', 'POST'],
            'audio translation' => [Audio::class, 'translation', 'audio/translations', 'POST'],
            'chat completion' => [Chat::class, 'completion', 'chat/completions', 'POST'],
            'embedding' => [Embeddings::class, 'embedding', 'embeddings', 'POST'],
            'files upload' => [Files::class, 'upload', 'files', 'POST'],
            'fine tuning create' => [FineTuning::class, 'create', 'fine_tuning/jobs', 'POST'],
            'image generation' => [Images::class, 'generation', 'images/generations', 'POST'],
            'image edit' => [Images::class, 'edit', 'images/edits', 'POST'],
            'image variation' => [Images::class, 'variation', 'images/variations', 'POST'],
            'moderations retrieve' => [Moderations::class, 'moderation', 'moderations', 'POST'],
        ];
    }

}
