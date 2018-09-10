<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Profile;
use App\Post;
use App\User;

final class HomeController extends Controller
{
    
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()    
    {
        //$this->middleware('auth');
       
    }
    
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = '';
        $user_name = '';
        $profile = '';
        $this->isLoggedIn();        
        if(null != Auth::user()){           
            $user_id = Auth::user()->id;
            $user_name = Auth::user()->name;
            $profile = DB::table('users')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->select('users.*', 'profiles.*')
                        ->where(['profiles.user_id' => $user_id])
                        ->first();
        }         
        $posts = Post::all();
        
        foreach($posts as $post){
            $user_id = (null != Auth::user()) ? Auth::user()->id : '';        
            $post->isOwnPost =  ($post->user_id == $user_id) ? 1 : 0;  
            $post->content = (strlen($post->content) > 150) ? 
                             substr($post->content,0,150) . '...' : $post->content;
        }  
        return view('home', ['posts' => $posts,'user_name' => $user_name, 
                            'profile' => $profile, 'loginStatus' => $this->status]);
    }
}
