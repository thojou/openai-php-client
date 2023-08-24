<?php

namespace Thojou\OpenAi;

use Thojou\OpenAi\Exception\APIException;
use Thojou\OpenAi\Exception\AuthenticationException;
use Thojou\OpenAi\Exception\InvalidRequestException;
use Thojou\OpenAi\Exception\PermissionException;
use Thojou\OpenAi\Exception\RateLimitException;
use Thojou\OpenAi\Exception\ServiceUnavailableException;
use Thojou\OpenAi\Exception\TryAgainException;

interface RequestHandlerInterface
{
    /**
     * @param Request $request
     *
     * @return array<string, mixed>
     * @throws APIException
     * @throws AuthenticationException
     * @throws InvalidRequestException
     * @throws PermissionException
     * @throws RateLimitException
     * @throws ServiceUnavailableException
     * @throws TryAgainException
     */
    public function execute(RequestInterface $request): array;
}
