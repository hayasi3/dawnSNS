<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class PostsController extends Controller
{
    //
    public function index(){
        $posts = DB::table('posts')->get();
        return view('posts.index',['posts'=>$posts]);
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
}
