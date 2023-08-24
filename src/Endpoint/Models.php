<?php

namespace Thojou\OpenAi\Endpoint;

use Thojou\OpenAi\Exception\OpenAiException;
use Thojou\OpenAi\Request;

/**
 * Represents the Models endpoint for managing models and their interactions with the OpenAI API.
 *
 * @link     https://platform.openai.com/docs/api-reference/models
 * @link     https://platform.openai.com/docs/api-reference/models/object
 *
 * @internal This class is not meant to be used by library users.
 */
final class Models extends Endpoint
{
    /**
     * Lists the currently available models, and provides basic information about each one such as the owner and
     * availability.
     *
     * @return array<string, mixed> An array containing the list of available models and other information.
     *
     * @throws OpenAiException If there's an issue with the API request or response.
     *
     * @link https://platform.openai.com/docs/api-reference/models/list
     */
    public function list(): array
    {
        return $this->handler->execute(new Request('get', 'models'));
    }

    /**
     * Retrieves a model instance, providing basic information about the model such as the owner and permission.
     *
     * @param string $model The name of the model to retrieve information for.
     *
     * @return array<string, mixed> An array containing information about the requested model and other details.
     *
     * @throws OpenAiException If there's an issue with the API request or response.
     *
     * @link https://platform.openai.com/docs/api-reference/models/retrieve
     */
    public function retrieve(string $model): array
    {
        return $this->handler->execute(new Request('get', "models/$model"));
    }
}
