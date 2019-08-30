<?php
namespace App\Http\Controllers;
use App\Services\LikeService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

class LikeController extends Controller
{
    private $like_service;
    private $post_service;
    
    public function __construct(LikeService $like_service, PostService $post_service)
    {
        $this->like_service = $like_service;
        $this->post_service = $post_service;
    }

    public function likeTopost(Request $request)
    {
        $this->like_service->To_likePost($request->all());
        return redirect('home');
    }

    public function userTolike()
    {
        $filename = $_POST["post"];
        $posts_id = $this->post_service->To_getPostsid($filename);
        $liked_users = $this->like_service->To_getLike_userid($posts_id);
        $user_name = $this->post_service->To_getLike_Usersid($liked_users);
        return view('profiles.likeuser', ['user_name' => $user_name]);
    }

    public function likeTodelete(Request $request)
    {
        $filename = $_POST['post'];
        $params = $request->all() + array('post' => $filename);
        $this->like_service->To_likeDelete($params);
        return redirect('home');
    }

}
