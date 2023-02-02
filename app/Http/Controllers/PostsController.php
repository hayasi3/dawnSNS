<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class PostsController extends Controller
{
    //
    public function index(){
        $posts = DB::table('posts')
        ->join('users','posts.user_id','users.id')
        ->select('posts.id','posts.user_id','posts.posts','posts.created_at','users.username','users.images')
        ->get();

        $user = DB::table('users')
        ->where('id',Auth::id())
        ->first();

        $follow_count = DB::table('follows')
        ->where('follower',Auth::id())
        ->count();

        $follower_count = DB::table('follows')
        ->where('follow',Auth::id())
        ->count();

        return view('posts.index',['posts'=>$posts,'user'=>$user,'follow_count'=>$follow_count,'follower_count'=>$follower_count]);
    }

    public function create(Request $request){
        DB::table('posts')
        ->insert([
            'user_id'=>Auth::id(),
            'posts'=>$request->input('newpost'),
            'created_at'=>now(),
        ]);
        return back();
    }

    public function delete(Request $request){
        $id = $request->id;
        DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('/top');
    }

    public function update(Request $request)
    {
        $id = $request->input('id');//35行目と同じ意味
        $up_post = $request->input('editpost');
        DB::table('posts')
            ->where('id', $id)
            ->update(
                ['posts' => $up_post]
            );

        return redirect('/top');
    }

    public function test(){
        $posts = DB::table('posts')
            ->select('posts.id','posts.user_id','posts.posts','posts.created_at')
            ->where('user_id',Auth::id())
            ->get();

        return view('posts.test',['posts'=>$posts]);
    }
}
