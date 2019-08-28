@extends('layouts.profile_layout')
@extends('layouts.header_layout')

@section('content')

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <title>profile</title>
    </head>
    <body>

        
    </body>

    <div class="cards">
        <?php 
            $liked_count = 0;
            $profile_user = $_GET["user"];
            $users_id = DB::table('users')->where('github_name', $profile_user)->max('id');
            if(!empty($users_id)):
            $liked_posts = DB::select('select posts_id from public.likes');
            for($i = 0; ; $i++){
                if(empty($liked_posts[$i]->posts_id)){
                    break;
                }else{
                    //var_dump($liked_posts[$i]->posts_id);
                    $be_liked_name = DB::table('posts')->where('id', $liked_posts[$i]->posts_id)->value('github_name');
                    if($be_liked_name == $profile_user){
                        $liked_count = $liked_count + 1;
                    }
                }
            }
        ?>
        <div class="card" style="width: 24%;">
            <img class="card-img-top" src="https://github.com/{{"${profile_user}"}}.png" style="height: auto;">
        </div>
        
        <?php
            echo "username：".$profile_user;
            echo " / totallike：".$liked_count."<br />";
        
        ?>
        @foreach ($files as $file)
            <div class="card" style="width: 24%;">
                <?php
                    //$app_user_id = DB::table('posts')->where('picture', $file)->value('github_id');
                    $app_user_name = DB::table('posts')->where('picture', $file)->value('github_name');
                    if($app_user_name == $profile_user ):
                ?>
                <img class="card-img-top" src="http://192.168.55.44:9000/instalike/{{"${file}"}}" style="height: auto;">
                <?php endif; ?>
            </div>
        @endforeach
        <?php endif; ?>
    </div>
</html>

@endsection