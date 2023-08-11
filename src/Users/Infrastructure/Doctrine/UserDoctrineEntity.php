<?php

namespace Src\Users\Infrastructure\Doctrine;

use Doctrine\ORM\Mapping as ORM;
use Src\Users\Domain\UserEntity;
use Src\Users\Domain\ValueObjects\Document;
use Src\Users\Domain\ValueObjects\Email;
use Src\Users\Domain\ValueObjects\FullName;
use Src\Users\Domain\ValueObjects\Phone;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class UserDoctrineEntity extends UserEntity
{
    public function __construct(Document $document, FullName $fullName, Email $email, Phone $phone)
    {
        parent::__construct($document, $fullName, $email, $phone);
    }
}
