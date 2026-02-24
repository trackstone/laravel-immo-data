<?php

declare(strict_types=1);

namespace ImmoData\Laravel\Tests;

use ImmoData\ImmoDataClient;

final class ServiceProviderTest extends TestCase
{
    public function test_registers_client_as_singleton(): void
    {
        $this->app['config']->set('immo-data.api_key', 'test-key');
        $this->app['config']->set('immo-data.base_url', 'https://api.immo-data.fr');

        $client1 = $this->app->make(ImmoDataClient::class);
        $client2 = $this->app->make(ImmoDataClient::class);

        $this->assertInstanceOf(ImmoDataClient::class, $client1);
        $this->assertSame($client1, $client2);
    }

    public function test_resolves_via_alias(): void
    {
        $this->app['config']->set('immo-data.api_key', 'test-key');

        $client = $this->app->make('immo-data');

        $this->assertInstanceOf(ImmoDataClient::class, $client);
    }

    public function test_merges_default_config(): void
    {
        $config = $this->app['config']->get('immo-data');

        $this->assertArrayHasKey('api_key', $config);
        $this->assertArrayHasKey('base_url', $config);
        $this->assertSame('https://api.immo-data.fr', $config['base_url']);
    }

    public function test_config_values_are_used(): void
    {
        $this->app['config']->set('immo-data.api_key', 'custom-key');
        $this->app['config']->set('immo-data.base_url', 'https://staging.immo-data.fr');

        $client = $this->app->make(ImmoDataClient::class);

        $this->assertInstanceOf(ImmoDataClient::class, $client);
    }
}
