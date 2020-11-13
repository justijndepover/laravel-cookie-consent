<?php

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
     */
    'cookie_class' => \App\Models\Cookie::class,

    /*
     * These middleware will get attached onto each Laravel Cookie Consent route, giving you
     * the chance to add your own middleware to this list or change any of
     * the existing middleware. Or, you can simply stick with this list.
     */
    'middleware' => ['web'],

];
