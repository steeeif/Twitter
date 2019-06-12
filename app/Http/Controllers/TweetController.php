<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tweet;
use Illuminate\Support\Facades\DB;

class TweetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        //select users tweets
        $first = DB::table('tweets')
        ->select('tweets.*', 'users.name')
        ->join('users', 'tweets.user_id', '=', 'users.id')
        ->where('tweets.user_id', '=', Auth::id());
        //select tweets from those user is following 
        $second = DB::table('tweets')
         ->select('tweets.*', 'users.name')
         ->join('follows', 'tweets.user_id', '=', 'follows.follows_id')
         ->join('users', 'follows.follows_id', '=', 'users.id')
         ->where('follows.user_id', '=', Auth::id())
         ->union($first)
         ->orderBy('id', 'desc')
         ->get();

        return $second;

    }
    public function show($id){
        return Tweet::find($id);
    }
    
    public function store(Request $request){
        return Tweet::create([ 'tweet' => request('tweet'), 'user_id' =>  Auth::id()]);
    }
}
