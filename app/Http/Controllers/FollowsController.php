<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class FollowsController extends Controller
{
    //
    public function followList(){
        return view('follows.followList');
    }

    public function followerList(){
        return view('follows.followerList');
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
        ->where('id', $id)
        ->delete();

        return redirect('/search');
    }
}
