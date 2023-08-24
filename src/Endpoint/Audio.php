<?php

namespace Thojou\OpenAi\Endpoint;

use Thojou\OpenAi\Exception\OpenAiException;
use Thojou\OpenAi\Request;

final class Audio extends Endpoint
{
    /**
     * @param array<string, mixed> $options
     *
     * @return array<string, mixed>
     *
     * @throws OpenAiException
     */
    public function transcription(array $options = []): array
    {
        return $this->handler->execute(
            new Request('post', 'audio/transcriptions', $options)
        );
    }

    /**
     * @param array<string, mixed> $options
     *
     * @return array<string, mixed>
     *
     * @throws OpenAiException
     */
    public function translation(array $options = []): array
    {
        return $this->handler->execute(
            new Request('post', 'audio/translations', $options)
        );
    }
}
