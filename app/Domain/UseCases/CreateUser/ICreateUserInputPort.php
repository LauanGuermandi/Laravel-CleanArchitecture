<?php

namespace App\Domain\UseCases\CreateUser;

use App\Domain\Interfaces\IViewModel;

interface ICreateUserInputPort
{
    public function createUser(CreateUserRequestModel $model): IViewModel;
}

