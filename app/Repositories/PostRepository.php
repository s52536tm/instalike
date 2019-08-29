<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Model\Post;

class PostRepository
{

    public function getPost()
    {
        $res_picture = DB::table('posts')->orderBy('updated_at', 'desc')->get('picture');
        return ($res_picture);
    }

    public function insertPost(array $params)
    {
        Post::create($params);
        return ('');
    }

    public function deletePost($filename, $user_id, $user_name)
    {
        DB::delete('DELETE FROM public.posts WHERE picture = ? AND github_id = ? AND github_name = ?', [$filename, $user_id, $user_name]);
        return ('');
    }
}