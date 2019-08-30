<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Repositories\LikeRepository;
use App\Repositories\UserRepository;

class LikeService
{

    private $like_repository;
    private $user_repository;
    
    public function __construct(LikeRepository $like_repository, UserRepository $user_repository)
    {
        $this->like_repository = $like_repository;
        $this->user_repository = $user_repository;
    }

    public function To_likePost(array $params)
    {
        $filename = $_POST['post'];
        $res_userinfo = $this->user_repository->getUserInfo();
        $user_id = $res_userinfo->github_id;

        $params = $params + array('post' => $filename, 'user_id' => $user_id);
        $params = $this->like_repository->getlike($params);
        $this->like_repository->insertLike($params);
        return ('');

    }

    public function To_getLikeid()
    {
        $res_liked_user = $this->like_repository->getLikeid();
        return ($res_liked_user);
    }

    public function To_getLike_postid()
    {
        $res_liked_post = $this->like_repository->getLike_postid();
        return ($res_liked_post);
    }

    public function To_getLike_userid($posts_id)
    {
        $res_liked_users = $this->like_repository->getLike_userid($posts_id);
        return ($res_liked_users);
    }

    public function To_updateLike($liked_user_id, $user_id)
    {
        $this->like_repository->updateLike($liked_user_id, $user_id);
        return ('');
    }

    public function To_countLike($liked_users_id, $liked_posts_id)
    {
        $res_liked_flag = $this->like_repository->countLike($liked_users_id, $liked_posts_id);
        //var_dump($res_liked_flag);
        return ($res_liked_flag);
    }

    public function To_likeDelete(array $params)
    {
        //$filename = $_POST['post'];
        $res_userinfo = $this->user_repository->getUserInfo();
        $user_id = $res_userinfo->github_id;

        $params = $params + array('user_id' => $user_id);
        $params = $this->like_repository->getlike($params);

        $this->like_repository->deleteLike($params);
        return ('');
    }
}