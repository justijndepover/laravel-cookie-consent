<?php

namespace Justijndepover\CookieConsent;

use Illuminate\Support\ServiceProvider;

class CookieConsentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/cookie-consent.php', 'cookie-consent');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/cookie-consent.php' => config_path('cookie-consent.php'),
            ], 'laravel-cookie-consent-config');

            if (! class_exists('CreateCookiesTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_cookies_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_cookies_table.php'),
                ], 'laravel-cookie-consent-migration');
            }

            $this->publishes([
                __DIR__.'/../resources/views/bar.blade.php' => base_path('resources/views/vendor/cookieConsent/bar.blade.php'),
            ], 'laravel-cookie-consent-view');
        }

        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'cookieConsent');
    }
}
