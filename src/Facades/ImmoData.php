<?php

declare(strict_types=1);

namespace ImmoData\Laravel\Facades;

use Illuminate\Support\Facades\Facade;
use ImmoData\ImmoDataClient;
use ImmoData\Resources\GeocodeResource;
use ImmoData\Resources\GeoResource;
use ImmoData\Resources\MarketResource;
use ImmoData\Resources\ValuationResource;

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
