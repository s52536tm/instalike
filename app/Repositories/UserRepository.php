<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Model\Post;

class UserRepository
{
    public function getUserInfo(){
        $res_userinfo = Auth::user();
        return ($res_userinfo);
    }

    public function getUserid($login_user_id){
        $res_user_id = DB::table('users')->where('github_id', $login_user_id)->max('id');
        return ($res_user_id);
    }

    
}