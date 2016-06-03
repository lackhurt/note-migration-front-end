<?php
/**
 * Created by PhpStorm.
 * User: lackhurt
 * Date: 16/5/29
 * Time: 下午8:11
 */

namespace App\Http\Controllers;


use App\Note\NoteClient;
use App\OAuth\Evernote;

class HomeController extends Controller
{
    public function index(NoteClient $client) {

        $sourceNotebooks = [];
        $distNotebooks = [];
        if (\Session::has('evernote.source.oauth_token')) {
            $sourceNotebooksJson = $client->fetchNotebooks(\Session::get('evernote.source.oauth_token'));
            $sourceNotebooks = json_decode($sourceNotebooksJson, true);
        }

        if (\Session::has('evernote.dist.oauth_token')) {
            $distNotebooksJson = $client->fetchNotebooks(\Session::get('evernote.dist.oauth_token'));
            $distNotebooks = json_decode($distNotebooksJson, true);
        }

        return view('home.index')->with([
            'sourceNotebooks' => $sourceNotebooks,
            'distNotebooks' => $distNotebooks
        ]);
    }
}