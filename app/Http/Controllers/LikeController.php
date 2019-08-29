<?php
namespace App\Http\Controllers;
use App\Services\LikeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

class LikeController extends Controller
{
    private $like_service;
    
    public function __construct(LikeService $like_service)
    {
        $this->like_service = $like_service;
    }

    public function likeTopost(Request $request)
    {
        $this->like_service->To_likePost($request->all());
        return redirect('home');
    }

    public function userTolike()
    {
        $filename = $_POST["post"];
        return view('profiles.likeuser', ['filename' => $filename]);
    }

    public function likeTodelete(Request $request)
    {
        $this->like_service->To_likeDelete($request->all());
        return redirect('home');
    }

}
