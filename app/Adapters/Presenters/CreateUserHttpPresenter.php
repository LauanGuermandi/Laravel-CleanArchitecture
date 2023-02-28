<?php

namespace App\Adapters\Presenters;

use App\Adapters\ViewModels\HttpResponseViewModel;
use App\Domain\Interfaces\IViewModel;
use App\Domain\UseCases\CreateUser\ICreateUserOutputPort;
use App\Domain\UseCases\CreateUser\CreateUserResponseModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Throwable;

class CreateUserHttpPresenter implements ICreateUserOutputPort
{
    /**
     * @throws BindingResolutionException
     */
    public function userCreated(CreateUserResponseModel $model): IViewModel
    {
        return new HttpResponseViewModel(
            app('view')
                ->make('user.show')
                ->with(['user' => $model->getUser()])
        );
    }

    public function userAlreadyExists(CreateUserResponseModel $model): IViewModel
    {
        return new HttpResponseViewModel(
            app('redirect')
                ->route('user.create')
                ->withErrors(['create-user' => "User {$model->getUser()->getEmail()} alreay exists."])
        );
    }

    /**
     * @throws Throwable
     */
    public function unableToCreateUser(CreateUserResponseModel $model, Throwable $e): IViewModel
    {
        if (config('app.debug')) {
            throw $e;
        }

        return new HttpResponseViewModel(
            app('redirect')
                ->route('user.create')
                ->withErrors(['create-user' => "Error occured while creating user {$model->getUser()->getName()}"])
        );
    }
}
