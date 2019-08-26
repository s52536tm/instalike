<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * GitHubの認証ページヘユーザーをリダイレクト
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->scopes(['read:user', 'public_repo'])->redirect(); 
    }

    /**
     * GitHubからユーザー情報を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        $github_user = Socialite::driver('github')->user();
        
        $now = date("Y/m/d H:i:s");
        $app_user = DB::select('select * from public.users where github_id = ?', [$github_user->user['login']]);

        if (empty($app_user)) {
            $app_user = new User();
            $app_user->create([
            'github_id' => $github_user->id,
            'github_name' => $github_user->user['login'],
            
            //'github_name' => "ohayou",
        ]);
        }
        //$request->session()->put('github_token', $github_user->token);
        $app_user = User::latest('updated_at')->first();
        //DB::update('update public.users set github_name = ? where github_id = ?', [$github_user->name, $app_user]);
        Auth::login($app_user);
        
        return redirect('login');
    }
}