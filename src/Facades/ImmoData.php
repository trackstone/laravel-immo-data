<?php

declare(strict_types=1);

namespace ImmoData\Laravel\Facades;

use Illuminate\Support\Facades\Facade;
use ImmoData\Sdk\ImmoDataClient;
use ImmoData\Sdk\Resources\GeocodeResource;
use ImmoData\Sdk\Resources\GeoResource;
use ImmoData\Sdk\Resources\MarketResource;
use ImmoData\Sdk\Resources\ValuationResource;

/**
 * @method static ValuationResource valuation()
 * @method static GeocodeResource geocode()
 * @method static GeoResource geo()
 * @method static MarketResource market()
 *
 * @see ImmoDataClient
 */
class ImmoData extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'immo-data';
    }
}
