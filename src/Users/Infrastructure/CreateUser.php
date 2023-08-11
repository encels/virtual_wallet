<?php
namespace Src\Users\Infrastructure;

use Src\Users\Application\CreateUserUseCase;
use Src\Users\Infrastructure\Eloquent\Repositories\EloquentUserRepository;

class CreateUser
{
    private $repository;

    public function __construct(EloquentUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function save(string $document, string $fullName, string $email, string $phone): void
    {
        $useCase =new CreateUserUseCase($this->repository);
        $useCase->execute($document, $fullName, $email, $phone);
    }
}

