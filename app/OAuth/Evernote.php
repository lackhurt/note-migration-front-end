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

    public function authorize($callback) {
        return $this->oauthHandler->authorize($this->apiKey, $this->apiSecret, $callback);
    }
}