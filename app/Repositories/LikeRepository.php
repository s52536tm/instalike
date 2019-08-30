<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\Like;

class LikeRepository
{
    public function getLikeid()
    {   
        $res_liked_user = DB::select('select users_id from public.likes');
        return ($res_liked_user);
    }

    public function getLike_postid()
    {   
        $res_liked_post = DB::select('select posts_id from public.likes');
        return ($res_liked_post);
    }
 

    public function getLike(array $params)
    {   
        $res_posts_id = DB::table('posts')->where('picture', $params["post"])->value('id');
        $res_users_id = DB::table('users')->where('github_id', $params['user_id'])->max('id');

        $params = $params + array('posts_id' => $res_posts_id, 'users_id' => $res_users_id);
        return ($params);
    }

    public function getLike_userid($posts_id)
    {   
        $res_liked_users =  DB::table('likes')->where('posts_id', $posts_id)->value('users_id');
        return ($res_liked_users);
    }

    public function insertLike(array $params)
    {
        //var_dump($params);
        Like::create($params);
        //DB::insert('insert into public.posts (picture, caption, github_id, github_name, updated_at) values (?, ?, ?, ?, ?)', [$filename, $_POST["caption"], $user_id, $user_name, $now]);
        return ('');
    }

    public function updateLike($liked_user_id, $user_id)
    {
        DB::table('likes')->where('users_id', $liked_user_id)->update(['users_id' => (int)$user_id]);
        return ('');
    }

    public function countLike($liked_users_id, $liked_posts_id)
    {
        $res_liked_flag = DB::select('select count(*) from public.likes where posts_id = ? and users_id = ?', [$liked_posts_id, $liked_users_id]);
        return ($res_liked_flag[0]->count);
    }

    public function deleteLike(array $params)
    {
        DB::delete('delete from public.likes where posts_id=? and users_id=?', [$params['posts_id'], $params['users_id']]);
        return ('');
    }
}