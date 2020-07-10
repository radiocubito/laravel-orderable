<?php

namespace Radiocubito\Orderable;

use Illuminate\Support\ServiceProvider;
use Radiocubito\Orderable\Commands\OrderableCommand;

class OrderableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/orderable.php' => config_path('orderable.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/orderable'),
            ], 'views');

            if (! class_exists('CreatePackageTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_orderable_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_orderable_table.php'),
                ], 'migrations');
            }

            $this->commands([
                OrderableCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'orderable');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/orderable.php', 'orderable');
    }
}
