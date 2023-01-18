<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;

class UsersController extends Controller
{
    //
    public function index(Request $request){
        // $users = DB::table('users')
        // ->leftjoin('follows','users.id','follows.follow')
        // ->select('users.id','users.username','users.images','follows.follower','follows.follow')
        // ->where('users.id','!=',Auth::id())
        // ->groupBy()
        // ->get();
        $users = DB::table('users')
        ->where('users.id','!=',Auth::id())
        ->get();

        $followed = DB::table('follows')
        ->where('follower',Auth::id())
        ->get();

        $user = DB::table('users')
        ->where('id',Auth::id())
        ->first();

        return view('users.search',compact('user','users','followed'));
    }

    public function profile(){
        $user = DB::table('users')
        ->where('id',Auth::id())
        ->first();

        $follow_count = DB::table('follows')
        ->where('follower',Auth::id())
        ->count();

        $follower_count = DB::table('follows')
        ->where('follow',Auth::id())
        ->count();

        return view('users.profile',compact('user','follow_count','follower_count'));
    }

    public function upProfile(Request $request){
        $name = $request->input('name');
        $mail = $request->input('mail');
        $password = $request->input('password');
        $bio = $request->input('bio');
        $image = $request->file('image');

        DB::table('users')
        ->where('id',Auth::id())
        ->update(['username' => $name,'mail' => $mail,'bio' => $bio]);

        if(!empty($password)){
            DB::table('users')
            ->where('id',Auth::id())
            ->update(['password' => Hash::make($password)]);
        }


        if(!empty($image)){
            $image = $image->getClientOriginalName();
            DB::table('users')
            ->where('id',Auth::id())
            ->update(['images' => $image]);

            $request->file('image')->storeAs('public/images', $image);
        }

        return redirect('/profile');
    }

    public function otherProfile($id){
        $user = DB::table('users')
        ->leftjoin('posts','users.id','posts.user_id')
        ->leftjoin('follows','users.id','follows.follow')
        ->select('users.*','posts.posts','follows.follow','follows.follower')
        ->where('users.id',$id)
        ->first();

        $followed = DB::table('follows')
        ->where('follower',Auth::id())
        ->get();

        $id = DB::table('follows')
        ->where('follower', Auth::id())
        ->pluck('follow');
        //dd($user);

        return view('users.otherProfile',compact('user','id','followed'));
    }

    public function search(Request $request){
        $name = $request->input('search');
        $users = DB::table('users')
        ->select('users.id','users.username','users.images')
        ->where('username',$name)
        ->get();
        $users = DB::table('users')
        ->where('username','LIKE',"%".$name."%")
        ->get();

        return view('users.search',['users'=>$users,'user'=>$users]);
    }

}
