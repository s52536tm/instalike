@extends('layouts.post_layout')
@extends('layouts.header_layout')

@section('content')

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <title>ホーム画面</title>
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
                $(".link").on("click", function() {
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

    <div class="cards">
    
    <?php $count = 0; ?>
    @auth
        @foreach ($files as $file)
            <div class="card" style="width: 24%;">
                <?php
                    $app_user_id = $users_id[$count];
                    $app_user_name = $users_name[$count];
                ?>

                <a href="/profile?user={{"${app_user_name}"}}" class='link'><?php echo $app_user_name ?></a>
                <img class="card-img-top" src="http://192.168.55.44:9000/instalike/{{"${file}"}}" style="height: auto;">
                
                <?php
                    $app_caption = $captions[$count];
                    echo $app_caption;

                    $login_user_id = $userinfo->github_id;
                    $login_user_name = $userinfo->github_name;
                    if($app_user_id == $login_user_id & $app_user_name == $login_user_name ):
                ?>

                        <div class="button_wrapper_">
                            <form action="/home/{{"${file}"}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-danger">削除</button>
                            </form>

                <?php if($liked_flag[$count] == 0): ?>

                            <form action="/like" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="post" value="{{"${file}"}}">
                                <button class="btn btn-warning">☆</button>
                            </form>

                        <?php else: ?>

                            <form action="/like/delete" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="post" value="{{"${file}"}}">
                                <button class="btn btn-warning">!</button>
                            </form>

                        <?php endif; ?>
                    <?php endif; ?>

                            <form action="/like/user" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="post" value="{{"${file}"}}">
                                <button class="btn btn-info">👤</button>
                            </form>
                        </div>

                    <?php $count = $count + 1; ?>
                    
            </div>
        @endforeach
    @endauth
    @guest
        @foreach ($files as $file)
            <div class="card" style="width: 24%;">
                <?php
                    $app_user_id = $users_id[$count];
                    $app_user_name = $users_name[$count];
                    echo $app_user_name;
                ?>
                <img class="card-img-top" src="http://192.168.55.44:9000/instalike/{{"${file}"}}" style="height: auto;">
                <?php
                    $app_caption = $captions[$count];
                    echo $app_caption;
                    $count = $count + 1;
                ?>
            </div>
        @endforeach
    @endguest
    </div>
</html>

@endsection