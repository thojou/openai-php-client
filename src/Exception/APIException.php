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
 * Represents an exception that is thrown when an API error occurs.
 */
class APIException extends OpenAiException
{
    /**
     * Construct an API exception.
     *
     * @param string                            $message      A description of the error.
     * @param string                            $httpBody     The response body from the API.
     * @param int|null                          $httpStatus   The HTTP status code of the response.
     * @param array<string, array<int, string>> $httpHeaders  The HTTP headers from the response.
     */
    public function __construct(
        string $message,
        string $httpBody = "",
        ?int $httpStatus = null,
        array $httpHeaders = []
    ) {
        parent::__construct($message, $httpBody, $httpStatus ?? 0, $httpHeaders);
    }
}
