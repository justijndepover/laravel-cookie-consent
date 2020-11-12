<?php

namespace Justijndepover\CookieConsent\Controllers;

use Illuminate\Http\Request;

class CookieConsentController
{
    public function index(Request $request)
    {
        if ($request->cookie(config('cookie-consent.cookie_name')) != 'true') {
            return;
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
