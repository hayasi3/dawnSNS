<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class ContactController extends Controller
{
    public function index()
    {
        $user=Auth::user();

        $follow_count = DB::table('follows')
        ->where('follower',Auth::id())
        ->count();

        $follower_count = DB::table('follows')
        ->where('follow',Auth::id())
        ->count();

        return view('contacts.index',compact('user','follow_count','follower_count'));
    }

    public function confirm(Request $request)
    {
        $user=Auth::user();

        $id=$request->id;
        $email=$request->email;
        $body=$request->body;

        $follow_count = DB::table('follows')
        ->where('follower',Auth::id())
        ->count();

        $follower_count = DB::table('follows')
        ->where('follow',Auth::id())
        ->count();


        return view('contacts.confirm',compact('user','id','email','body','follow_count','follower_count'));
    }

    public function send(Request $request)
    {
        $user=Auth::user();

        $id=$request->id;
        $email=$request->email;
        $body=$request->body;

        DB::table('contacts')
        ->insert([
            'user_id'=>$id,
            'mail'=>$email,
            'body'=>$body,
            'created_at'=>now(),
        ]);

        $follow_count = DB::table('follows')
        ->where('follower',Auth::id())
        ->count();

        $follower_count = DB::table('follows')
        ->where('follow',Auth::id())
        ->count();


        return view('contacts.send',compact('user','follow_count','follower_count'));
    }

    public function history()
    {
        $user=Auth::user();

        $historys = DB::table('contacts')
        ->where('user_id',Auth::id())
        ->get();

        $follow_count = DB::table('follows')
        ->where('follower',Auth::id())
        ->count();

        $follower_count = DB::table('follows')
        ->where('follow',Auth::id())
        ->count();


        return view('contacts.history',compact('user','follow_count','follower_count','historys'));
    }
}
