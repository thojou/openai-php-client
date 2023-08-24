<?php

namespace Thojou\OpenAi\Exception;

/**
 * Represents an exception that is thrown when the rate limit is exceeded (HTTP status code 429) in the OpenAI API.
 */
class RateLimitException extends OpenAiException
{
}
