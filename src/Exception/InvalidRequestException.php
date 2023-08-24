<?php

namespace Thojou\OpenAi\Exception;

class InvalidRequestException extends OpenAiException
{
    /**
     * @param string|null                       $param
     * @param string                            $message
     * @param string                            $httpBody
     * @param int                               $httpStatus
     * @param array<string, array<int, string>> $httpHeaders
     */
    public function __construct(
        protected readonly ?string $param,
        string $message,
        string $httpBody,
        int $httpStatus,
        array $httpHeaders = []
    ) {
        parent::__construct($message, $httpBody, $httpStatus, $httpHeaders);
    }

    public function getParam(): ?string
    {
        return $this->param;
    }

    public function __toString(): string
    {
        return parent::__toString() . "Invalid parameter: {$this->param}\n";
    }
}
