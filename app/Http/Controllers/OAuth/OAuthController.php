<?php

namespace App\Http\Controllers\OAuth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class OAuthController extends Controller
{
    public function getIndex() {
        $sandbox = true;

        $oauth_handler = new \Evernote\Auth\OauthHandler($sandbox);

        $key      = 'january9527';
        $secret   = '2956cb602e90c95e';
        $callback = 'http://pl.me:8008/oauth/index/callback';

        $oauth_handler->authorize($key, $secret, $callback);
    }

    public function getCallback(Request $request) {
        echo $request->get('oauth_token');
        echo '<br>';
        echo $request->get('oauth_verifier');

        $sandbox = true;

        $oauth_handler = new \Evernote\Auth\OauthHandler($sandbox);

        $key      = 'january9527';
        $secret   = '2956cb602e90c95e';
        $callback = 'http://pl.me:8008/oauth/index/callback';
        $result = $oauth_handler->authorize($key, $secret, $callback);

        var_dump($result);
    }
}
