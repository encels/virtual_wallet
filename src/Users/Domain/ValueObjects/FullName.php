<?php

namespace  Src\Users\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\ValueObject;
use Src\Users\Domain\Exceptions\FullNameException;

class FullName extends ValueObject
{
    protected function validate(mixed $value): void
    {
        if (!is_string($value) || strlen($value) < 3) {
            throw new FullNameException('Full name must be a string of at least 3 characters', getenv('ERROR_FULLNAME'));
        }
    }
}
