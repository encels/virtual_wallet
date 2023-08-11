<?php

namespace Src\Users\Application;

use Src\Users\Domain\Contracts\UserRepositoryInterface;
use  Src\Users\Domain\UserEntity;
use Src\Users\Domain\ValueObjects\Document;
use Src\Users\Domain\ValueObjects\Phone;

class GetUserByDocumentNPhoneUseCase
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $document, string $phone): ?UserEntity
    {

        return $this->repository->findByDocumentNPhone(new Document($document), new Phone($phone));
    }
}
