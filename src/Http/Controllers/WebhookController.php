<?php

namespace Antimech\Coinbase\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Antimech\Coinbase\Http\Middleware\VerifySignature;

class WebhookController extends Controller
{
    public function __construct()
    {
        $this->middleware(VerifySignature::class);
    }

    public function __invoke(Request $request): void
    {
        $payload = $request->input();

        $model = config('coinbase.webhook_model');

        $coinbaseWebhookCall = $model::create([
            'type' =>  $payload['event']['type'] ?? '',
            'payload' => $payload,
        ]);

        try {
            $coinbaseWebhookCall->process();
        } catch (\Exception $e) {
            $coinbaseWebhookCall->saveException($e);

            throw $e;
        }
    }
}