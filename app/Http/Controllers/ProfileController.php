<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

class ProfileController extends Controller
{
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

        return view('profiles.profile', ['files' => $files]);
    }
}