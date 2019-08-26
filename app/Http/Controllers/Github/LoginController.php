<?php

namespace App\Http\Controllers\Github;

use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function top(Request $request)
    {
        $token = $request->session()->get('github_token', null);
        try {
            $github_user = Socialite::driver('github')->userFromToken($token);
        } catch (\Exception $e) {
            return redirect('github_login/re');
        }

        return view('home', [
            'info' => var_dump($github_user),
            'nickname' => $github_user->nickname,
            'name' => $github_user->name,
            'avatar' => $github_user->avatar,
            'id' => $github_user->id,
        ]);
    }
}