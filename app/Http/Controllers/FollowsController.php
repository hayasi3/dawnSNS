<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class FollowsController extends Controller
{
    //
    public function followList(){
        $users = DB::table('users')
        ->leftjoin('posts','users.id','posts.user_id')
        ->leftjoin('follows','users.id','follows.follow')
        ->select('users.*','posts.posts','follows.follow','follows.follower')
        ->where('follows.follower',Auth::id())
        ->get();

        $user = DB::table('users')
        ->where('id',Auth::id())
        ->first();
        return view('follows.followList',compact('user','users'));
    }

    public function followerList(){
        $users = DB::table('users')
        ->leftjoin('posts','users.id','posts.user_id')
        ->leftjoin('follows','users.id','follows.follow')
        ->select('users.*','posts.posts','follows.follow','follows.follower')
        ->where('follows.follower',Auth::id())
        ->get();

        $user = DB::table('users')
        ->where('id',Auth::id())
        ->first();
        return view('follows.followerList',compact('user','users'));
    }

    public function follow(Request $request){
        $id = $request->id;
        DB::table('follows')
        ->insert([
            'follower'=>Auth::id(),
            'follow'=>$id
        ]);
        return back();
     }

    public function unfollow(Request $request){
        $id = $request->id;
        DB::table('follows')
        ->where('follow', $id)
        ->where('follower', Auth::id())
        ->delete();

        return redirect('/search');
    }
}
