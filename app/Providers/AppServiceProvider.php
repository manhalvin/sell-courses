<?php

namespace App\Providers;

use App\Services\API\AuthService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\API\UserRepository;
use App\Interfaces\API\Services\AuthServiceInterface;
use App\Interfaces\API\Repositories\UserRepositoryInterface;
use App\Interfaces\API\Repositories\VerificationCodeRepositoryInterface;
use App\Repositories\Eloquent\API\VerificationCodeRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            AuthServiceInterface::class,
            AuthService::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            VerificationCodeRepositoryInterface::class,
            VerificationCodeRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
