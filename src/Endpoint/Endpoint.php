<?php

namespace Thojou\OpenAi\Endpoint;

use Thojou\OpenAi\RequestHandlerInterface;

abstract class Endpoint
{
    protected readonly RequestHandlerInterface $handler;

    public function __construct(RequestHandlerInterface $handler)
    {
        $this->handler = $handler;
    }
}
