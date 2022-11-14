<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class UsersController extends Controller
{
    //
    public function index(Request $request){
        DB::table('posts')
        ->insert([
            'user_id'=>Auth::id(),
            'posts'=>$request->input('newpost'),
            'created_at'=>now(),
        ]);
        return view('posts.index');
    }

    public function profile(){
        $user = DB::table('users')
        ->where('id',Auth::id())
        ->first();
        return view('users.profile',compact('user'));
    }
    public function search(){
        return view('users.search');
    }
}
