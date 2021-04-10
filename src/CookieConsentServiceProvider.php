<?php

namespace Justijndepover\CookieConsent;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\View\View;
use DB;

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
                __DIR__.'/../resources/views/cookiebar.blade.php' => base_path('resources/views/vendor/cookie-consents/cookiebar.blade.php'),
            ], 'laravel-cookie-consent-view');
        }

        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'cookie-consent');

        $this->app['view']->composer('cookie-consent::bar', function (View $view) {
            $class = config('cookie-consent.cookie_class');

            if (class_exists($class)) {
                $object = new $class;
            } else {
                $object = '';
            }

            $ignoredCookies = explode(',', request()->cookie(config('cookie-consent.cookie_name')));

            if ($object instanceof \Illuminate\Database\Eloquent\Model) {
                $cookies = $object->get()->filter(function ($cookie) use ($ignoredCookies) {
                    return ! in_array($cookie->id, $ignoredCookies);
                })->pluck('content')->implode("\n");
            }

            $view->with('cookies', $cookies ?? '');
        });
    }
}
