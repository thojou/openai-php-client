<?php

namespace Thojou\OpenAi;

use Symfony\Component\HttpClient\HttpClient;
use Thojou\OpenAi\Endpoint\Audio;
use Thojou\OpenAi\Endpoint\Chat;
use Thojou\OpenAi\Endpoint\Embeddings;
use Thojou\OpenAi\Endpoint\Files;
use Thojou\OpenAi\Endpoint\FineTunes;
use Thojou\OpenAi\Endpoint\FineTuning;
use Thojou\OpenAi\Endpoint\Images;
use Thojou\OpenAi\Endpoint\Models;
use Thojou\OpenAi\Endpoint\Moderations;

/**
 * This class serves as an entry point for interacting with the OpenAI API.
 *
 * @link
 */
class OpenAi
{
    private readonly RequestHandler $requestHandler;

    private Models $_models;

    private Chat $_chat;

    private Images $_images;

    private Embeddings $_embeddings;

    private Audio $_audio;

    private Files $_files;

    private FineTuning $_fineTuning;

    private Moderations $_moderation;

    /**
     * OpenAi constructor.
     *
     * @param string $apiKey  The API key to authenticate with the OpenAI API.
     * @param string $baseUri The base URI for API requests.
     */
    public function __construct(
        private string $apiKey,
        private string $baseUri = 'https://api.openai.com/v1/'
    ) {
        $this->requestHandler = new RequestHandler(
            HttpClient::createForBaseUri($this->baseUri, [
                'headers' => [
                    "Authorization" => "Bearer {$this->apiKey}"
                ]
            ])
        );
    }

    /**
     * Get an instance of the Models endpoint.
     *
     * @return Models The Models endpoint instance.
     */
    public function models(): Models
    {
        return $this->_models ??= new Models($this->requestHandler);
    }

    /**
     * Get an instance of the Chat endpoint.
     *
     * @return Chat The Chat endpoint instance.
     */
    public function chat(): Chat
    {
        return $this->_chat ??= new Chat($this->requestHandler);
    }

    /**
     * Get an instance of the Images endpoint.
     *
     * @return Images The Images endpoint instance.
     */
    public function images(): Images
    {
        return $this->_images ??= new Images($this->requestHandler);
    }

    /**
     * Get an instance of the Embeddings endpoint.
     *
     * @return Embeddings The Embeddings endpoint instance.
     */
    public function embeddings(): Embeddings
    {
        return $this->_embeddings ??= new Embeddings($this->requestHandler);
    }

    /**
     * Get an instance of the Audio endpoint.
     *
     * @return Audio The Audio endpoint instance.
     */
    public function audio(): Audio
    {
        return $this->_audio ??= new Audio($this->requestHandler);
    }

    /**
     * Get an instance of the Files endpoint.
     *
     * @return Files The Files endpoint instance.
     */
    public function files(): Files
    {
        return $this->_files ??= new Files($this->requestHandler);
    }

    /**
     * Get an instance of the FineTuning endpoint.
     *
     * @return FineTuning The FineTuning endpoint instance.
     */
    public function fineTuning(): FineTuning
    {
        return $this->_fineTuning ??= new FineTuning($this->requestHandler);
    }

    /**
     * Get an instance of the Moderations endpoint.
     *
     * @return Moderations The Moderations endpoint instance.
     */
    public function moderation(): Moderations
    {
        return $this->_moderation ??= new Moderations($this->requestHandler);
    }
}
