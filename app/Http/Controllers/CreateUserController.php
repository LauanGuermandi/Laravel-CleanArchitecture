<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\CreateUser\ICreateUserInputPort;
use App\Domain\UseCases\CreateUser\CreateUserRequestModel;
use App\Http\Requests\CreateUserRequest;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class CreateUserController extends Controller
{
    public function __construct(
        private ICreateUserInputPort $interactor,
    ) {
    }

    public function __invoke(CreateUserRequest $request): ?HttpResponse
    {
        $viewModel = $this->interactor->createUser(
            new CreateUserRequestModel($request->validated())
        );

        return $viewModel->getResponse();
    }
}
