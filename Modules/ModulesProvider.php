<?php

namespace Modules;

use Illuminate\Support\ServiceProvider;

class ModulesProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $modules = [
            \Modules\UsersModule\Providers\UsersModuleServiceProvider::class
        ];

        foreach ($modules as $module) {
            app()->register($module);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
