@extends('layouts.profile_layout')
@extends('layouts.header_layout')

@section('content')

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <title>profile</title>
    </head>
    <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script>
            var clickFlg = true;
            jQuery(function($) {
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
        <?php 
            $liked_count = 0;
            //$filename = $_POST["post"]
            //echo $filename;
            //$posts_id = DB::table('posts')->where('picture', $filename)->value('id');
            //$liked_users = DB::table('likes')->where('posts_id', $posts_id)->value('users_id');
            //$user_name = DB::table('users')->where('id', $liked_users)->value('github_name');

            if(!empty($user_name)):

        ?>
            <div class="card" style="width: 20%;">
                <img class="card-img-top" src="https://github.com/{{"${user_name}"}}.png" style="height: auto;">
            </div>
            <a href="/profile?user={{"${user_name}"}}" class='link'><?php echo $user_name ?></a>
            <?php endif; ?>
    </div>
</html>

@endsection