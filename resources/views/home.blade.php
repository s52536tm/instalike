@extends('layouts.post_layout')
@extends('layouts.header_layout')

@section('content')

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <title>ホーム画面</title>
    </head>
    <body>

        
    </body>

    <div class="cards">
    @auth
        @foreach ($files as $file)
            <div class="card" style="width: 50%;">
                <?php
                    $liked_flag = 0;
                    $app_user_id = DB::table('posts')->where('picture', $file)->value('github_id');
                    $app_user_name = DB::table('posts')->where('picture', $file)->value('github_name');
                ?>
                <a href="/profile"><?php echo $app_user_name ?></a>
                <img class="card-img-top" src="http://192.168.55.44:9000/instalike/{{"${file}"}}" style="height: auto;">
                <?php
                    $app_caption = DB::table('posts')->where('picture', $file)->value('caption');
                    echo $app_caption;

                    $login_user_id = Auth::user()->github_id;
                    $login_user_name = Auth::user()->github_name;
                    if($app_user_id == $login_user_id & $app_user_name == $login_user_name ):

                ?>
                        <div class="button_wrapper_">
                            <form action="/home/{{"${file}"}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-danger">削除</button>
                            </form>

                <?php 
                        $posts_id = DB::table('posts')->where('picture', $file)->value('id');
                        $users_id = DB::table('users')->where('github_id', $login_user_id)->max('id');
                        $liked_flag = DB::select('select count(*) from public.likes where posts_id = ? and users_id = ?', [$posts_id, $users_id]);
                        //echo $posts_id."<br />";
                        //echo $users_id."<br />";
                        //var_dump ($liked_flag[0]->count)."<br />";

                        if($liked_flag[0]->count == 0):
                ?>
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
            </div>
        @endforeach
    @endauth
    @guest
        @foreach ($files as $file)
            <div class="card" style="width: 50%;">
                <?php
                    $app_user_id = DB::table('posts')->where('picture', $file)->value('github_id');
                    $app_user_name = DB::table('posts')->where('picture', $file)->value('github_name');
                    echo $app_user_name;
                ?>
                <img class="card-img-top" src="http://192.168.55.44:9000/instalike/{{"${file}"}}" style="height: auto;">
                <?php
                    $app_caption = DB::table('posts')->where('picture', $file)->value('caption');
                    echo $app_caption;
                ?>
            </div>
        @endforeach
    @endguest
    </div>
</html>

@endsection