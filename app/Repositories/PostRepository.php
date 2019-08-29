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
        //var_dump($params);
        Post::create($params);
        //DB::insert('insert into public.posts (picture, caption, github_id, github_name, updated_at) values (?, ?, ?, ?, ?)', [$filename, $_POST["caption"], $user_id, $user_name, $now]);
        return ('');
    }

    public function deletePost($filename, $user_id, $user_name)
    {
        DB::delete('DELETE FROM public.posts WHERE picture = ? AND github_id = ? AND github_name = ?', [$filename, $user_id, $user_name]);
        return ('');
    }
}