<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App\Post;
use Auth;

final class ManagePostController extends Controller
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

    
    public function view($post_id){               
        $post = Post::where('id', '=', $post_id)->get();        
        $isOwnPost = $this->isOwnPost($post); 
        $this->isLoggedIn(); 
        $comments = DB::table('users')
                        ->join('comments', 'users.id', '=', 'comments.user_id')
                        ->join('posts', 'posts.id', '=', 'comments.post_id')
                        ->select('users.*', 'comments.*')
                        ->where(['posts.id' => $post_id])
                        ->get(); 
                       
        return view('posts.view', ['post' => $post, 'isOwnPost' => $isOwnPost,
                                   'loginStatus' => $this->status, 'comments' => $comments]);
    }

    public function edit($post_id){
        $posts = Post::where('id', '=', $post_id)->get();
        
        return view('posts.edit', ['posts' => $posts]);
    }

    public function delete($post_id){
        $post = Post::where('id', '=', $post_id)->get();
        return view('posts.delete', ['post' => $post]);
    }

    

    


}
