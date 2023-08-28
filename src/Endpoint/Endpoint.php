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

use Thojou\OpenAi\RequestHandlerInterface;

/**
 * Represents the base class for all endpoints.
 *
 * @internal This class is not meant to be used by library users.
 */
abstract class Endpoint
{
    /**
     * Creates a new instance of the Endpoint class.
     *
     * @param RequestHandlerInterface $handler The request handler to use for executing API requests.
     */
    public function __construct(
        protected readonly RequestHandlerInterface $handler
    ) {
    }
}
