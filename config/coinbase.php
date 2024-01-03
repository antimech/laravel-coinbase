<?php

return [
    'api_key' => env('COINBASE_COMMERCE_API_KEY'),
    'api_version' => env('COINBASE_COMMERCE_API_VERSION', '2018-03-22'),

    'webhook_secret' => env('COINBASE_COMMERCE_WEBHOOK_SECRET'),
    'webhook_jobs' => [
        // 'charge:created' => \App\Jobs\CoinbaseWebhooks\HandleCreatedCharge::class,
        // 'charge:confirmed' => \App\Jobs\CoinbaseWebhooks\HandleConfirmedCharge::class,
        // 'charge:failed' => \App\Jobs\CoinbaseWebhooks\HandleFailedCharge::class,
        // 'charge:delayed' => \App\Jobs\CoinbaseWebhooks\HandleDelayedCharge::class,
        // 'charge:pending' => \App\Jobs\CoinbaseWebhooks\HandlePendingCharge::class,
        // 'charge:resolved' => \App\Jobs\CoinbaseWebhooks\HandleResolvedCharge::class,
    ],
    'webhook_model' => Antimech\Coinbase\Models\CoinbaseWebhookCall::class,
];
