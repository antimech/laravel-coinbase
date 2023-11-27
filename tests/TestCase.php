<?php

namespace Antimech\Coinbase\Tests;

use Antimech\Coinbase\Facades\Coinbase;
use Antimech\Coinbase\CoinbaseServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            CoinbaseServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [
            Coinbase::class,
        ];
    }

    protected function determineCoinbaseSignature(array $payload): string
    {
        $secret = config('coinbase.webhook_secret');

        $signature = hash_hmac('sha256', json_encode($payload), $secret);

        return $signature;
    }
}