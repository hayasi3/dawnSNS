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
        ->get();

        $user = DB::table('users')
        ->where('id',Auth::id())
        ->first();
        return view('posts.index',['posts'=>$posts,'user'=>$user]);
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

    public function delete($posts)
    {
        DB::table('posts')
            ->where('posts', $posts)
            ->delete();
 
        return redirect('/index');
    }
}
