<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class CommentsController extends Controller
{
    public function create(Request $request){
        $id = $request->id;

        $newComment = $request->newcomment;

        DB::table('comments')
        ->insert([
            'user_id'=>Auth::id(),
            'post_id'=>$id,
            'body'=>$newComment,
            'created_at'=>now(),
        ]);

        return back();
    }

    public function delete(Request $request){
        $id = $request->id;
        DB::table('comments')
        ->where([
            'user_id'=>Auth::id(),
            'id'=>$id,
        ])->delete();

        return back();

    }

    public function update(Request $request){
        $id = $request->id;
        DB::table('comments')
        ->where([
            'user_id'=>Auth::id(),
            'id'=>$id,
        ])->update([
            'body'=>$request->upComment,
            'updated_at'=>now(),
        ]);

        return back();

    }
}