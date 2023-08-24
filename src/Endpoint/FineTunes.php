<?php

namespace Thojou\OpenAi\Endpoint;

use Thojou\OpenAi\Exception\OpenAiException;
use Thojou\OpenAi\Request;

final class FineTunes extends Endpoint
{
    /**
     * @param array<string, mixed> $options
     *
     * @return array<string, mixed>
     *
     * @throws OpenAiException
     */
    public function create(array $options = []): array
    {
        return $this->handler->execute(
            new Request('post', 'fine-tunes', $options)
        );
    }

    /**
     * @return array<string, mixed>
     *
     * @throws OpenAiException
     */
    public function list(): array
    {
        return $this->handler->execute(new Request('get', 'fine-tunes'));
    }

    /**
     * @param string $fineTuneId
     *
     * @return array<string, mixed>
     *
     * @throws OpenAiException
     */
    public function retrieve(string $fineTuneId): array
    {
        return $this->handler->execute(new Request('get', "fine-tunes/{$fineTuneId}"));
    }

    /**
     * @param string $fineTuneId
     *
     * @return array<string, mixed>
     *
     * @throws OpenAiException
     */
    public function cancel(string $fineTuneId): array
    {
        return $this->handler->execute(new Request('post', "fine-tunes/{$fineTuneId}/cancel"));
    }

    /**
     * @param string $fineTuneId
     *
     * @return array<string, mixed>
     *
     * @throws OpenAiException
     */
    public function events(string $fineTuneId): array
    {
        return $this->handler->execute(new Request('get', "fine-tunes/{$fineTuneId}/events"));
    }

    /**
     * @param string $model
     *
     * @return array<string, mixed>
     *
     * @throws OpenAiException
     */
    public function delete(string $model): array
    {
        return $this->handler->execute(new Request('delete', "models/{$model}"));
    }
}
