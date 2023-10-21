<?php

namespace Antimech\Coinbase\Tests\Http\Middleware;

use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\CoversClass;
use Antimech\Coinbase\Tests\TestCase;
use Antimech\Coinbase\Http\Middleware\VerifySignature;

#[CoversClass(VerifySignature::class)]
class VerifySignatureTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Route::post('coinbase-webhook', function () {
            return 'ok';
        })->middleware(VerifySignature::class);
    }

    /** @test */
    public function it_will_succeed_when_the_request_has_a_valid_signature(): void
    {
        $payload = ['event' => ['type' => 'charge:created']];

        $response = $this->postJson(
            'coinbase-webhook',
            $payload,
            ['X-CC-Webhook-Signature' => $this->determineCoinbaseSignature($payload)]
        );

        $response
            ->assertStatus(200)
            ->assertSee('ok');
    }

    /** @test */
    public function it_will_fail_when_the_signature_header_is_not_set(): void
    {
        $response = $this->postJson(
            'coinbase-webhook',
            ['event' => ['type' => 'charge:created']]
        );

        $response
            ->assertStatus(400)
            ->assertJson([
                'error' => 'The request did not contain a header named `X-CC-Webhook-Signature`.',
            ]);
    }

    /** @test */
    public function it_will_fail_when_the_signature_is_invalid(): void
    {
        $response = $this->postJson(
            'coinbase-webhook',
            ['event' => ['type' => 'charge:created']],
            ['X-CC-Webhook-Signature' => 'abc']
        );

        $response
            ->assertStatus(400)
            ->assertSee('found in the header named `X-CC-Webhook-Signature` is invalid');
    }
}