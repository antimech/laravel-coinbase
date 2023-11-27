<?php

namespace Antimech\Coinbase\Http\Middleware;

use Closure;
use Antimech\Coinbase\Exceptions\WebhookFailed;
use Symfony\Component\HttpFoundation\Response;

class VerifySignature
{
    public function handle($request, Closure $next): Response
    {
        $signature = $request->header('X-CC-Webhook-Signature');

        if (! $signature) {
            throw WebhookFailed::missingSignature();
        }

        if (! $this->isValid($signature, $request->getContent())) {
            throw WebhookFailed::invalidSignature($signature);
        }

        return $next($request);
    }

    protected function isValid(string $signature, string $payload): bool
    {
        $secret = config('coinbase.webhook_secret');

        if (empty($secret)) {
            throw WebhookFailed::sharedSecretNotSet();
        }

        $computedSignature = hash_hmac('sha256', $payload, $secret);

        return hash_equals($signature, $computedSignature);
    }
}