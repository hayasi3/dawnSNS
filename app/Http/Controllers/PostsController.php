<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Gate;

class PostsController extends Controller
{
    //
    public function index(){
        // if(Gate::allows('admin')){

        //     }else{

        //     dd('ユーザ一覧にアクセスが許可されていないユーザです。');
        // }if文でadminとそれ以外で動くコントローラーを変更できる15行目にadminのコントローラー、18行目はそれ以外のユーザー

        //Gate::authorize('admin');middleware（ルーティングとコントローラーの間）は通すけどadminしかアクセスできないようにする

        $block_ids = DB::table('blocks')
        ->where('user_id',Auth::id())
        ->pluck('block_id');

        $posts = DB::table('posts')
        ->join('users','posts.user_id','users.id')
        ->whereNotIn('posts.user_id',$block_ids)//whereNotInはここの変数に入っているもの以外の投稿をもってくる
        ->select('posts.id','posts.user_id','posts.posts','posts.created_at','users.username','users.images')
        ->get();

        $favorite_exsits = DB::table('favorites')
        ->where('user_id',Auth::id())
        ->get();

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

        return view('posts.index',['posts'=>$posts,'user'=>$user,'follow_count'=>$follow_count,'follower_count'=>$follower_count,'favorite_exsits'=>$favorite_exsits,'mylists'=>$mylists]);
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

    public function delete(Request $request){
        $id = $request->id;
        DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('/top');
    }

    public function update(Request $request)
    {
        $id = $request->input('id');//35行目と同じ意味
        $up_post = $request->input('editpost');
        DB::table('posts')
            ->where('id', $id)
            ->update(
                ['posts' => $up_post]
            );

        return redirect('/top');
    }

    public function test(){
        $posts = DB::table('posts')
            ->select('posts.id','posts.user_id','posts.posts','posts.created_at')
            ->where('user_id',Auth::id())
            ->get();

        return view('posts.test',['posts'=>$posts]);
    }

    public function favorite_create(Request $request){
        $user_id = Auth::id();
        $favorite_id = $request->id;
        DB::table('favorites')
            ->insert([
                'user_id'=>$user_id,
                'favorite_id'=>$favorite_id,
                'created_at'=>now(),
            ]);

        return back();
    }

    public function favorite_delete(Request $request){
        $user_id = Auth::id();
        $favorite_id = $request->id;
        DB::table('favorites')
            ->where([
                'user_id'=>$user_id,
                'favorite_id'=>$favorite_id,
            ])->delete();

        return back();
}

public function favorite(){

    $user = DB::table('users')
    ->where('id',Auth::id())
    ->first();

    $follow_count = DB::table('follows')
    ->where('follower',Auth::id())
    ->count();

    $follower_count = DB::table('follows')
    ->where('follow',Auth::id())
    ->count();

    $favorite_exsits = DB::table('favorites')
        ->where('user_id',Auth::id())
        ->get();

    $favorite_post_ids = DB::table('favorites')//条件を定義するための変数（いいね登録をしている投稿のidを取得しているだけ）
    ->where('user_id',Auth::id())
    ->pluck('favorite_id');//pluck->限定したいカラムのみ選択するときに使う

    $favorite_posts = DB::table('posts')
        ->join('users','posts.user_id','users.id')
        ->whereIn('posts.id',$favorite_post_ids)//whereは単体のデータのみヒットする、検索が複数個の条件はwhereInにすると中にあるものすべて探す
        ->select('posts.id','posts.user_id','posts.posts','posts.created_at','users.username','users.images')
        ->get();

    return view('favorite.index',compact('user','follow_count','follower_count','favorite_exsits','favorite_posts'));
}

public function detail($id){

    $user = DB::table('users')
    ->where('id',Auth::id())
    ->first();

    $follow_count = DB::table('follows')
    ->where('follower',Auth::id())
    ->count();

    $follower_count = DB::table('follows')
    ->where('follow',Auth::id())
    ->count();

    $post = DB::table('posts')
        ->join('users','posts.user_id','users.id')
        ->where('posts.id',$id)
        ->select('posts.id','posts.user_id','posts.posts','posts.created_at','users.username','users.images')
        ->first();
        //->get()は複数個データがある前提。->firstは単数のデータを持ってくるときに使う

    $comments = DB::table('comments')
         ->join('users','comments.user_id','users.id')
         ->where('comments.post_id',$id)
         ->select('comments.id','comments.user_id','comments.body','comments.created_at','users.username','users.images')
         ->get();

    $favorite_exsits = DB::table('favorites')
        ->where('user_id',Auth::id())
        ->get();

        return view('posts.detail',compact('user','follow_count','follower_count','post','favorite_exsits','comments'));
}

public function ranking(){
    $ranking_posts = DB::table('posts')
        ->join('users','posts.user_id','users.id')
        ->join('favorites','posts.id','=','favorites.favorite_id')//'='は書いても書かなくても問題ない
        ->select('posts.id','posts.user_id','posts.posts','posts.created_at','users.username','users.images',DB::raw('count(favorites.favorite_id) as id_count'))
        ->orderBy('id_count','desc')
        ->groupBy('favorites.favorite_id')
        ->take(3)
        ->get();

    $user = DB::table('users')
        ->where('id',Auth::id())
        ->first();

    $follow_count = DB::table('follows')
        ->where('follower',Auth::id())
        ->count();

    $follower_count = DB::table('follows')
        ->where('follow',Auth::id())
        ->count();

    $favorite_exsits = DB::table('favorites')
        ->where('user_id',Auth::id())
        ->get();


    return view('favorite.ranking',compact('user','follow_count','follower_count','ranking_posts','favorite_exsits'));
}

public function ranking_week(){

    $weekend_ids = DB::table('favorites')
        ->whereDate('created_at', '<=', Carbon::today()->addweek())
        ->pluck('favorite_id');

    $ranking_posts = DB::table('posts')
        ->join('users','posts.user_id','users.id')
        ->join('favorites','posts.id','=','favorites.favorite_id')//'='は書いても書かなくても問題ない
        ->whereIn('posts.id',$weekend_ids)
        ->select('posts.id','posts.user_id','posts.posts','posts.created_at','users.username','users.images',DB::raw('count(favorites.favorite_id) as id_count'))
        ->orderBy('id_count','desc')
        ->groupBy('favorites.favorite_id')
        ->take(3)
        ->get();

    $user = DB::table('users')
        ->where('id',Auth::id())
        ->first();

    $follow_count = DB::table('follows')
        ->where('follower',Auth::id())
        ->count();

    $follower_count = DB::table('follows')
        ->where('follow',Auth::id())
        ->count();

    $favorite_exsits = DB::table('favorites')
        ->where('user_id',Auth::id())
        ->get();


    return view('favorite.ranking_week',compact('user','follow_count','follower_count','ranking_posts','favorite_exsits'));
}

}

// $users=DB::table('users')
// ->join('posts','users.id','posts.user_id')
// ->get();
//joinは内部結合で結合した2つのテーブル両方にデータが入っていないと取得されない。外部結合（leftjoin）（※一応rightもある）の場合は左側の値のデータが入っていれば右側がデータがなくてもNULLにして持ってくる（rightの場合は逆になる）
