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
        <?php if(!empty($users_id)): ?>
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
                    $count = 0;
                    $app_user_name = $users_name[$count];
                    if($app_user_name == $profile_user ):
                ?>
                <img class="card-img-top" src="http://192.168.55.44:9000/instalike/{{"${file}"}}" style='width: 24% height: auto;'>
                <?php 
                    endif;
                    $count = $count + 1;
                ?>
            </div>
        @endforeach
        <?php endif; ?>
    </div>
</html>

@endsection