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

/**
 * Represents an exception that is thrown when an invalid request is made (HTTP status codes 400, 404, and 415) in the
 * OpenAI API.
 */
class InvalidRequestException extends OpenAiException
{
    /**
     * @param string|null                       $param       The name of the invalid parameter (if applicable).
     * @param string                            $message     A description of the error.
     * @param string                            $httpBody    The response body from the API.
     * @param int                               $httpStatus  The HTTP status code of the response.
     * @param array<string, array<int, string>> $httpHeaders The HTTP headers from the response.
     */
    public function __construct(
        protected readonly ?string $param,
        string $message,
        string $httpBody,
        int $httpStatus,
        array $httpHeaders = []
    ) {
        parent::__construct(
            $message . "\nInvalid parameter: {$this->param}",
            $httpBody,
            $httpStatus,
            $httpHeaders
        );
    }

    /**
     * Get the name of the invalid parameter causing the exception.
     *
     * @return string|null The name of the invalid parameter, or null if not applicable.
     */
    public function getParam(): ?string
    {
        return $this->param;
    }
}
