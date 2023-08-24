<?php

namespace Thojou\OpenAi\Endpoint;

use Thojou\OpenAi\Exception\OpenAiException;
use Thojou\OpenAi\Request;

/**
 * Represents the Chat endpoint for interacting with chat-based language model completions in the OpenAI API.
 *
 * @link     https://platform.openai.com/docs/api-reference/chat
 *
 * @internal This class is not meant to be used by library users.
 */
final class Chat extends Endpoint
{
    /**
     * Creates a model response for the given chat conversation.
     *
     * @param array<string, mixed> $options Options for configuring the chat completion.
     *
     * @return array<string, mixed> An array containing the generated chat completion result and other information.
     *
     * @throws OpenAiException If there's an issue with the API request or response.
     *
     * @link https://platform.openai.com/docs/api-reference/chat/create
     * @link https://platform.openai.com/docs/api-reference/chat/object
     * @link https://platform.openai.com/docs/api-reference/chat/streaming
     */
    public function completion(array $options = []): array
    {
        return $this->handler->execute(
            new Request('post', 'chat/completions', $options)
        );
    }
}
