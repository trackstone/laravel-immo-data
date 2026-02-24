<?php

declare(strict_types=1);

namespace ImmoData\Laravel\Tests;

use ImmoData\Laravel\ImmoDataServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            ImmoDataServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'ImmoData' => \ImmoData\Laravel\Facades\ImmoData::class,
        ];
    }
}
