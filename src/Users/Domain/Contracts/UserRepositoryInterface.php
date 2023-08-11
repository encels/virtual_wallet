<?php

namespace Src\Users\Domain\Contracts;

use Src\Users\Domain\UserEntity;
use Src\Users\Domain\ValueObjects\Phone;
use Src\Users\Domain\ValueObjects\Document;

interface UserRepositoryInterface
{
    public function save(UserEntity $user): void;

    public function findByDocumentNPhone(Document $document, Phone $phone): ?UserEntity;

    public function delete(UserEntity $user): void;
}
