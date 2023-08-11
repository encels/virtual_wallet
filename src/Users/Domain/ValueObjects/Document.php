<?php
namespace  Src\Users\Domain\ValueObjects;
use Src\Shared\Domain\ValueObjects\ValueObject;
use Src\Users\Domain\Exceptions\DocumentException;

class Document extends ValueObject
{
    protected function validate($value): void
    {
        if (!is_string($value) || strlen($value) < 5) {
            throw new DocumentException('Document must be a string of at least 5 characters', getenv('ERROR_DOCUMENT'));
        }
    }
}
    

