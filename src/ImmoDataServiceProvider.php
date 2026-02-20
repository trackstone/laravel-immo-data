<?php

declare(strict_types=1);

namespace ImmoData\Laravel;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use ImmoData\Sdk\ImmoDataClient;

class ImmoDataServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/immo-data.php' => config_path('immo-data.php'),
        ], 'immo-data-config');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/immo-data.php', 'immo-data');

        $this->app->singleton(ImmoDataClient::class, function (Application $app): ImmoDataClient {
            /** @var array{api_key: string, base_url: string} $config */
            $config = $app['config']['immo-data'];

            return new ImmoDataClient(
                apiKey: $config['api_key'],
                baseUrl: $config['base_url'],
            );
        });

        $this->app->alias(ImmoDataClient::class, 'immo-data');
    }
}
