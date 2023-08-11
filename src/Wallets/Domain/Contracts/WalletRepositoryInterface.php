<?php

namespace Src\Wallets\Domain\Contracts;

use Src\Shared\Domain\ValueObjects\Uuid;
use Src\Wallets\Domain\ValueObjects\Amount;
use Src\Wallets\Domain\WalletEntity;

interface WalletRepositoryInterface
{
    public function save(WalletEntity $wallet, int $userId): void;

    public function findByUuid(Uuid $uuid): ?WalletEntity;

    public function updateBalance(Amount $amount, $type): ?WalletEntity;

    public function delete(WalletEntity $wallet): void;
}
