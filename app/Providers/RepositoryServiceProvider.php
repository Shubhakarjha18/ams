<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CompanyRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

    
        $this->app->bind(
            CompanyRepositoryInterface::class,
            CompanyRepository::class
        );
}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
