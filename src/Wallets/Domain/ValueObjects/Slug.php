<?php
namespace  Src\Wallets\Domain\ValueObjects;
use Src\Shared\Domain\ValueObjects\ValueObject;
use Src\Wallets\Domain\Exceptions\SlugException;

class Slug extends ValueObject
{
    protected function validate($value): void
    {
        if (!is_string($value) || strlen($value) < 2 || strlen($value) > 50 || !preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/i', $value)) {
            throw new SlugException('Slug must be a string between 2 and 50 characters, containing only alphanumeric characters and dashes', getenv('ERROR_SLUG'));    }
}
    

