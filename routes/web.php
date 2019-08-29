<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login.login');
})->name('login');

Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('logout/github', 'Auth\LogoutController@index');

Route::group(['middleware' => 'auth'], function() {
    Route::get('github', 'Github\GithubController@top');
 });

Route::resource('home', 'PostController', ['only' => ['index', 'create', 'store', 'show', 'destroy']]);

Route::get('profile', 'ProfileController@index');

Route::post('like', 'LikeController@likeTopost');
Route::post('like/user', 'LikeController@userTolike');
Route::post('like/delete', 'LikeController@likeTodelete');

Route::get('/test', function () {
    return view('test');
});
