<?php

use Illuminate\Support\Facades\Route;
use Justijndepover\CookieConsent\Controllers\CookieConsentController;

Route::middleware(config('cookie-consent.middleware'))->group(function () {
    Route::post('/cookie-consent', [CookieConsentController::class, 'index']);
    Route::post('/cookie-consent/{cookie}/toggle', [CookieConsentController::class, 'toggle'])->name('cookies.toggle');
});
