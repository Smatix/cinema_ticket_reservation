<?php declare(strict_types=1);

namespace App\Shared\Exception;

use Exception;

class InvalidPolicyException extends Exception
{
    const MESSAGE = 'Invalid policy';

    public function __construct(string $message = self::MESSAGE, int $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}