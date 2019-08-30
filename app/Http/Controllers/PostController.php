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

        $users_id = array();
        $users_name = array();
        $liked_flag = array();
        $captions = array();
        $count = 0;

        foreach($posts as $post){
            $users_id = $users_id +  array($count => $this->post_service->To_getPost_userid($post));
            $users_name = $users_name +  array($count => $this->post_service->To_getPost_username($post));
            $captions = $captions +  array($count => $this->post_service->To_getPost_caption($post));

            $count = $count + 1;
        }

        $count = 0;

        if(!empty($userinfo->github_id)):
            $login_user_id = $userinfo->github_id;
            $login_user_name = $userinfo->github_name;
            $user_id = $this->post_service->To_getUserid($login_user_id);

            $liked_users = $this->like_service->To_getLikeid($login_user_id);


            for($i = 0; ; $i++){
                if(empty($liked_users[$i]->users_id)){
                    break;
                }else{
                    $liked_id = $this->post_service->To_getlikedUserInfo($liked_users[$i]->users_id,'github_id');
                    $liked_name = $this->post_service->To_getlikedUserInfo($liked_users[$i]->users_id,'github_name');

                    if(($liked_id == $login_user_id) & ($liked_name == $login_user_name)){
                        $liked_users = $this->like_service->To_updateLike($liked_users[$i]->users_id, $user_id);
                    }
                }
            }

            foreach($posts as $post){
                $liked_users_id = $this->post_service->To_getUsersid($login_user_id);
                $liked_posts_id = $this->post_service->To_getPostsid($post);
                $liked_flag = $liked_flag + array($count => $this->like_service->To_countLike($liked_users_id, $liked_posts_id));

                $count = $count + 1;
            }
        
            return view('home', ['files' => $posts, 'userinfo' => $userinfo, 'user_id' => $user_id, 'liked_users' => $liked_users, 'users_id' => $users_id, 'users_name' => $users_name, 'captions' => $captions, 'liked_flag' => $liked_flag]);
        
        else:
    
            return view('home', ['files' => $posts, 'userinfo' => $userinfo, 'users_id' => $users_id, 'users_name' => $users_name, 'captions' => $captions]);

        endif;
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

    public function destroy($filename,Request $request)
    {
        $params = $request->all() + array('post' => $filename);
        $this->like_service->To_likeDelete($params);
        $this->post_service->To_deletePost($filename);
        return redirect('home');
    }
}