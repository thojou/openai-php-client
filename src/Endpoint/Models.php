<?php

namespace Thojou\OpenAi\Endpoint;

use Thojou\OpenAi\Exception\OpenAiException;
use Thojou\OpenAi\Request;

final class Models extends Endpoint
{
    /**
     * @return array<string, mixed>
     *
     * @throws OpenAiException
     */
    public function list(): array
    {
        return $this->handler->execute(new Request('get', 'models'));
    }

    /**
     * @return array<string, mixed>
     *
     * @throws OpenAiException
     */
    public function retrieve(string $model): array
    {
        return $this->handler->execute(new Request('get', "models/$model"));
    }
}
