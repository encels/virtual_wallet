<?php

namespace Src\Users\Infrastructure\Doctrine\Repositories;

use Doctrine\ORM\EntityManagerInterface;
use Src\Users\Domain\Contracts\UserRepositoryInterface;
use Src\Users\Domain\UserEntity;
use Src\Users\Domain\ValueObjects\Document;
use Src\Users\Domain\ValueObjects\Email;
use Src\Users\Domain\ValueObjects\FullName;
use Src\Users\Domain\ValueObjects\Phone;

class DoctrineUserRepository implements UserRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(UserEntity $user): void
    {
        $doctrineUser = new UserDoctrineEntity(
            $user->getDocument(),
            $user->getFullName(),
            $user->getEmail(),
            $user->getPhone()
        );

        $this->entityManager->persist($doctrineUser);
        $this->entityManager->flush();
    }

    public function findByDocumentNPhone(Document $document, Phone $phone): ?UserEntity
    {
        $repository = $this->entityManager->getRepository(UserDoctrineEntity::class);
        /** @var UserDoctrineEntity|null $doctrineUser */
        $doctrineUser = $repository->findOneBy([
            'document' => $document->getValue(),
            'phone' => $phone->getValue(),
        ]);

        return $doctrineUser ? new UserEntity(
            new Document($doctrineUser->getDocument()),
            new FullName($doctrineUser->getFullName()),
            new Email($doctrineUser->getEmail()),
            new Phone($doctrineUser->getPhone())
        ) : null;
    }

    public function delete(UserEntity $user): void
    {
        $doctrineUser = new UserDoctrineEntity(
            $user->getDocument(),
            $user->getFullName(),
            $user->getEmail(),
            $user->getPhone()
        );

        $this->entityManager->remove($doctrineUser);
        $this->entityManager->flush();
    }
}
