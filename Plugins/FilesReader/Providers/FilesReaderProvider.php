<?php

namespace Plugins\FilesReader\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Plugins\FilesReader\Commands\ReadDataCommand;
use Plugins\FilesReader\Events\ReadDataEvent;
use Plugins\FilesReader\Events\ReadDataHandler;

class FilesReaderProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->publishes([__DIR__ . '/../config/json.php' => config_path('json.php')], 'configs');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        if ($this->app->runningInConsole()) {
            $this->commands([
                ReadDataCommand::class,
            ]);
        }

        Event::listen(
            ReadDataEvent::class,
            ReadDataHandler::class,
        );
    }
}
