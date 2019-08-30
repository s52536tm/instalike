<?php
namespace App\Http\Controllers;

use App\Services\PostService;
use App\Services\LikeService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

class ProfileController extends Controller
{
    private $post_service;
    private $like_service;
    
    public function __construct(PostService $post_service, LikeService $like_service)
    {
        $this->post_service = $post_service;
        $this->like_service = $like_service;
    }

    public function index()
    {
        $posts = $this->post_service->To_getPost();
        $userinfo = $this->post_service->To_getUserInfo();

        $users_name = array();
        $count = 0;
        $liked_count = 0;
        $profile_user = $_GET["user"];
        $users_id = $this->post_service->To_getUsername($profile_user);

        foreach($posts as $post){
            $users_name = $users_name +  array($count => $this->post_service->To_getPost_username($post));
            $count = $count + 1;
        }

        if(!empty($users_id)){
            $liked_posts = $this->like_service->To_getLike_postid();

            for($i = 0; ; $i++){
                if(empty($liked_posts[$i]->posts_id)){
                    break;
                }else{
                    $liked_count = $this->post_service->To_getPost_likeduser($liked_posts[$i]->posts_id, $profile_user, $liked_count);
                }
            }

        }

        return view('profiles.profile', ['files' => $posts, 'users_id' => $users_id, 'users_name' => $users_name, 'profile_user' => $profile_user, 'liked_count' => $liked_count]);
    }
    
}