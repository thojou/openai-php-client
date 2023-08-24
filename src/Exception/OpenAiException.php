<?php

namespace Thojou\OpenAi\Exception;

use Exception;

abstract class OpenAiException extends Exception
{
    /**
     * @param string                            $message
     * @param string                            $httpBody
     * @param int                               $httpStatus
     * @param array<string, array<int, string>> $httpHeaders
     */
    public function __construct(
        string $message,
        protected readonly string $httpBody,
        protected readonly int $httpStatus,
        protected readonly array $httpHeaders = []
    ) {
        parent::__construct($message, $httpStatus);
    }

    /**
     * @return string
     */
    public function getHttpBody(): string
    {
        return $this->httpBody;
    }

    /**
     * @return int
     */
    public function getHttpStatus(): int
    {
        return $this->httpStatus;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function getHttpHeaders(): array
    {
        return $this->httpHeaders;
    }

    public function __toString(): string
    {
        return static::class . ": [{$this->httpStatus}]: {$this->message}\n";
    }
}
