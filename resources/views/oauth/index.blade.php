@extends('app')

@section('content')

    @if (\Session::has('evernote.source.oauth_token'))
    源已授权
    @else
    <a href="/oauth/index/auth?type=source" class="btn btn-primary btn-lg" role="button">Evernote授权(源)</a>
    @endif



    @if (\Session::has('evernote.dist.oauth_token'))
        目标已授权
    @else
        <a href="/oauth/index/auth?type=dist" class="btn btn-primary btn-lg" role="button">Evernote授权(目标)</a>
    @endif



@endsection
