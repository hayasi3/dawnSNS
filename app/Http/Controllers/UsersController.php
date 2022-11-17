<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class UsersController extends Controller
{
    //
    public function profile(){
        $user = DB::table('users')
        ->where('id',Auth::id())
        ->first();
        return view('users.profile',compact('user'));
    }
    public function search(Request $request){
        return view('users.search');
    }

    public function index(Request $request){
        $user = DB::table('users')
        ->select('users.id','users.username','users.images')
        ->get();

        return view('users.index');
    }

}
