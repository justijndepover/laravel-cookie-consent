# Laravel Cookie Consent

[![Latest Version on Packagist](https://img.shields.io/packagist/v/justijndepover/laravel-cookie-consent.svg?style=flat-square)](https://packagist.org/packages/justijndepover/laravel-cookie-consent)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/justijndepover/laravel-cookie-consent.svg?style=flat-square)](https://packagist.org/packages/justijndepover/laravel-cookie-consent)

Make your Laravel application comply with the EU cookie law.

## Explanation
This package stores all cookies in the database. Each cookie can be enabled / disabled by the user of your Laravel application.

A cookie bar will be added to your application with 2 options:
- confirm: All cookie scripts will be loaded. (through javascript in the same request and all concurrent requests)
- cancel: Not a single cookie script will be loaded.

![dialog](https://raw.githubusercontent.com/justijndepover/laravel-cookie-consent/master/docs/screenshot.png)

After confirming / denying the cookie bar, the user still has the option to change his preferences

## Caution
This application is still in development and could implement breaking changes. Please use at your own risk.

## Installation
You can install the package with composer
```sh
composer require justijndepover/laravel-cookie-consent
```

After installation you have to publish the migration
```sh
php artisan vendor:publish --tag="laravel-cookie-consent-migration"
php artisan migration
```

And optionally publish the configuration file
```sh
php artisan vendor:publish --tag="laravel-cookie-consent-config"
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

];
```

## Usage
include the following in your app layout:
```blade
// below your application javascript files
@include('cookie-consent::javascript')

// at the top of your body tag, all cookie scripts will be rendered here
@include('cookie-consent::scripts')

// before the closing body tag
@include('cookie-consent::bar')
```

## Security
If you find any security related issues, please open an issue or contact me directly at [justijndepover@gmail.com](justijndepover@gmail.com).

## Contribution
If you wish to make any changes or improvements to the package, feel free to make a pull request.

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
