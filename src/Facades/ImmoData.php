<?php

declare(strict_types=1);

namespace ImmoData\Laravel\Facades;

use Illuminate\Support\Facades\Facade;
use ImmoData\ImmoDataClient;
use ImmoData\Resources\DpeResource;
use ImmoData\Resources\GeocodeResource;
use ImmoData\Resources\GeoResource;
use ImmoData\Resources\MarketResource;
use ImmoData\Resources\TransactionsResource;
use ImmoData\Resources\ValuationResource;

/**
 * @method static ValuationResource valuation()
 * @method static GeocodeResource geocode()
 * @method static GeoResource geo()
 * @method static MarketResource market()
 * @method static TransactionsResource transactions()
 * @method static DpeResource dpe()
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
