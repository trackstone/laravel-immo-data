<?php

declare(strict_types=1);

namespace ImmoData\Laravel\Tests;

use ImmoData\Laravel\Facades\ImmoData;
use ImmoData\Resources\GeocodeResource;
use ImmoData\Resources\GeoResource;
use ImmoData\Resources\MarketResource;
use ImmoData\Resources\ValuationResource;

final class FacadeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app['config']->set('immo-data.api_key', 'test-key');
    }

    public function test_facade_resolves_valuation_resource(): void
    {
        $this->assertInstanceOf(ValuationResource::class, ImmoData::valuation());
    }

    public function test_facade_resolves_geocode_resource(): void
    {
        $this->assertInstanceOf(GeocodeResource::class, ImmoData::geocode());
    }

    public function test_facade_resolves_geo_resource(): void
    {
        $this->assertInstanceOf(GeoResource::class, ImmoData::geo());
    }

    public function test_facade_resolves_market_resource(): void
    {
        $this->assertInstanceOf(MarketResource::class, ImmoData::market());
    }
}
