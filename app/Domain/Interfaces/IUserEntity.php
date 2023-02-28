<?php

namespace App\Domain\Interfaces;

use App\Domain\ValueObjects\EmailValueObject;
use App\Domain\ValueObjects\HashedPasswordValueObject;
use App\Domain\ValueObjects\PasswordValueObject;

interface IUserEntity
{
    public function getName(): string;

    public function setName(string $name): void;

    public function getEmail(): EmailValueObject;

    public function setEmail(EmailValueObject $email): void;

    public function getPassword(): HashedPasswordValueObject;

    public function setPassword(PasswordValueObject $password): void;
}
