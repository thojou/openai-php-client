<?php

namespace Thojou\OpenAi;

final class Request implements RequestInterface
{
    /**
     * @param string                $method
     * @param string                $url
     * @param array<string, mixed>  $body
     * @param array<string, string> $header
     */
    public function __construct(
        private readonly string $method,
        private readonly string $url,
        private readonly ?array $body = null,
        private readonly array $header = []
    ) {
    }

    /**
     * @return array<string, string>
     */
    public function getHeaders(): array
    {
        return $this->header;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function getBody(): ?array
    {
        return $this->body;
    }

    public function getMethod(): string
    {
        return strtolower($this->method);
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
