<?php

namespace  Src\Wallets\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\ValueObject;
use Src\Wallets\Domain\Exceptions\AmountException;

class Amount extends ValueObject
{
    protected function validate($value): void
    {
        if (!is_float($value) || $value < 0) {
            throw new AmountException('Amount must be a positive float', getenv('ERROR_AMOUNT'));
        }
    }
}
