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

namespace Thojou\OpenAi\Tests\Exceptions;

use PHPUnit\Framework\TestCase;
use Thojou\OpenAi\Exception\APIException;
use Thojou\OpenAi\Exception\AuthenticationException;
use Thojou\OpenAi\Exception\InvalidRequestException;
use Thojou\OpenAi\Exception\OpenAiException;
use Thojou\OpenAi\Exception\PermissionException;
use Thojou\OpenAi\Exception\RateLimitException;
use Thojou\OpenAi\Exception\ServiceUnavailableException;
use Thojou\OpenAi\Exception\TryAgainException;

class ExceptionsTest extends TestCase
{
    public function testInvalidRequestException(): void
    {
        $message = 'An error occurred';
        $param = "test";
        $expectedMessage = InvalidRequestException::class . ": [400]: {$message}\nInvalid parameter: {$param}\n";
        $exception = new InvalidRequestException($param, $message, '', 400);

        $this->assertEquals($expectedMessage, $exception->getMessage());
        $this->assertEquals('', $exception->getHttpBody());
        $this->assertEquals(400, $exception->getHttpStatus());
        $this->assertEquals([], $exception->getHttpHeaders());
        $this->assertEquals($param, $exception->getParam());
    }

    /**
     * @param int                           $statusCode
     * @param class-string<OpenAiException> $exceptionClass
     *
     * @return void
     *
     * @dataProvider provideExceptionsData
     */
    public function testOtherException(int $statusCode, string $exceptionClass): void
    {

        $message = 'An error occurred';
        $expectedMessage = $exceptionClass . ": [{$statusCode}]: {$message}\n";
        $exception = new $exceptionClass($message, '', $statusCode);

        $this->assertEquals($expectedMessage, $exception->getMessage());
        $this->assertEquals('', $exception->getHttpBody());
        $this->assertEquals($statusCode, $exception->getHttpStatus());
        $this->assertEquals([], $exception->getHttpHeaders());
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function provideExceptionsData(): array
    {
        return [
            AuthenticationException::class => [401, AuthenticationException::class],
            PermissionException::class => [403, PermissionException::class],
            TryAgainException::class => [409, TryAgainException::class],
            RateLimitException::class => [429, RateLimitException::class],
            ServiceUnavailableException::class => [503, ServiceUnavailableException::class],
            APIException::class => [500, APIException::class],
        ];
    }
}
