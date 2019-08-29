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
}