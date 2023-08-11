<?php

namespace Src\Users\Infrastructure\Eloquent\Repositories;

use Src\Users\Domain\Contracts\UserRepositoryInterface;
use Src\Users\Domain\UserEntity;
use Src\Users\Domain\ValueObjects\Document;
use Src\Users\Domain\ValueObjects\Email;
use Src\Users\Domain\ValueObjects\FullName;
use Src\Users\Domain\ValueObjects\Phone;
use Src\Users\Infrastructure\Eloquent\UserModel;

class EloquentUserRepository implements UserRepositoryInterface
{
    private UserModel $model;

    public function __construct(UserModel $model)
    {
        $this->model = $model;
    }

    public function save(UserEntity $user): void
    {
        $this->model->updateOrCreate(
            [
                'document' => $user->getDocument()->getValue(),
                'phone' => $user->getPhone()->getValue(),
            ],
            [
                'fullName' => $user->getFullName()->getValue(),
                'email' => $user->getEmail()->getValue(),
            ]
        );
    }

    public function findByDocumentNPhone(Document $document, Phone $phone): ?UserEntity
    {
        $result = $this->model->where('document', $document->getValue())
            ->where('phone', $phone->getValue())
            ->first();

        if ($result) {
            return new UserEntity(
                $result->id,
                new Document($result->document),
                new FullName($result->fullName),
                new Email($result->email),
                new Phone($result->phone)
            );
        }

        return null;
    }

    public function delete(UserEntity $user): void
    {
        $this->model->where('document', $user->getDocument()->getValue())
            ->where('phone', $user->getPhone()->getValue())
            ->delete();
    }
}
