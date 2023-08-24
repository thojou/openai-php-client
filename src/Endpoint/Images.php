<?php

namespace Thojou\OpenAi\Endpoint;

use Thojou\OpenAi\Exception\OpenAiException;
use Thojou\OpenAi\Request;

/**
 * Represents the Images endpoint for generating, editing, and working with images in the OpenAI API.
 *
 * @link     https://platform.openai.com/docs/api-reference/images
 * @link     https://platform.openai.com/docs/api-reference/images/object
 *
 * @internal This class is not meant to be used by library users.
 */
final class Images extends Endpoint
{
    /**
     * Creates an image given a prompt.
     *
     * @param array<string, mixed> $options Options for configuring the image generation.
     *
     * @return array<string, mixed> An array containing the generated image and other information.
     *
     * @throws OpenAiException If there's an issue with the API request or response.
     *
     * @link https://platform.openai.com/docs/api-reference/images/create
     */
    public function generation(array $options): array
    {
        return $this->handler->execute(
            new Request('post', 'images/generations', $options)
        );
    }

    /**
     * Creates an edited or extended image given an original image and a prompt.
     *
     * @param array<string, mixed> $options Options for configuring the image editing.
     *
     * @return array<string, mixed> An array containing the edited image and other information.
     *
     * @throws OpenAiException If there's an issue with the API request or response.
     *
     * @link https://platform.openai.com/docs/api-reference/images/createEdit
     */
    public function edit(array $options): array
    {
        return $this->handler->execute(
            new Request('post', 'images/edits', $options)
        );
    }

    /**
     * Creates a variation of a given image.
     *
     * @param array<string, mixed> $options Options for configuring the image variation generation.
     *
     * @return array<string, mixed> An array containing the generated image variations and other information.
     *
     * @throws OpenAiException If there's an issue with the API request or response.
     *
     * @link https://platform.openai.com/docs/api-reference/images/createVariation
     */
    public function variation(array $options): array
    {
        return $this->handler->execute(
            new Request('post', 'images/variations', $options)
        );
    }
}
