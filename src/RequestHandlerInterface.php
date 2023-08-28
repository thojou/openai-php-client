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

namespace Thojou\OpenAi;

use Thojou\OpenAi\Exception\APIException;
use Thojou\OpenAi\Exception\AuthenticationException;
use Thojou\OpenAi\Exception\InvalidRequestException;
use Thojou\OpenAi\Exception\PermissionException;
use Thojou\OpenAi\Exception\RateLimitException;
use Thojou\OpenAi\Exception\ServiceUnavailableException;
use Thojou\OpenAi\Exception\TryAgainException;

/**
 * This interface defines the methods that a request handler must implement.
 */
interface RequestHandlerInterface
{
    /**
     * Execute an HTTP request and handle possible exceptions.
     *
     * @param RequestInterface $request The HTTP request to execute.
     *
     * @return array<string, mixed> The response data from the API.
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
