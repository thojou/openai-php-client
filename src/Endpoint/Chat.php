<?php

namespace Thojou\OpenAi\Endpoint;

use Thojou\OpenAi\Exception\OpenAiException;
use Thojou\OpenAi\Request;

final class Chat extends Endpoint
{
    /**
     * @param array<string, mixed> $options
     *
     * @return array<string, mixed>
     *
     * @throws OpenAiException
     */
    public function completion(array $options = []): array
    {
        return $this->handler->execute(
            new Request('post', 'chat/completions', $options)
        );
    }
}
