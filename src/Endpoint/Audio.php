<?php

namespace Thojou\OpenAi\Endpoint;

use Thojou\OpenAi\Exception\OpenAiException;
use Thojou\OpenAi\Request;

/**
 * Represents the Audio endpoint for interacting with audio-related operations in the OpenAI API.
 *
 * @link     https://platform.openai.com/docs/api-reference/audio
 *
 * @internal This class is not meant to be used by library users.
 */
final class Audio extends Endpoint
{
    /**
     * Transcribes audio into the input language.
     *
     * @param array<string, mixed> $options Options for configuring the transcription.
     *
     * @return array<string, mixed> An array containing the translated text.
     *
     * @throws OpenAiException If there's an issue with the API request or response.
     *
     * @link https://platform.openai.com/docs/api-reference/audio/createTranscription
     */
    public function transcription(array $options): array
    {
        return $this->handler->execute(
            new Request('post', 'audio/transcriptions', $options, [
                'Content-Type' => 'multipart/form-data'
            ])
        );
    }

    /**
     * Translates audio into English.
     *
     * @param array<string, mixed> $options Options for configuring the translation.
     *
     * @return array<string, mixed> An array containing the translated text.
     *
     * @throws OpenAiException If there's an issue with the API request or response.
     *
     * @link https://platform.openai.com/docs/api-reference/audio/createTranslation
     */
    public function translation(array $options): array
    {
        return $this->handler->execute(
            new Request('post', 'audio/translations', $options, [
                'Content-Type' => 'multipart/form-data'
            ])
        );
    }
}
