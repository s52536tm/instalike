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

class PostController extends Controller
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
        $login_user_id = $userinfo->github_id;
        $user_id = $this->post_service->To_getUserid($login_user_id);

        $liked_users = $this->like_service->To_getLikeid($login_user_id);

        $users_id = array();
        $users_name = array();
        $captions = array();
        $count = 0;

        foreach($posts as $post){
            $users_id = $users_id +  array($count => $this->post_service->To_getPost_userid($post));
            $users_name = $users_name +  array($count => $this->post_service->To_getPost_username($post));
            $captions = $captions +  array($count => $this->post_service->To_getPost_caption($post));
            $count = $count + 1;
        }
        return view('home', ['files' => $posts, 'userinfo' => $userinfo, 'user_id' => $user_id, 'liked_users' => $liked_users, 'users_id' => $users_id, 'users_name' => $users_name, 'captions' => $captions]);
    }

    public function create()
    {
        return view('posts.post');
    }

    public function store(Request $request)
    {
        $this->post_service->To_store($request->all());
        return redirect('home');
    }

    public function show($filename)
    {
        $disk = Storage::disk('s3');
        try {
            $contents = $disk->get($filename);
            $mimeType = $disk->mimeType($filename);
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], 404);
        }
        return response($contents)->header('Content-Type', $mimeType);
    }

    public function destroy($filename)
    {
        $this->post_service->To_deletePost($filename);
        return redirect('home');
    }
}