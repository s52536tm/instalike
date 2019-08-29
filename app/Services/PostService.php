<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;

class PostService
{

    private $post_repository;
    private $user_repository;
    
    
    public function __construct(PostRepository $post_repository, UserRepository $user_repository)
    {
        $this->post_repository = $post_repository;
        $this->user_repository = $user_repository;
    }
    
    public function To_getPost()
    {
        $res_picture = $this->post_repository->getPost();
        $post = array();

        for($i = 0; ; $i++){
            if(!empty($res_picture[$i]->picture)){
                $post = $post + array($i => $res_picture[$i]->picture);
            }
            else{
                break;
            }
        }
        return ($post);
    }



    public function To_store(array $params)
    {
        $file = $params['image'];
        $fileContents = file_get_contents($file->getRealPath());
        $disk = Storage::disk('s3');
        $disk->put($file->hashName(), $fileContents, 'public');

        $filename = $file->hashName();
        $res_userinfo = $this->user_repository->getUserInfo();
        $user_id = $res_userinfo->github_id;
        $user_name = $res_userinfo->github_name;

        $params = $params + array('picture' => $filename, 'caption' => $_POST['caption'], 'github_id' => $user_id, 'github_name' => $user_name);
        $res_insert = $this->post_repository->insertPost($params);
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

    public function To_deletePost($filename)
    {
        $disk = Storage::disk('s3');
        $disk->delete($filename);

        $res_userinfo = $this->user_repository->getUserInfo();
        $user_id = $res_userinfo->github_id;
        $user_name = $res_userinfo->github_name;
        $res_delete = $this->post_repository->deletePost($filename, $user_id, $user_name);
        return ('');
    }
}