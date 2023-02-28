<?php

namespace App\Domain\UseCases\CreateUser;

use App\Domain\Interfaces\IUserFactory;
use App\Domain\Interfaces\IUserRepository;
use App\Domain\Interfaces\IViewModel;
use App\Domain\ValueObjects\PasswordValueObject;

class CreateUserInteractor implements ICreateUserInputPort
{
    public function __construct(
        private ICreateUserOutputPort $output,
        private IUserRepository       $repository,
        private IUserFactory          $factory,
    ) {
    }

    public function createUser(CreateUserRequestModel $model): IViewModel
    {
        $user = $this->factory->make([
            'name' => $model->getName(),
            'email' => $model->getEmail(),
        ]);

        if ($this->repository->exists($user)) {
            return $this->output->userAlreadyExists(new CreateUserResponseModel($user));
        }

        try {
            $user = $this->repository->create($user, new PasswordValueObject($model->getPassword()));
        } catch (\Exception $e) {
            return $this->output->unableToCreateUser(new CreateUserResponseModel($user), $e);
        }

        return $this->output->userCreated(
            new CreateUserResponseModel($user)
        );
    }
}
