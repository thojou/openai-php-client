<?php

namespace Thojou\OpenAi;

use Symfony\Component\HttpClient\HttpClient;
use Thojou\OpenAi\Endpoint\Audio;
use Thojou\OpenAi\Endpoint\Chat;
use Thojou\OpenAi\Endpoint\Embeddings;
use Thojou\OpenAi\Endpoint\Files;
use Thojou\OpenAi\Endpoint\FineTunes;
use Thojou\OpenAi\Endpoint\Images;
use Thojou\OpenAi\Endpoint\Models;
use Thojou\OpenAi\Endpoint\Moderations;

class OpenAi
{
    private readonly RequestHandler $requestHandler;

    private Models $_models;

    private Chat $_chat;

    private Images $_images;

    private Embeddings $_embeddings;

    private Audio $_audio;

    private Files $_files;

    private FineTunes $_fineTunes;

    private Moderations $_moderation;

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

    public function models(): Models
    {
        return $this->_models ??= new Models($this->requestHandler);
    }

    public function chat(): Chat
    {
        return $this->_chat ??= new Chat($this->requestHandler);
    }

    public function images(): Images
    {
        return $this->_images ??= new Images($this->requestHandler);
    }

    public function embeddings(): Embeddings
    {
        return $this->_embeddings ??= new Embeddings($this->requestHandler);
    }

    public function audio(): Audio
    {
        return $this->_audio ??= new Audio($this->requestHandler);
    }

    public function files(): Files
    {
        return $this->_files ??= new Files($this->requestHandler);
    }

    public function fineTunes(): FineTunes
    {
        return $this->_fineTunes ??= new FineTunes($this->requestHandler);
    }

    public function moderation(): Moderations
    {
        return $this->_moderation ??= new Moderations($this->requestHandler);
    }
}
