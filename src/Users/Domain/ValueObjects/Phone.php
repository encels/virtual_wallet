<?php

namespace  Src\Users\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\ValueObject;
use Src\Users\Domain\Exceptions\PhoneException;

class Phone extends ValueObject
{
    protected function validate($value): void
    {
        if (!preg_match('/^[0-9]{10}$/', $value)) {
            throw new PhoneException('Invalid phone number format', getenv('ERROR_PHONE'));
        }
    }
}
