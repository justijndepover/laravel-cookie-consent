<?php

namespace Justijndepover\CookieConsent\Concerns;

trait InteractsWithCookies
{
    public function isEnabled()
    {
        if (! request()->hasCookie(config('cookie-consent.cookie_name'))) {
            return false;
        }

        $ignoredCookies = explode(',', request()->cookie(config('cookie-consent.cookie_name')));

        return ! in_array($this->id, $ignoredCookies);
    }
}
