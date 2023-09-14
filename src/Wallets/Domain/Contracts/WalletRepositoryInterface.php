<?php

namespace Src\Wallets\Domain\Contracts;

use Src\Wallets\Domain\ValueObjects\Amount;
use Src\Wallets\Domain\WalletEntity;

interface WalletRepositoryInterface
{
    public function save(WalletEntity $wallet, int $userId): void;

    public function findByUserId(int $userId): ?WalletEntity;

    public function updateBalance(Amount $amount, $type, $userId): ?WalletEntity;

    public function delete(WalletEntity $wallet): void;
}
