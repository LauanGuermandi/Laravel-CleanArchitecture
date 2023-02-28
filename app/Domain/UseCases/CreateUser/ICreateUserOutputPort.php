<?php

namespace App\Domain\UseCases\CreateUser;

use App\Domain\Interfaces\IViewModel;

interface ICreateUserOutputPort
{
    public function userCreated(CreateUserResponseModel $model): IViewModel;

    public function userAlreadyExists(CreateUserResponseModel $model): IViewModel;

    public function unableToCreateUser(CreateUserResponseModel $model, \Throwable $e): IViewModel;
}
