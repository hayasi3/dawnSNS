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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');


//ログイン中のページ
Route::get('/top','PostsController@index');

Route::get('/profile','UsersController@profile');

Route::get('/search','UsersController@index');

Route::get('/logout', 'Auth\LoginController@logout');

Route::post('/post/create', 'PostsController@create');

Route::delete('post/delete', 'PostsController@delete');

Route::put('post/update', 'PostsController@update');

Route::post('/post/search', 'UsersController@search');

Route::post('/post/follow', 'FollowsController@follow');

Route::post('/post/unfollow', 'FollowsController@unfollow');

Route::get('/follow-list', 'FollowsController@followList');

Route::get('/follower-list', 'FollowsController@followerList');

Route::get('/other-prof/{id}', 'UsersController@otherProfile');

Route::post('/post/upProfile', 'UsersController@upProfile');