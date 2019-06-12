<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

         $users = DB::table('users')
        ->Where('name', 'like', '%' . Input::get('name')  . '%')
        ->Where('id', '!=', Auth::id())
        ->limit(10)
        ->get();
        return $users;

    }
    //Display single user
    public function show($id){
        $user = DB::table('users')
                ->select('tweets.name', 'users.id')
                ->find($id);
        return $user;
    }      
}
