<?php

namespace Thojou\OpenAi\Endpoint;

use Thojou\OpenAi\Exception\OpenAiException;
use Thojou\OpenAi\Request;

/**
 * Represents the Moderations endpoint for content moderation-related operations in the OpenAI API.
 *
 * @link     https://platform.openai.com/docs/api-reference/moderations
 * @link     https://platform.openai.com/docs/api-reference/moderations/object
 *
 * @internal This class is not meant to be used by library users.
 */
final class Moderations extends Endpoint
{
    /**
     * Classifies if text violates OpenAI's Content Policy.
     *
     * @param array<string, mixed> $options Options for configuring the content moderation.
     *
     * @return array<string, mixed> An array containing moderation results and other information.
     *
     * @throws OpenAiException If there's an issue with the API request or response.
     *
     * @link https://platform.openai.com/docs/api-reference/moderations/create
     */
    public function moderation(array $options = []): array
    {
        return $this->handler->execute(
            new Request('post', 'moderations', $options)
        );
    }
}
