<?php

return [
    'apiKey' => env('COINBASE_API_KEY'),
    'apiVersion' => env('COINBASE_API_VERSION', '2018-03-22'),

    'webhookSecret' => env('COINBASE_WEBHOOK_SECRET'),
    'webhookJobs' => [
        // 'charge:created' => \App\Jobs\CoinbaseWebhooks\HandleCreatedCharge::class,
        // 'charge:confirmed' => \App\Jobs\CoinbaseWebhooks\HandleConfirmedCharge::class,
        // 'charge:failed' => \App\Jobs\CoinbaseWebhooks\HandleFailedCharge::class,
        // 'charge:delayed' => \App\Jobs\CoinbaseWebhooks\HandleDelayedCharge::class,
        // 'charge:pending' => \App\Jobs\CoinbaseWebhooks\HandlePendingCharge::class,
        // 'charge:resolved' => \App\Jobs\CoinbaseWebhooks\HandleResolvedCharge::class,
    ],
    'webhookModel' => Antimech\Coinbase\Models\CoinbaseWebhookCall::class,
];
