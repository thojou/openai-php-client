<?php

declare(strict_types=1);

/*
 * This file is part of OpenAi PHP Client.
 *
 * (c) Thomas Joußen <tjoussen91@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Thojou\OpenAi\Endpoint;

use Thojou\OpenAi\Exception\OpenAiException;
use Thojou\OpenAi\Request;

/**
 * Represents the Embeddings endpoint for interacting with text embeddings in the OpenAI API.
 *
 * @link     https://platform.openai.com/docs/api-reference/embeddings
 *
 * @internal This class is not meant to be used by library users.
 */
class Embeddings extends Endpoint
{
    /**
     * Creates an embedding vector representing the input text.
     *
     * @param array<string, mixed> $options Options for configuring the text embedding generation.
     *
     * @return array<string, mixed> An array containing the generated text embeddings and other information.
     *
     * @throws OpenAiException If there's an issue with the API request or response.
     *
     * @link https://platform.openai.com/docs/api-reference/embeddings/create
     * @link https://platform.openai.com/docs/api-reference/embeddings/object
     */
    public function embedding(array $options = []): array
    {
        return $this->handler->execute(
            new Request('post', 'embeddings', $options)
        );
    }
}
