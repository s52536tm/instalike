@extends('layouts.login_layout')
@section('content')

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>ログイン画面</title>
    </head>
    <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
        var clickFlg = true;
        jQuery(function($) {
            $(".btn").on("click", function() {
                if(clickFlg) {
                    // イベント処理中はフラグをoffにします。
                    clickFlg = false;
                    // クリック処理を実施
                } else {
                    // イベント処理中は処理しない
                    return false;
                }
            });
        });
    </script>

    
    <body>
        @auth
        <meta http-equiv="Refresh" content="0;URL=home">
        @endauth
        @guest
        <form action="home" method="get">
            <div class="button_wrapper">
                <button class="btn btn-primary">Guestとして<br>ログイン</button>
            </div>
        </form>
        <form action="login/github" method="get">
            <div class="button_wrapper">
                <button class="btn btn-success">Githubで<br>ログイン</button>
            </div>
        </form>
        @endguest
    </body>
</html>

@endsection
