<?php

namespace Thojou\OpenAi\Endpoint;

use Thojou\OpenAi\Exception\OpenAiException;
use Thojou\OpenAi\Request;

final class Embeddings extends Endpoint
{
    /**
     * @param array<string, mixed> $options
     *
     * @return array<string, mixed>
     *
     * @throws OpenAiException
     */
    public function embedding(array $options = []): array
    {
        return $this->handler->execute(
            new Request('post', 'embeddings', $options)
        );
    }
}
