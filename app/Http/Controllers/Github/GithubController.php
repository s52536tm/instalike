<?php

namespace App\Http\Controllers\Github;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;

class GithubController extends Controller
{
    public function top(Request $request)
    {
        $token = $request->session()->get('github_token', null);

        try {
            $github_user = Socialite::driver('github')->userFromToken($token);
        } catch (\Exception $e) {
            return redirect('login/github');
        }

        return view('github', [
            'info' => var_dump($github_user),
            'nickname' => $github_user->nickname,
            'name' => $github_user->name,
            'avatar' => $github_user->avatar,
            'id' => $github_user->id,
        ]);
    }
}