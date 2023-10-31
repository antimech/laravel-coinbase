<?php

namespace Antimech\Coinbase;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Coinbase
{
    /**
     * @const string
     */
    private const BASE_URI = 'https://api.commerce.coinbase.com';

    private Client $client;

    public function __construct()
    {
        $apiKey = config('coinbase.apiKey');
        $apiVersion = config('coinbase.apiVersion');

        $this->client = new Client([
            'base_uri' => Coinbase::BASE_URI,
            'headers' => [
                'Content-Type' => 'application/json',
                'X-CC-Api-Key' => $apiKey,
                'X-CC-Version' => $apiVersion,
            ],
        ]);
    }

    /**
     * Make request.
     *
     * @param string $method
     * @param string $uri
     * @param array $query
     * @param array $params
     * @return array
     * @throws GuzzleException
     */
    private function makeRequest(string $method, string $uri, array $query = [], array $params = []): array
    {
        $response = $this->client->request($method, $uri, ['query' => $query, 'body' => json_encode($params)]);

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Lists all charges.
     *
     * @return array
     */
    public function getCharges(): array
    {
        return $this->makeRequest('get', 'charges');
    }

    /**
     * Creates a new charge.
     *
     * @param  array  $params
     * @return array
     */
    public function createCharge(array $params): array
    {
        return $this->makeRequest('post', 'charges', [], $params);
    }

    /**
     * Retrieves an existing charge by supplying its id or 8 character short-code.
     *
     * @param  string  $chargeId  Id or short-code for a previously created charge
     * @return array
     */
    public function getCharge(string $chargeId): array
    {
        return $this->makeRequest('get', "charges/{$chargeId}");
    }

    /**
     * Cancels an existing charge by supplying its id or 8 character short-code.
     *
     * <b>Note:</b> Only new charges can be successfully canceled.
     *
     * @param  string  $chargeId  Id or short-code for a previously created charge
     * @return array
     */
    public function cancelCharge(string $chargeId): array
    {
        return $this->makeRequest('post', "charges/{$chargeId}/cancel");
    }

    /**
     * Resolves an existing, unresolved charge by supplying its id or 8 character short-code.
     *
     * <b>Note:</b> Only unresolved charges can be successfully resolved.
     *
     * @param  string  $chargeId  Id or short-code for a previously created charge
     * @return array
     */
    public function resolveCharge(string $chargeId): array
    {
        return $this->makeRequest('post', "charges/{$chargeId}/resolve");
    }

    /**
     * Lists all checkouts.
     *
     * @return array
     */
    public function getCheckouts(): array
    {
        return $this->makeRequest('get', 'checkouts');
    }

    /**
     * Creates a new checkout.
     *
     * @param  array  $params
     * @return array
     */
    public function createCheckout(array $params = []): array
    {
        return $this->makeRequest('post', 'checkouts', [], $params);
    }

    /**
     * Retrieves an existing checkout.
     *
     * @param  string  $checkoutId
     * @return array
     */
    public function getCheckout(string $checkoutId): array
    {
        return $this->makeRequest('get', "checkouts/{$checkoutId}");
    }

    /**
     * Updates an existing checkout.
     *
     * @param  string  $checkoutId
     * @param  array   $params
     * @return array
     */
    public function updateCheckout(string $checkoutId, array $params = []): array
    {
        return $this->makeRequest('put', "checkouts/{$checkoutId}", [], $params);
    }

    /**
     * Deletes an existing checkout.
     *
     * @param  string  $checkoutId
     * @return array
     */
    public function deleteCheckout(string $checkoutId): array
    {
        return $this->makeRequest('delete', "checkouts/{$checkoutId}");
    }

    /**
     * Lists all invoices.
     *
     * @return array
     */
    public function getInvoices(): array
    {
        return $this->makeRequest('get', 'invoices');
    }

    /**
     * Creates a new invoice.
     *
     * @param  array  $params
     * @return array
     */
    public function createInvoice(array $params): array
    {
        return $this->makeRequest('post', 'invoices', [], $params);
    }

    /**
     * Retrieves an existing invoice by supplying its id or 8 character short-code.
     *
     * @param  string  $invoiceId Id or short-code for a previously created invoice
     * @return array
     */
    public function getInvoice(string $invoiceId): array
    {
        return $this->makeRequest('get', "invoices/{$invoiceId}");
    }

    /**
     * Voids an existing invoice by supplying its id or 8 character short-code.
     *
     * <b>Note:</b> Only invoices with OPEN or VIEWED status can be voided.
     *
     * @param  string  $invoiceId Id or short-code for a previously created invoice
     * @return array
     */
    public function voidInvoice(string $invoiceId): array
    {
        return $this->makeRequest('put', "invoices/{$invoiceId}/void");
    }

    /**
     * Resolves an existing, unresolved invoice by supplying its id or 8 character short-code.
     *
     * <b>Note:</b> Only invoices with an unresolved charge can be successfully resolved.
     *
     * @param  string  $invoiceId Id or short-code for a previously created invoice
     * @return array
     */
    public function resolveInvoice(string $invoiceId): array
    {
        return $this->makeRequest('put', "invoices/{$invoiceId}/resolve");
    }

    /**
     * Lists all events.
     *
     * @return array
     */
    public function getEvents(): array
    {
        return $this->makeRequest('get', 'events');
    }

    /**
     * Retrieves an existing event.
     *
     * @param  string  $eventId
     * @return array
     */
    public function getEvent(string $eventId): array
    {
        return $this->makeRequest('get', "events/{$eventId}");
    }
}
