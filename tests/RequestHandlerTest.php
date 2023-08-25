<?php

namespace Thojou\OpenAi\Tests;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Thojou\OpenAi\Exception\APIException;
use Thojou\OpenAi\Exception\AuthenticationException;
use Thojou\OpenAi\Exception\InvalidRequestException;
use Thojou\OpenAi\Exception\PermissionException;
use Thojou\OpenAi\Exception\RateLimitException;
use Thojou\OpenAi\Exception\ServiceUnavailableException;
use Thojou\OpenAi\Exception\TryAgainException;
use Thojou\OpenAi\RequestHandler;
use Thojou\OpenAi\RequestInterface;
use Throwable;

class RequestHandlerTest extends TestCase
{
    /**
     * @param int                     $statusCode
     * @param class-string<Throwable> $exceptionClass
     * @param string                  $content
     *
     * @return void
     * @throws APIException
     * @throws AuthenticationException
     * @throws Exception
     * @throws InvalidRequestException
     * @throws PermissionException
     * @throws RateLimitException
     * @throws ServiceUnavailableException
     * @throws TryAgainException
     * @dataProvider provideExceptionTestData
     */
    public function testThrowOnStatusCode(int $statusCode, string $exceptionClass, string $content): void
    {
        $this->expectException($exceptionClass);
        $this->expectExceptionCode($statusCode);

        $request = $this->createMock(RequestInterface::class);
        $request->method('getMethod')->willReturn('get');
        $request->method('getUrl')->willReturn('endpoint');

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn($statusCode);
        $response->method('getContent')->willReturn($content);
        $response->method('getHeaders')->willReturn([]);

        $client = $this->createMock(HttpClientInterface::class);
        $client->method('request')->willReturn($response);

        $requestHandler = new RequestHandler($client);
        $requestHandler->execute($request);
    }

    /**
     * @return array<int, array<int, mixed>>
     */
    public static function provideExceptionTestData(): array
    {
        return [
            400 => [400, InvalidRequestException::class, '{"error": {"message": "Invalid request", "param": "test"}}'],
            401 => [401, AuthenticationException::class, '{"error": {"message": "Authentication failed"}}'],
            403 => [403, PermissionException::class, '{"error": {"message": "Permission denied"}}'],
            404 => [404, InvalidRequestException::class, '{"error": {"message": "Invalid request", "param": "test"}}'],
            409 => [409, TryAgainException::class, '{"error": {"message": "Try again"}}'],
            415 => [415, InvalidRequestException::class, '{"error": {"message": "Invalid request", "param": "test"}}'],
            429 => [429, RateLimitException::class, '{"error": {"message": "Rate limit exceeded"}}'],
            503 => [503, ServiceUnavailableException::class, '{"error": {"message": "Service unavailable"}}'],
            500 => [500, APIException::class, '{"error": {"message": "API error"}}'],
            501 => [501, APIException::class, ''],
        ];
    }

    public function testClientRequestFailure(): void
    {
        $this->expectException(APIException::class);

        $request = $this->createMock(RequestInterface::class);
        $request->method('getMethod')->willReturn('post');
        $request->method('getUrl')->willReturn('endpoint');

        $client = $this->createMock(HttpClientInterface::class);
        $client->method('request')->willThrowException(new TransportException('Transport error'));

        $requestHandler = new RequestHandler($client);
        $requestHandler->execute($request);
    }

    /**
     * @param mixed                             $body
     * @param array<string, string>             $requestHeaders
     * @param string                            $content
     * @param array<string, array<int, string>> $headers
     * @param array<string, string>             $expected
     *
     * @return void
     * @throws APIException
     * @throws AuthenticationException
     * @throws Exception
     * @throws InvalidRequestException
     * @throws PermissionException
     * @throws RateLimitException
     * @throws ServiceUnavailableException
     * @throws TryAgainException
     * @dataProvider provideValidRequestData
     */
    public function testValidRequests(
        mixed $body,
        array $requestHeaders,
        ?string $content,
        array $headers,
        array $expected
    ): void {
        $request = $this->createMock(RequestInterface::class);
        $request->method('getMethod')->willReturn('get');
        $request->method('getUrl')->willReturn('endpoint');
        $request->method('getBody')->willReturn($body);
        $request->method('getHeaders')->willReturn($requestHeaders);

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn(200);
        $response->method('getContent')->willReturn($content);
        $response->method('getHeaders')->willReturn($headers);

        $client = $this->createMock(HttpClientInterface::class);
        $client->method('request')->willReturn($response);

        $requestHandler = new RequestHandler($client);
        $result = $requestHandler->execute($request);

        $this->assertEquals($expected, $result);
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function provideValidRequestData(): array
    {
        return [
            'json_request_plain_response' => [["test" => "value"], ['Content-Type' => 'application/json'], 'plain response', ['Content-Type' => ['text/plain']], ['result' => 'plain response']],
            'json_request_json_response' => [["test" => "value"], ['Content-Type' => 'application/json'], '{"text": "success"}', [], ['text' => 'success']],
            'empty_request_json_response' => [null, [], '{"text": "success"}', [], ['text' => 'success']],
            'empty_request_empty_response' => [null, [], '', [], []],
        ];
    }
}
