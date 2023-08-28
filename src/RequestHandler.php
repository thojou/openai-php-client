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

namespace Thojou\OpenAi;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Thojou\OpenAi\Exception\APIException;
use Thojou\OpenAi\Exception\AuthenticationException;
use Thojou\OpenAi\Exception\InvalidRequestException;
use Thojou\OpenAi\Exception\PermissionException;
use Thojou\OpenAi\Exception\RateLimitException;
use Thojou\OpenAi\Exception\ServiceUnavailableException;
use Thojou\OpenAi\Exception\TryAgainException;

/**
 * This class is responsible for executing HTTP requests and handling possible exceptions.
 *
 * @internal This class is not meant to be used or overwritten outside the library
 */
class RequestHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly HttpClientInterface $client
    ) {
    }

    /**
     * Execute an HTTP request and handle possible exceptions.
     *
     * @param RequestInterface $request The HTTP request to execute.
     *
     * @return array<string, mixed> The response data from the API.
     * @throws APIException
     * @throws AuthenticationException
     * @throws InvalidRequestException
     * @throws PermissionException
     * @throws RateLimitException
     * @throws ServiceUnavailableException
     * @throws TryAgainException
     */
    public function execute(RequestInterface $request): array
    {
        // Prepare headers and request body
        $headers = $request->getHeaders();
        $requestMethod = strtoupper($request->getMethod());

        if ($requestMethod === 'POST' && !isset($headers['Content-Type'])) {
            $headers['Content-Type'] = "application/json";
        }

        $body = $request->getBody();

        if ($body && $headers['Content-Type'] === "application/json") {
            $body = json_encode($body);
        }

        try {
            $response = $this->client->request($requestMethod, $request->getUrl(), [
                'headers' => $headers,
                'body' => $body
            ]);

            $this->throwIfErrorStatusCode($response);

            $responseHeaders = $response->getHeaders(false);
            $responseContent = $response->getContent(false);

            if (isset($responseHeaders['Content-Type']) && $responseHeaders['Content-Type'][0] === 'text/plain') {
                return ["result" => $responseContent];
            }

            return (array)json_decode($responseContent, true);
        } catch (TransportExceptionInterface | ClientExceptionInterface | ServerExceptionInterface | RedirectionExceptionInterface $e) {
            throw new APIException($e->getMessage(), '', $e->getCode());
        }
    }

    /**
     * Check the response for error status codes and throw corresponding exceptions.
     *
     * @param ResponseInterface $response The HTTP response to check.
     *
     * @throws APIException
     * @throws AuthenticationException
     * @throws ClientExceptionInterface
     * @throws InvalidRequestException
     * @throws PermissionException
     * @throws RateLimitException
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ServiceUnavailableException
     * @throws TransportExceptionInterface
     * @throws TryAgainException
     */
    private function throwIfErrorStatusCode(ResponseInterface $response): void
    {
        $statusCode = $response->getStatusCode();

        if (200 <= $statusCode && $statusCode < 300) {
            return;
        }

        $body = $response->getContent(false);
        $headers = $response->getHeaders(false);

        $errorResponse = $this->extractErrorData($body);

        throw match ($statusCode) {
            401 => new AuthenticationException($errorResponse['message'], $body, $statusCode, $headers),
            403 => new PermissionException($errorResponse['message'], $body, $statusCode, $headers),
            409 => new TryAgainException($errorResponse['message'], $body, $statusCode, $headers),
            400, 404, 415 => new InvalidRequestException(
                $errorResponse['param'],
                $errorResponse['message'],
                $body,
                $statusCode,
                $headers
            ),
            429 => new RateLimitException($errorResponse['message'], $body, $statusCode, $headers),
            503 => new ServiceUnavailableException($errorResponse['message'], $body, $statusCode, $headers),
            default => new APIException($errorResponse['message'], $body, $statusCode, $headers),
        };
    }

    /**
     * Extract error data from the response body.
     *
     * @param string $body The response body.
     *
     * @return array<string, string> The extracted error data.
     */
    private function extractErrorData(string $body): array
    {
        $data = (array)json_decode($body, true, 512);

        if (isset($data['error']) && is_array($data['error'])) {
            return $data['error'];
        }

        return ['message' => '<empty message>'];
    }
}
