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

namespace Thojou\OpenAi\Exception;

/**
 * Represents an exception that is thrown when permission is denied (HTTP status code 403) in the OpenAI API.
 */
class PermissionException extends OpenAiException
{
}
