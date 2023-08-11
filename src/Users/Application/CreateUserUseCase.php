<?php

namespace Src\Users\Application;

use Src\Users\Domain\Contracts\UserRepositoryInterface;
use  Src\Users\Domain\UserEntity;
use Src\Users\Domain\ValueObjects\Document;
use Src\Users\Domain\ValueObjects\Email;
use Src\Users\Domain\ValueObjects\FullName;
use Src\Users\Domain\ValueObjects\Phone;

class CreateUserUseCase
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(
        string $document,
        string $fullName,
        string $email,
        string $phone
    ): void {

        $user = new UserEntity(0,
            new Document($document),
            new FullName($fullName),
            new Email($email),
            new Phone($phone)
        );

        $this->repository->save($user);
    }
}
