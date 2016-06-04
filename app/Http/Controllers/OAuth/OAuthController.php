<?php

namespace App\Http\Controllers\OAuth;

use App\Note\NoteClient;
use App\NoteOAuth;
use App\OAuth\Evernote;
use App\User;
use App\Http\Controllers\Controller;
use EDAM\Types\Note;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class OAuthController extends Controller
{
    public function getIndex() {
        return view('oauth.index');
    }

    public function getAuth(Evernote $evernote) {
        $type = \Request::get('type');

        $evernote->authorize(env('APP_URL') . '/oauth/index/callback?type=' . $type);
    }

    public function getCallback(Request $request, Evernote $evernote) {
        $type = \Request::get('type');

        if (in_array($type, ['source', 'dist'])) {
            $result = $evernote->authorize();

            \Session::set("evernote." . $type . ".oauth_token", $result['oauth_token']);
//            echo "evernote." . $type . ".oauth_token";
//            echo $result['oauth_token'];
            return redirect('/oauth/index');
        } else {
            throw new \Exception('type must be source or dist!');
        }
    }

    public function getTestQueue(NoteOAuth $auth) {
        $auth->test();
    }

    public function getSend(NoteOAuth $auth) {
        $auth->send();
    }

    public function getReceive(NoteOAuth $auth) {
        $auth->receive();
    }

    public function getFib(NoteOAuth $auth) {
        $auth->rpcSend((int)\Request::get('num'));
    }

    public function getNotebooks(NoteClient $client) {
//        echo \Session::get('evernote.source.oauth_token');
        echo $client->fetchNotebooks(\Session::get('evernote.source.oauth_token'));
    }
}
