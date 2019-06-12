<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Follow;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
               
         return view('profile'); 
    }
    public function show($id){
        //Returns profile data
        $user = DB::table('users')
        ->select('name','email','id')
        ->find($id); 
         return response()->json($user); 
    }
    public function status($id){
        //Check if user follows profile
        $status = DB::table('follows')
        ->Where('user_id', '=', Auth::id())
        ->Where('follows_id','=', $id)
        ->first();
        if ($status === null) {
            return response()->json( [ 'status' => false ]); 
         }else{
            return response()->json( [ 'status' => true ]); 
         }
    }
    public function update($id){
        
        //follow / unfollow profile
        $status = DB::table('follows')
        ->Where('user_id', '=', Auth::id())
        ->Where('follows_id','=', $id)
        ->first();

        if ($status === null) {
            DB::table('follows')->insert(
                ['user_id' => Auth::id(), 'follows_id' =>  $id]
            );
            return response()->json( [ 'status' => true ]);
         }else{
            DB::table('follows')
            ->Where('user_id', '=', Auth::id())
            ->Where('follows_id','=', $id)->delete();
            return response()->json( [ 'status' => false ]);
          
         }
    }
}
