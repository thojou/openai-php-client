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

/**
 * Represents an HTTP request to be made by the OpenAI library.
 *
 * @internal This class is not meant to be used by library users.
 */
final class Request implements RequestInterface
{
    /**
     * Construct an HTTP request.
     *
     * @param string                $method The HTTP method of the request (e.g., GET, POST).
     * @param string                $url The URL to send the request to.
     * @param array<string, mixed>  $body The request body data (if applicable).
     * @param array<string, string> $header The request headers.
     */
    public function __construct(
        private readonly string $method,
        private readonly string $url,
        private readonly ?array $body = null,
        private readonly array $header = []
    ) {
    }

    /**
     * Get the request headers.
     *
     * @return array<string, string> An array of request headers.
     */
    public function getHeaders(): array
    {
        return $this->header;
    }

    /**
     * Get the request body data (if applicable).
     *
     * @return array<string, mixed>|null The request body data or null if not applicable.
     */
    public function getBody(): ?array
    {
        return $this->body;
    }

    /**
     * Get the HTTP method of the request in uppercase (e.g., "GET", "POST").
     *
     * @return string The uppercase HTTP method.
     */
    public function getMethod(): string
    {
        return strtoupper($this->method);
    }

    /**
     * Get the URL to send the request to.
     *
     * @return string The URL of the request.
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
