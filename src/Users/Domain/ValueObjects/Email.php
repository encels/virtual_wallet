<?php

namespace  Src\Users\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\ValueObject;
use Src\Users\Domain\Exceptions\EmailException;

class Email extends ValueObject
{
    protected function validate($value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new EmailException('Invalid email format', getenv('ERROR_EMAIL'));
        }
    }
}
