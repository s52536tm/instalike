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

    public function getUsername($profile_user_name){
        $res_user_name = DB::table('users')->where('github_name', $profile_user_name)->max('id');
        return ($res_user_name);
    }

    public function getUsersid($login_user_id)
    {
        $res_users_id = DB::table('users')->where('github_id', $login_user_id)->max('id');
        return ($res_users_id);
    }

    public function getLike_Usersid($liked_users)
    {
        $res_user_name = DB::table('users')->where('id', $liked_users)->value('github_name');
        return ($res_user_name);
    }

    public function getlikedUserInfo($liked_user_id,$value){
        $res_liked_userinfo = DB::table('users')->where('id', $liked_user_id)->value($value);
        return ($res_liked_userinfo);
    }

    

    
}