<?php

namespace Src\Users\Infrastructure;

use Src\Users\Application\GetUserByDocumentNPhoneUseCase;
use Src\Users\Infrastructure\Eloquent\Repositories\EloquentUserRepository;

class GetUser
{
    protected $repository;

    public function __construct(EloquentUserRepository $repository)
    {
        $this->repository   = $repository;
    }

    public function find(string $document, string $phone): array
    {
        $useCase = new GetUserByDocumentNPhoneUseCase($this->repository);
        return $useCase->execute($document, $phone)?->toArray();
    }
}
