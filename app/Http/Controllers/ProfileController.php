<?php
namespace App\Http\Controllers;

use App\Services\PostService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

class ProfileController extends Controller
{
    private $post_service;
    
    public function __construct(PostService $post_service)
    {
        $this->post_service = $post_service;
    }

    public function index()
    {
        $post = $this->post_service->To_getPost();
        return view('profiles.profile', ['files' => $post]);
    }
}