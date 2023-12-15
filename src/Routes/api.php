<?php

Route::group(['prefix' => 'api',  'middleware' => 'api'], function() {
    Route::post('coinbase/webhook', \Antimech\Coinbase\Http\Controllers\WebhookController::class)->name('coinbase-webhook');
});