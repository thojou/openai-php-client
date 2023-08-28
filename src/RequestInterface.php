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
 * Represents an HTTP request interface to be used by the OpenAI library.
 */
interface RequestInterface
{
    /**
     * Get the headers for the HTTP request.
     *
     * @return array<string, string> An associative array of request headers.
     */
    public function getHeaders(): array;

    /**
     * Get the body data for the HTTP request (if applicable).
     *
     * @return array<string, mixed>|null The body data or null if not applicable.
     */
    public function getBody(): ?array;

    /**
     * Get the HTTP method for the request (e.g., GET, POST, etc.).
     *
     * @return string The uppercase HTTP method.
     */
    public function getMethod(): string;

    /**
     * Get the URL for the request.
     *
     * @return string The URL of the request.
     */
    public function getUrl(): string;
}
