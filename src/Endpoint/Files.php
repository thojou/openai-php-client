<?php

namespace Thojou\OpenAi\Endpoint;

use Thojou\OpenAi\Exception\OpenAiException;
use Thojou\OpenAi\Request;

final class Files extends Endpoint
{
    /**
     * @return array<string, mixed>
     *
     * @throws OpenAiException
     */
    public function list(): array
    {
        return $this->handler->execute(new Request('get', 'files'));
    }

    /**
     * @param array<string, mixed> $options
     *
     * @return array<string, mixed>
     *
     * @throws OpenAiException
     */
    public function upload(array $options = []): array
    {
        return $this->handler->execute(
            new Request('post', 'files', $options)
        );
    }

    /**
     * @param array<string, mixed> $options
     *
     * @return array<string, mixed>
     *
     * @throws OpenAiException
     */
    public function delete(array $options = []): array
    {
        return $this->handler->execute(
            new Request('delete', 'files', $options)
        );
    }

    /**
     * @param string $fileId
     *
     * @return array<string, mixed>
     *
     * @throws OpenAiException
     */
    public function retrieve(string $fileId): array
    {
        return $this->handler->execute(new Request('get', "files/{$fileId}"));
    }


    /**
     * @param string $fileId
     *
     * @return array<string, mixed>
     *
     * @throws OpenAiException
     */
    public function content(string $fileId): array
    {
        return $this->handler->execute(new Request('get', "files/{$fileId}/content"));
    }
}
