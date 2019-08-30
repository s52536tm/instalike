<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Model\Post;

class PostRepository
{
    public function getPostsid($filename)
    {
        $res_posts_id = DB::table('posts')->where('picture', $filename)->value('id');
        return ($res_posts_id);
    }

    public function getPost_userid($filename)
    {
        $res_user_id = DB::table('posts')->where('picture', $filename)->value('github_id');
        return ($res_user_id);
    }

    public function getPost_username($filename)
    {
        $res_user_name = DB::table('posts')->where('picture', $filename)->value('github_name');
        return ($res_user_name);
    }

    public function getPost_likeduser($liked_posts_id)
    {
        $res_liked_user_name =  DB::table('posts')->where('id', $liked_posts_id)->value('github_name');
        return ($res_liked_user_name);
    }

    public function getPost_caption($filename)
    {
        $res_caption = DB::table('posts')->where('picture', $filename)->value('caption');
        return ($res_caption);
    }


    

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