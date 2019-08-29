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

    public function To_likeDelete(array $params)
    {
        $filename = $_POST['post'];
        $res_userinfo = $this->user_repository->getUserInfo();
        $user_id = $res_userinfo->github_id;

        $params = $params + array('post' => $filename, 'user_id' => $user_id);
        $params = $this->like_repository->getlike($params);

        $this->like_repository->deleteLike($params);
        return ('');
    }
}