<?php

namespace  Src\Shared\Domain\ValueObjects;

use Src\Shared\Domain\Exceptions\UuidException;

class Uuid extends ValueObject
{
    protected function validate($value): void
    {
        if (!is_string($value) || !preg_match('/^[a-f0-9]{8}-[a-f0-9]{4}-[1-5][a-f0-9]{3}-[89ab][a-f0-9]{3}-[a-f0-9]{12}$/i', $value)) {
            throw new UuidException('Invalid UUID format', getenv('ERROR_UUID'));
        }
    }
}
