<?php

namespace Justijndepover\CookieConsent\Controllers;

use Illuminate\Http\Request;

class CookieConsentController
{
    public function index(Request $request)
    {
        \Cookie::queue(
            config('cookie-consent.cookie_name'),
            (bool) $request->get('state'),
            config('cookie-consent.cookie_lifetime')
        );

        if ((bool) $request->get('state') == false) {
            return response()->json();
        }

        $cookies = \DB::table('cookies')->pluck('content');
        return response()->json($cookies);
    }

    public function toggle($id)
    {
        // $email = Cookie::findOrFail($id);

        // return $email->body;
    }
}
