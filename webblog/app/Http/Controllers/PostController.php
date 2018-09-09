<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Post;
use Auth;

class PostController extends Controller
{
    public function post(){        
        return view('posts.post');
    }

    public function addPost(Request $request){
        
        $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
            'post_image' => 'nullable'
        ]);

        $posts = new Post;
        $posts->user_id = Auth::user()->id;
        $posts->title = $request->input('title');
        $posts->content = $request->input('content');
        
        if(Input::hasFile('post_image')){
            $file = Input::file('post_image');
            $file->move(public_path() . '/img/postPics', $file->getClientOriginalName());
            $url = URL::to("/") . '/img/postPics/' . $file->getClientOriginalName();         
        }else{
            $url = '';
        }
        $posts->image = $url;
        $posts->save();
        return redirect('/home')->with('response','Post Added Successfully');
    }
}
