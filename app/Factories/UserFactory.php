<?php

namespace App\Factories;

use App\Domain\Interfaces\IUserFactory;
use App\Domain\Interfaces\IUserEntity;
use App\Domain\ValueObjects\EmailValueObject;
use App\Domain\ValueObjects\PasswordValueObject;
use App\Models\User;

class UserFactory implements IUserFactory
{
    public function make(array $attributes = []): IUserEntity
    {
        if (isset($attributes['email']) && is_string($attributes['email'])) {
            $attributes['email'] = new EmailValueObject($attributes['email']);
        }

        if (isset($attributes['password']) && is_string($attributes['password'])) {
            $attributes['password'] = new PasswordValueObject($attributes['password']);
        }

        return new User($attributes);
    }
}
