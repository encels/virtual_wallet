<?php

namespace  Src\Shared\Domain\ValueObjects;

abstract class ValueObject
{
    protected $value;

    public function __construct(mixed $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    public function getValue(): mixed
    {
        return $this->value ? : null;
    }

    public function equalsTo(ValueObject $object): bool
    {
        return $this->getValue() === $object->getValue();
    }

    abstract protected function validate(mixed $value): void;
}
