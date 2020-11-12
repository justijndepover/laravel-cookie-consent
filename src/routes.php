<?php

use Justijndepover\CookieConsent\Controllers\CookieConsentController;

Route::middleware(config('cookie-consent.middleware'))->group(function () {
    Route::post('/cookie-consent', [CookieConsentController::class, 'index']);
    Route::get('/cookie-consent/{cookie}/toggle', [CookieConsentController::class, 'toggle']);
});
