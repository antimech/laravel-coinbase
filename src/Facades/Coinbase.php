<?php

namespace Antimech\Coinbase\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getCharges() Lists all charges.
 * @method static array createCharge(array $params) Creates a new charge.
 * @method static array getCharge(string $chargeId) Retrieves an existing charge by supplying its id or 8 character short-code.
 * @method static array cancelCharge(string $chargeId) Cancels an existing charge by supplying its id or 8 character short-code.
 * @method static array resolveCharge(string $chargeId) Resolves an existing, unresolved charge by supplying its id or 8 character short-code.
 * @method static array getCheckouts() Lists all checkouts.
 * @method static array createCheckout(array $params = []) Creates a new checkout.
 * @method static array getCheckout(string $checkoutId) Retrieves an existing checkout.
 * @method static array updateCheckout(string $checkoutId, array $params = []) Updates an existing checkout.
 * @method static array deleteCheckout(string $checkoutId) Deletes an existing checkout.
 * @method static array getInvoices() Lists all invoices.
 * @method static array createInvoice(array $params) Creates a new invoice.
 * @method static array getInvoice(string $invoiceId) Retrieves an existing invoice by supplying its id or 8 character short-code.
 * @method static array voidInvoice(string $invoiceId) Voids an existing invoice by supplying its id or 8 character short-code.
 * @method static array resolveInvoice(string $invoiceId) Resolves an existing, unresolved invoice by supplying its id or 8 character short-code.
 * @method static array getEvents() Lists all events.
 * @method static array getEvent(string $eventId) Retrieves an existing event.
 *
 * @see \Antimech\Coinbase\Coinbase
 */
class Coinbase extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'Antimech\Coinbase\Coinbase';
    }
}
