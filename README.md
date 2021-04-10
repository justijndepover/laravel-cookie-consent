# Laravel Cookie Consent

[![Latest Version on Packagist](https://img.shields.io/packagist/v/justijndepover/laravel-cookie-consent.svg?style=flat-square)](https://packagist.org/packages/justijndepover/laravel-cookie-consent)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/justijndepover/laravel-cookie-consent.svg?style=flat-square)](https://packagist.org/packages/justijndepover/laravel-cookie-consent)

Make your Laravel application comply with the EU cookie law.

## Caution
This application is still in development and could implement breaking changes. Please use at your own risk.

## Explanation
This package stores all cookies in the database. Each cookie can be enabled / disabled by the user of your Laravel application.
Accepting the cookie banner will load all cookies within the same request and execute them. (This is great for page trackers)

A cookie bar will be added to your application with 2 options:
- Accept: All cookie scripts will be loaded. (through javascript in the same request and all concurrent requests)
- Decline: Not a single cookie script will be loaded.

![dialog](https://raw.githubusercontent.com/justijndepover/laravel-cookie-consent/master/docs/screenshot.png)

After confirming / denying the cookie bar, the user still has the option to change his preferences.

The cookie value will always contain a encrypted list with the cookie id's that are turned of. Therefore, adding in a new cookie, has to be disabled by the end user again.

## Installation
You can install the package with composer
```sh
composer require justijndepover/laravel-cookie-consent
```

After installation you have to publish the migration, if you don't have a cookies table / model
```sh
php artisan vendor:publish --tag="laravel-cookie-consent-migration"
php artisan migration
```

And optionally publish the configuration file
```sh
php artisan vendor:publish --tag="laravel-cookie-consent-config"
```

### model setup
Your `Cookie` class should also use the `InteractsWithCookies` trait.
```php
use Justijndepover\CookieConsent\Concerns\InteractsWithCookies; // add this line

class Cookie
{
    use InteractsWithCookies; // add this line
}
```

## configuration
This is the config file
```php
return [

    /*
     * Use this setting to enable the cookie consent dialog.
     */
    'enabled' => env('COOKIE_CONSENT_ENABLED', true),

    /*
     * The name of the cookie in which we store if the user
     * has agreed to accept the conditions.
     */
    'cookie_name' => 'laravel_cookie_consent',

    /*
     * Set the cookie duration in days.  Default is 365 * 20.
     */
    'cookie_lifetime' => 365 * 20,

    /*
     * Set the model class that represents the cookies table
     * Make sure your Cookie model implements the InteractsWithCookies trait
     */
    'cookie_class' => \App\Models\Cookie::class,

    /*
     * These middleware will get attached onto each Laravel Cookie Consent route, giving you
     * the chance to add your own middleware to this list or change any of
     * the existing middleware. Or, you can simply stick with this list.
     */
    'middleware' => ['web'],

];
```

## Usage
include the following in your app layout to render the cookie bar:
```blade
// before the closing body tag
@include('cookie-consent::bar', ['text' => 'This website makes use of cookies', 'accept' => 'Accept', 'cancel' => 'Refuse'])
```

## toggle cookies
You as the developer should provide a page where each cookie is rendered in a table list. To let the end user toggle each cookie, make a post request as followed:
```blade
@foreach ($cookies as $cookie) <!-- get the cookies from database -->
    <form action="{{ route('cookies.toggle', ['cookie' => $cookie]) }}" method="POST">
        @csrf

        @if ($cookie->isEnabled())
            <button type="submit" class="bg-green-200 text-green-600 text-xs rounded-full px-2 py-1">Active</button>
        @else
            <button type="submit" class="bg-red-200 text-red-600 text-xs rounded-full px-2 py-1">Not active</button>
        @endif
    </form>
@endforeach
```

The endpoint `cookies.toggle` is setup by the package and will toggle whether or not the cookie should be rendered.

## Styling
The package comes with a default tailwind styling. If you want to customize the layout, you should publish the view
```sh
php artisan vendor:publish --tag="laravel-cookie-consent-view"
```

Now you can edit the layout yourself.

The script loaded by the plugin expects the buttons to have a data attribute as followed:

```html
<button data-refuse-cookies>Decline</button>
<button data-accept-cookies>Accept</button>
```

## Security
If you find any security related issues, please open an issue or contact me directly at [justijndepover@gmail.com](justijndepover@gmail.com).

## Contribution
If you wish to make any changes or improvements to the package, feel free to make a pull request.

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
