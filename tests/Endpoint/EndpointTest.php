<?php

namespace Thojou\OpenAi\Tests\Endpoint;

use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Thojou\OpenAi\Endpoint\Audio;
use Thojou\OpenAi\Endpoint\Chat;
use Thojou\OpenAi\Endpoint\Embeddings;
use Thojou\OpenAi\Endpoint\Files;
use Thojou\OpenAi\Endpoint\FineTunes;
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
            'files list' => [Files::class, 'list', 'files', 'get'],
            'files delete' => [Files::class, 'delete', 'files', 'delete'],
            'files retrieve' => [Files::class, 'retrieve', 'files/%s', 'get', [1]],
            'files content' => [Files::class, 'content', 'files/%s/content', 'get', [1]],
            'fine tunes list' => [FineTunes::class, 'list', 'fine-tunes', 'get'],
            'fine tunes retrieve' => [FineTunes::class, 'retrieve', 'fine-tunes/%s', 'get', [1]],
            'fine tunes events' => [FineTunes::class, 'events', 'fine-tunes/%s/events', 'get', [1]],
            'fine tunes cancel' => [FineTunes::class, 'cancel', 'fine-tunes/%s/cancel', 'post', [1]],
            'fine tunes delete' => [FineTunes::class, 'delete', "models/%s", 'delete', [1]],
            'model list' => [Models::class, 'list', 'models', 'get'],
            'model retrieve' => [Models::class, 'retrieve', 'models/%s', 'get', [1]],
        ];
    }

    /**
     * @return array<string, array<int, mixed>>>
     */
    public static function provideEndpointDataWithBody(): array
    {
        return [
            'audio transcription' => [Audio::class, 'transcription', 'audio/transcriptions', 'post'],
            'audio translation' => [Audio::class, 'translation', 'audio/translations', 'post'],
            'chat completion' => [Chat::class, 'completion', 'chat/completions', 'post'],
            'embedding' => [Embeddings::class, 'embedding', 'embeddings', 'post'],
            'files upload' => [Files::class, 'upload', 'files', 'post'],
            'fine tunes create' => [FineTunes::class, 'create', 'fine-tunes', 'post'],
            'image generation' => [Images::class, 'generation', 'images/generations', 'post'],
            'image edit' => [Images::class, 'edit', 'images/edits', 'post'],
            'image variation' => [Images::class, 'variation', 'images/variations', 'post'],
            'moderations retrieve' => [Moderations::class, 'moderation', 'moderations', 'post'],
        ];
    }

}
