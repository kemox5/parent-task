<?php

namespace Modules\UsersModule\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\UsersModule\Interfaces\Repositories\TransactionRepositoryInterface;
use Modules\UsersModule\Repositories\TransactionRepository;

class UsersModuleRepositoryServiceProvider extends ServiceProvider
{

    const REPOSITORIES = [
        TransactionRepositoryInterface::class => TransactionRepository::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        foreach (self::REPOSITORIES as $interface => $repo) {
            $this->app->bind($interface, $repo);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
