<?php

namespace  Src\Users\Domain;

use Src\Shared\Domain\ValueObjects\Uuid;
use  Src\Users\Domain\ValueObjects\FullName;
use  Src\Users\Domain\ValueObjects\Email;
use  Src\Users\Domain\ValueObjects\Phone;
use Src\Users\Domain\ValueObjects\Document;

class UserEntity
{
    protected $document;
    protected $fullName;
    protected $email;
    protected $phone;
    protected $walletUuid;
    protected $id;

    public function __construct(
        int $id,
        Document $document,
        FullName $fullName,
        Email $email,
        Phone $phone,
        Uuid $walletUuid = null
    ) {
        $this->id = $id;
        $this->document = $document;
        $this->fullName = $fullName;
        $this->email = $email;
        $this->phone = $phone;
        $this->walletUuid= $walletUuid;

    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getDocument(): Document
    {
        return $this->document;
    }

    public function setDocument(Document $document): void
    {
        $this->document = $document;
    }

    public function getFullName(): FullName
    {
        return $this->fullName;
    }

    public function setFullName(FullName $fullName): void
    {
        $this->fullName = $fullName;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function setEmail(Email $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): Phone
    {
        return $this->phone;
    }

    public function setPhone(Phone $phone): void
    {
        $this->phone = $phone;
    }

    public function getWalletUuid(): Uuid
    {
        return $this->walletUuid;
    }

    public function setWalletUuid(Uuid $uuid): void
    {
        $this->walletUuid = $uuid;
    }


    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'document' => $this->document->getValue(),
            'fullName' => $this->fullName->getValue(),
            'email' => $this->email->getValue(),
            'phone' => $this->phone->getValue(),
            'walletUuid' => $this->walletUuid
        ];
    }
}
