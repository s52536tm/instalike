<?php
namespace App\Http\Controllers;

use App\Services\PostService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

class PostController extends Controller
{
    private $post_service;
    
    public function __construct(PostService $post_service)
    {
        $this->post_service = $post_service;
    }

    public function index()
    {
        $post = $this->post_service->To_getPost();
        return view('home', ['files' => $post]);
    }

    public function create()
    {
        return view('posts.post');
    }

    public function store(Request $request)
    {
        $this->post_service->To_store($request->all());
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
        $this->post_service->To_deletePost($filename);
        return redirect('home');
    }
}