<?php

namespace Thojou\OpenAi\Exception;

/**
 * Represents an exception that is thrown when a request should be retried (HTTP status code 429) in the OpenAI API.
 */
class TryAgainException extends OpenAiException
{
}
