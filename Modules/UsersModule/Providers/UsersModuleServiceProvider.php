<?php

namespace Modules\UsersModule\Providers;

use Illuminate\Support\ServiceProvider;


class UsersModuleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->publishes([__DIR__ . '/../Database/migrations/' => database_path('migrations')], 'migrations');
        
        $this->app->register(UsersModuleRouteServiceProvider::class);
        $this->app->register(UsersModuleRepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
