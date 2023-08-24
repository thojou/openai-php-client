<?php

namespace Thojou\OpenAi\Endpoint;

use Thojou\OpenAi\Exception\OpenAiException;
use Thojou\OpenAi\Request;

final class Images extends Endpoint
{
    /**
     * @param array<string, mixed> $options
     *
     * @return array<string, mixed>
     *
     * @throws OpenAiException
     */
    public function generation(array $options): array
    {
        return $this->handler->execute(
            new Request('post', 'images/generations', $options)
        );
    }

    /**
     * @param array<string, mixed> $options
     *
     * @return array<string, mixed>
     *
     * @throws OpenAiException
     */
    public function edit(array $options): array
    {
        return $this->handler->execute(
            new Request('post', 'images/edits', $options)
        );
    }

    /**
     * @param array<string, mixed> $options
     *
     * @return array<string, mixed>
     *
     * @throws OpenAiException
     */
    public function variation(array $options): array
    {
        return $this->handler->execute(
            new Request('post', 'images/variations', $options)
        );
    }
}
