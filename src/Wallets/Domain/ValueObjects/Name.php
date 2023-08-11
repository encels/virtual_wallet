<?php

namespace  Src\Wallets\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\ValueObject;
use Src\Wallets\Domain\Exceptions\NameException;

class Name extends ValueObject
{
    protected function validate($value): void
    {
        if (!is_string($value) || strlen($value) < 2 || strlen($value) > 100) {
            throw new NameException('Name must be a string between 2 and 100 characters', getenv('ERROR_NAME'));
        }
    }
}
