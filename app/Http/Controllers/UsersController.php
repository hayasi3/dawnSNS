<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class UsersController extends Controller
{
    //
    public function index(Request $request){
        $users = DB::table('users')
        ->select('users.id','users.username','users.images')
        ->get();

        return view('users.search',['users'=>$users]);
    }

    public function profile(){
        $user = DB::table('users')
        ->where('id',Auth::id())
        ->first();
        return view('users.profile',compact('user'));
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
