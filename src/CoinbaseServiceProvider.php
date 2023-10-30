<?php

namespace Antimech\Coinbase;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CoinbaseServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/coinbase.php', 'coinbase'
        );

        $this->app->bind('coinbase', function ($app) {
            return new Coinbase($app);
        });

        $this->app->alias('coinbase', Coinbase::class);
    }

    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/coinbase.php' => config_path('coinbase.php'),
        ], 'config');

        $timestamp = '2018_06_01_215631';

        $this->publishes([
            __DIR__.'/../database/migrations/create_coinbase_webhook_calls_table.php.stub' => database_path("migrations/{$timestamp}_create_coinbase_webhook_calls_table.php"),
        ], 'migrations');

        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');
    }
}
