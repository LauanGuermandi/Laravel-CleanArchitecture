<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Interfaces\IUserEntity;
use App\Domain\Interfaces\IUserRepository;
use App\Domain\ValueObjects\PasswordValueObject;
use App\Models\User;

class UserRepository implements IUserRepository
{
    public function exists(IUserEntity $user): bool
    {
        return User::where([
            'name' => $user->getName(),
            'email' => (string) $user->getEmail(),
        ])->exists();
    }

    public function create(IUserEntity $user, PasswordValueObject $password): User
    {
        return User::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $password,
        ]);
    }
}
