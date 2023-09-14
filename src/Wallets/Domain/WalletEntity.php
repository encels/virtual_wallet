<?php

namespace  Src\Wallets\Domain;

use Src\Wallets\Domain\Exceptions\AmountException;
use Src\Shared\Domain\ValueObjects\Uuid;
use Src\Wallets\Domain\ValueObjects\Slug;
use Src\Wallets\Domain\ValueObjects\Name;
use Src\Wallets\Domain\ValueObjects\Amount;


class WalletEntity
{
    protected $uuid;
    protected $slug;
    protected $name;
    protected $balance;

    public function __construct(Uuid $uuid, Slug $slug, Name $name)
    {
        $this->uuid = $uuid;
        $this->slug = $slug;
        $this->name = $name;
        $this->balance = new Amount(0);
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function getSlug(): Slug
    {
        return $this->slug;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getBalance(): Amount
    {
        return $this->balance;
    }

    public function deposit(Amount $amount): void
    {
        $this->balance = new Amount($this->balance->getValue() + $amount->getValue());
    }

    public function withdraw(Amount $amount): void
    {
        if ($this->balance->getValue() < $amount->getValue()) {
            throw new AmountException('Insufficient balance');
        }

        $this->balance = new Amount($this->balance->getValue() - $amount->getValue());
    }

    public function toArray(): array
    {
        return [
            'uuid' => $this->uuid->getValue(),
            'slug' => $this->slug->getValue(),
            'name' => $this->name->getValue(),
            'balance' => $this->balance->getValue(),
        ];
    }
}
