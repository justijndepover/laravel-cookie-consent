<?php

namespace Justijndepover\CookieConsent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CookieConsentController
{
    public function index(Request $request)
    {
        $class = config('cookie-consent.cookie_class');

        if (! class_exists($class)) {
            return response('');
        }

        $object = new $class;

        if (! $object instanceof \Illuminate\Database\Eloquent\Model) {
            return response('');
        }

        Cookie::queue(
            config('cookie-consent.cookie_name'),
            (string) ((bool) $request->get('state') == false) ? $object->pluck('id')->implode(',') : '',
            config('cookie-consent.cookie_lifetime')
        );

        if ((bool) $request->get('state') == false) {
            return response('');
        }

        $cookies = $object->pluck('content')->implode("\n");

        return response($cookies);
    }

    public function toggle($id)
    {
        $ignoredCookies = explode(',', request()->cookie(config('cookie-consent.cookie_name')));

        if (in_array($id, $ignoredCookies)) {
            if (($key = array_search($id, $ignoredCookies)) !== false) {
                unset($ignoredCookies[$key]);
            }
        } else {
            array_push($ignoredCookies, $id);
        }

        foreach ($ignoredCookies as $key => $value) {
            if ($value == '') {
                unset($ignoredCookies[$key]);
            }
        }

        $ignoredCookies = implode(',', $ignoredCookies);

        return redirect()->back()->cookie(
            config('cookie-consent.cookie_name'), $ignoredCookies, config('cookie-consent.cookie_lifetime')
        );
    }
}
