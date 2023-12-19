<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class MylistsController extends Controller
{
    public function index(){
        $user = DB::table('users')
        ->where('id',Auth::id())
        ->first();

        $follow_count = DB::table('follows')
        ->where('follower',Auth::id())
        ->count();

        $follower_count = DB::table('follows')
        ->where('follow',Auth::id())
        ->count();

        $mylists = DB::table('mylists')
        ->where('user_id',Auth::id())
        ->get();

        return view('mylists.index',compact('user','follow_count','follower_count','mylists'));
    }

    public function create(Request $request){
        $name = $request->newMylist;
        DB::table('mylists')
        ->insert([
            'user_id'=>Auth::id(),
            'name'=>$name,
            'created_at'=>now(),
        ]);
        return back();
    }

    public function delete(Request $request){
        $id = $request->id;

        DB::table('mylists')
        ->where('id',$id)->delete();

        return back();
    }

    public function update(Request $request){
        $id = $request->id;
        $name = $request->editMylist;

        DB::table('mylists')
        ->where('id',$id)
        ->update([
            'name'=>$name,
            'updated_at'=>now(),
        ]);

        return back();
    }

    public function detail_create(Request $request){
        $post_id = $request->post_id;
        $detail_id = $request->detail_id;

        DB::table('mylist_details')
        ->insert([
            'user_id'=>Auth::id(),
            'detail_id'=>$detail_id,
            'post_id'=>$post_id,
            'created_at'=>now(),
        ]);
        return back();
    }

    public function detail_index($id){
        $user = DB::table('users')
        ->where('id',Auth::id())
        ->first();

        $follow_count = DB::table('follows')
        ->where('follower',Auth::id())
        ->count();

        $follower_count = DB::table('follows')
        ->where('follow',Auth::id())
        ->count();

        $detail = DB::table('mylists')
        ->where('id',$id)
        ->first();

        $favorite_exsits = DB::table('favorites')
        ->where('user_id',Auth::id())
        ->get();

        $detail_post_ids = DB::table('mylist_details')
        ->where([
            'user_id'=>Auth::id(),
            'detail_id'=>$id,
            ])
        ->pluck('post_id');

        $detail_posts = DB::table('posts')
        ->join('users','posts.user_id','users.id')
        ->whereIn('posts.id',$detail_post_ids)//whereは単体のデータのみヒットする、検索が複数個の条件はwhereInにすると中にあるものすべて探す
        ->select('posts.id','posts.user_id','posts.posts','posts.created_at','users.username','users.images')
        ->get();


        return view('mylists.detail',compact('user','follow_count','follower_count','favorite_exsits','detail_posts','detail'));
    }

    public function detail_delete(Request $request){
        $post_id = $request->post_id;
        $detail_id = $request->detail_id;

        DB::table('mylist_details')
        ->where([
            'user_id'=>Auth::id(),
            'detail_id'=>$detail_id,
            'post_id'=>$post_id,
        ])->delete();
        
        return back();
    }
}
