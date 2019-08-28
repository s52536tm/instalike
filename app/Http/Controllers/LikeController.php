<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

class LikeController extends Controller
{
    public function likeTopost(){
        //echo "aaaaaaaaa";

        $now = date("Y/m/d H:i:s");
        $login_user_id = Auth::user()->github_id;
        $login_user_name = Auth::user()->github_name;
        $posts_id = DB::table('posts')->where('picture', $_POST["post"])->value('id');
        $users_id = DB::table('users')->where('github_id', $login_user_id)->max('id');
        //var_dump($posts_id);
        //var_dump($users_id);
        DB::insert('insert into public.likes (posts_id, users_id, created_at, updated_at) values (?, ?, ?, ?)', [$posts_id, $users_id, $now, $now]);
        return redirect('home');

    }

    public function userTolike(){
        $filename = $_POST["post"];
        return view('profiles.likeuser', ['filename' => $filename]);
    }

    public function likeTodelete(){

        $now = date("Y/m/d H:i:s");
        $login_user_id = Auth::user()->github_id;
        $posts_id = DB::table('posts')->where('picture', $_POST["post"])->value('id');
        $users_id = DB::table('users')->where('github_id', $login_user_id)->max('id');

        DB::delete('delete from public.likes where posts_id=? and users_id=?', [$posts_id, $users_id]);
        return redirect('home');

    }

}
