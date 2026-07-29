# Laravel Immo Data

[![Tests](https://github.com/trackstone/laravel-immo-data/actions/workflows/tests.yml/badge.svg)](https://github.com/trackstone/laravel-immo-data/actions/workflows/tests.yml)

Laravel integration for the [Immo Data PHP SDK](https://github.com/trackstone/immo-data-php-sdk) — French real estate data including property valuation, geocoding, geographic boundaries, and market prices.

## Requirements

- PHP 8.3+
- Laravel 11 or 12

## Installation

```bash
composer require trackstone/laravel-immo-data
```

The service provider and facade are auto-discovered. No manual registration needed.

## Configuration

Add your API key to `.env`:

```env
IMMO_DATA_API_KEY=your-api-key
```

Optionally publish the config file:

```bash
php artisan vendor:publish --tag=immo-data-config
```

This creates `config/immo-data.php`:

```php
return [
    'api_key'  => env('IMMO_DATA_API_KEY', ''),
    'base_url' => env('IMMO_DATA_BASE_URL', 'https://api.immo-data.fr'),
];
```

## Usage

### Via Facade

```php
use ImmoData\Laravel\Facades\ImmoData;
use ImmoData\Enums\{RealtyType, GeoLevel, Condition, Dpe};
use ImmoData\Requests\ValuationRequest;

// Valuation
$request = new ValuationRequest(
    longitude: 2.3488,
    latitude: 48.8534,
    realtyType: RealtyType::Apartment,
    nbRooms: 3,
    livingArea: 65.0,
    condition: Condition::Excellent,
    dpe: Dpe::C,
    elevator: true,
);

$result = ImmoData::valuation()->estimate($request);
echo $result->mainValuation; // 485000.0

// Geocode
$results = ImmoData::geocode()->search('Paris', [GeoLevel::City]);
echo $results[0]->label; // "Paris, Ile-de-France"

// Geographic data
$city = ImmoData::geo()->city('75056');
echo $city->cityName; // "Paris"

// Market data
$price = ImmoData::market()->currentPrice(
    code: '75',
    geoLevel: GeoLevel::Department,
    realtyType: RealtyType::Apartment,
);
echo $price->value; // EUR/m²
```

### Via Dependency Injection

```php
use ImmoData\ImmoDataClient;
use ImmoData\Enums\RealtyType;
use ImmoData\Requests\ValuationRequest;

class PropertyController extends Controller
{
    public function __construct(
        private readonly ImmoDataClient $immoData,
    ) {}

    public function estimate()
    {
        $request = new ValuationRequest(
            longitude: 2.3488,
            latitude: 48.8534,
            realtyType: RealtyType::Apartment,
            nbRooms: 3,
            livingArea: 65.0,
        );

        return $this->immoData->valuation()->estimate($request);
    }
}
```

### Via Service Container

```php
$client = app(ImmoData\ImmoDataClient::class);
$result = $client->geocode()->search('Lyon');
```

## Available Methods

| Resource | Method | Description |
|----------|--------|-------------|
| `valuation()` | `estimate(ValuationRequest)` | Property price estimation |
| `geocode()` | `search(string, ?GeoLevel[], int)` | Location search |
| `geo()` | `region(string)` | Get region by code |
| `geo()` | `department(string)` | Get department by code |
| `geo()` | `city(string)` | Get city by INSEE code |
| `geo()` | `district(string)` | Get district by code |
| `geo()` | `subdistrict(string)` | Get subdistrict (IRIS) by code |
| `market()` | `priceHistory(string, GeoLevel, RealtyType, ?string, ?string)` | Price history |
| `market()` | `currentPrice(string, GeoLevel, RealtyType)` | Current price per m² |
| `market()` | `saleDurationHistory(string, GeoLevel, ?string, ?string, DurationUnit)` | Sale-duration history |
| `market()` | `currentSaleDuration(string, GeoLevel, DurationUnit)` | Current average sale duration |
| `transactions()` | `search(TransactionsRequest)` | Real estate transactions (DVF) |
| `dpe()` | `search(DpeRequest)` | Search Energy Performance Diagnostics (DPE) |
| `dpe()` | `get(string)` | Get a single DPE by its ADEME number |
| `listings()` | `statistics(ListingsStatisticsRequest)` | Aggregated statistics on listings for sale |

For full documentation on request parameters, DTOs, enums, and error handling, see the [PHP SDK documentation](https://github.com/trackstone/immo-data-php-sdk).

## Code Style

This package uses [Laravel Pint](https://laravel.com/docs/pint) with the PER Coding Style preset.

```bash
# Fix code style
composer cs

# Check without fixing
composer cs:check
```

## Testing

```bash
composer test
```

## License

MIT
