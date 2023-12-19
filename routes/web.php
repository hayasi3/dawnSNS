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
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');


//ログイン中のページ
Route::group(['middleware' => 'auth'], function () {

Route::get('/top','PostsController@index');//->middleware('can:admin');→URLに指定すると('can:admin')のadminしか/topにアクセスできないようにできる

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

Route::get('/test', 'PostsController@test');

Route::get('/contact', 'ContactController@index')->name('index');

//確認ページ
Route::post('/contact/confirm', 'ContactController@confirm')->name('confirm');

//送信完了ページ
Route::post('/contact/send', 'ContactController@send')->name('send');

//問合せ履歴ページ
Route::get('/contact/history', 'ContactController@history')->name('history');

//いいね機能
Route::post('/favorite/create', 'PostsController@favorite_create');

Route::post('/favorite/delete', 'PostsController@favorite_delete');

Route::get('/favorite', 'PostsController@favorite')->name('favorite');

Route::get('/post/detail/{id}', 'PostsController@detail');

Route::post('/comment/create', 'CommentsController@create');

Route::delete('/comment/delete', 'CommentsController@delete');

Route::put('/comment/update', 'CommentsController@update');

Route::post('/block/create', 'UsersController@block_create');

Route::post('/block/delete', 'UsersController@block_delete');

Route::get('/mylist', 'MylistsController@index')->name('mylist');

Route::post('/mylist/create', 'MylistsController@create');

Route::delete('/mylist/delete', 'MylistsController@delete');

Route::put('/mylist/update', 'MylistsController@update');

Route::post('/detail/create', 'MylistsController@detail_create');

Route::get('/mylist/detail/{id}', 'MylistsController@detail_index');

Route::post('/detail/delete', 'MylistsController@detail_delete');

Route::get('/ranking', 'PostsController@ranking')->name('ranking');

Route::get('/ranking/week', 'PostsController@ranking_week')->name('ranking_week');

});