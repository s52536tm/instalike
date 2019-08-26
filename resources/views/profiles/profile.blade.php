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
            $login_user_id = Auth::user()->github_id;
            $login_user_name = Auth::user()->github_name;
        ?>
        <div class="card" style="width: 24%;">
            <img class="card-img-top" src="https://github.com/{{"${login_user_name}"}}.png" style="height: auto;">
        </div>
        
        <?php echo $login_user_name."<br />"; ?>
        @foreach ($files as $file)
            <div class="card" style="width: 24%;">
                <?php
                    $app_user_id = DB::table('posts')->where('picture', $file)->value('github_id');
                    $app_user_name = DB::table('posts')->where('picture', $file)->value('github_name');
                    if($app_user_id == $login_user_id & $app_user_name == $login_user_name ):
                ?>
                <img class="card-img-top" src="http://192.168.55.44:9000/instalike/{{"${file}"}}" style="height: auto;">
                <?php endif; ?>
            </div>
        @endforeach
    </div>
</html>

@endsection