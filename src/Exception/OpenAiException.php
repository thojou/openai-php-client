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

namespace Thojou\OpenAi\Exception;

use Exception;

/**
 * An abstract base exception class for handling exceptions related to the OpenAI API.
 */
abstract class OpenAiException extends Exception
{
    /**
     * @param string                            $message     A description of the error.
     * @param string                            $httpBody    The response body from the API.
     * @param int                               $httpStatus  The HTTP status code of the response.
     * @param array<string, array<int, string>> $httpHeaders The HTTP headers from the response.
     */
    public function __construct(
        string $message,
        protected readonly string $httpBody,
        protected readonly int $httpStatus,
        protected readonly array $httpHeaders = []
    ) {
        parent::__construct(
            static::class . ": [{$this->httpStatus}]: {$message}\n",
            $httpStatus
        );
    }

    /**
     * Get the response body from the API causing the exception.
     *
     * @return string The response body.
     */
    public function getHttpBody(): string
    {
        return $this->httpBody;
    }

    /**
     * Get the HTTP status code of the response causing the exception.
     *
     * @return int The HTTP status code.
     */
    public function getHttpStatus(): int
    {
        return $this->httpStatus;
    }

    /**
     * Get the HTTP headers from the response causing the exception.
     *
     * @return array<string, array<int, string>> The HTTP headers.
     */
    public function getHttpHeaders(): array
    {
        return $this->httpHeaders;
    }
}
