<?php

namespace Thojou\OpenAi;

interface RequestInterface
{
    /**
     * @return array<string, string>
     */
    public function getHeaders(): array;

    /**
     * @return array<string, mixed>|null
     */
    public function getBody(): ?array;

    public function getMethod(): string;

    public function getUrl(): string;
}
