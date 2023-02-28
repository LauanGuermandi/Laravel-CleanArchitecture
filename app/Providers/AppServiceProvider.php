<?php

namespace App\Providers;

use App\Adapters\Presenters;
use App\Domain;
use App\Factories;
use App\Infrastructure\Repositories;
use App\Domain\UseCases;
use App\Http\Controllers as HttpControllers;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            Domain\Interfaces\IUserFactory::class,
            Factories\UserFactory::class,
        );

        $this->app->bind(
            Domain\Interfaces\IUserRepository::class,
            Repositories\UserRepository::class,
        );

        $this->app
            ->when(HttpControllers\CreateUserController::class)
            ->needs(UseCases\CreateUser\ICreateUserInputPort::class)
            ->give(function ($app) {
                return $app->make(UseCases\CreateUser\CreateUserInteractor::class, [
                    'output' => $app->make(Presenters\CreateUserHttpPresenter::class),
                ]);
            });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
