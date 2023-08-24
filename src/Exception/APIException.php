<?php

namespace Thojou\OpenAi\Exception;

class APIException extends OpenAiException
{
    /**
     * @param string                            $message
     * @param string                            $httpBody
     * @param int|null                          $httpStatus
     * @param array<string, array<int, string>> $httpHeaders
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
