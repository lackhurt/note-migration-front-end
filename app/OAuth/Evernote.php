<?php
namespace App\OAuth;


class Evernote
{

    private $apiKey;
    private $apiSecret;
    private $oauthHandler;

    public function __construct() {

        $this->oauthHandler = new \Evernote\Auth\OauthHandler(env('NOTE_EVERNOTE_ENV_SANDBOX'));

        $this->apiKey = env('NOTE_EVERNOTE_API_KEY');
        $this->apiSecret = env('NOTE_EVERNOTE_API_SECRET');
    }

    public function authorize($callback = null) {
        error_reporting(E_WARNING);
        return $this->oauthHandler->authorize($this->apiKey, $this->apiSecret, $callback);
    }
}