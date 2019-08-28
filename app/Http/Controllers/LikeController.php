<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

class LikeController extends Controller
{
    public function likeTopost(){
        //echo "aaaaaaaaa";

        $now = date("Y/m/d H:i:s");
        $login_user_id = Auth::user()->github_id;
        $login_user_name = Auth::user()->github_name;
        $posts_id = DB::table('posts')->where('picture', $_POST["post"])->value('id');
        $users_id = DB::table('users')->where('github_id', $login_user_id)->max('id');
        //var_dump($posts_id);
        //var_dump($users_id);
        DB::insert('insert into public.likes (posts_id, users_id, created_at, updated_at) values (?, ?, ?, ?)', [$posts_id, $users_id, $now, $now]);
        return redirect('home');

    }

    public function userTolike(){
        $filename = $_POST["post"];
        return view('profiles.likeuser', ['filename' => $filename]);
    }

    public function likeTodelete(){

        $now = date("Y/m/d H:i:s");
        $login_user_id = Auth::user()->github_id;
        $posts_id = DB::table('posts')->where('picture', $_POST["post"])->value('id');
        $users_id = DB::table('users')->where('github_id', $login_user_id)->max('id');

        DB::delete('delete from public.likes where posts_id=? and users_id=?', [$posts_id, $users_id]);
        return redirect('home');

    }

}




/*
    public function index()
    {

        $disk = Storage::disk('s3');
        $files = $disk->files('/');

        $next = 1;
        while(!empty($files[$next])){
            $app_updata = DB::table('posts')->where('picture', $files[$next-1])->value('updated_at');
            $next_updata = DB::table('posts')->where('picture', $files[$next])->value('updated_at');
            if($app_updata < $next_updata){
                $tmp = $files[$next-1];
                $files[$next-1] = $files[$next];
                $files[$next] = $tmp;
                $next = 0;
            }
            $next = $next + 1;
        }

        return view('home', ['files' => $files]);
    }

    public function create()
    {
        return view('posts.post');
    }

    public function store(Request $request)
    {
        $params = $request->validate([
            'image' => 'required|file|image|max:4000',
        ]);
        $file = $params['image'];
        $fileContents = file_get_contents($file->getRealPath());
        $disk = Storage::disk('s3');
        $disk->put($file->hashName(), $fileContents, 'public');

        $now = date("Y/m/d H:i:s");
        $user_id = Auth::user()->github_id;
        $user_name = Auth::user()->github_name;
        DB::insert('insert into public.posts (picture, caption, github_id, github_name, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [$file->hashName(), $_POST["caption"], $user_id, $user_name, $now, $now]);
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
        $disk = Storage::disk('s3');
        $disk->delete($filename);
        return redirect('home');
    }
}

*/