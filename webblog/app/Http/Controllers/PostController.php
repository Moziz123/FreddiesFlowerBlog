<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Post;
use Auth;

final class PostController extends Controller
{
    public function post()
    {        
        return view('posts.post');
    }

    public function addPost(Request $request)
    {
        
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
        return redirect('/')->with('response','Post Added Successfully');
    }

    public function editPost(Request $request, $post_id)
    {       
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
        $data = array(
             'user_id' => $posts->user_id,
             'title' => $posts->title,
             'content' => $posts->content,
             'image' => $posts->image
        );
        Post::where('id', $post_id)->update($data);
        $posts->update($data);
        return redirect('/')->with('response','Post Updated Successfully');
    }

    public function deletePost($post_id)
    {
        Post::where('id', $post_id)->delete();
        return redirect('/')->with('response','Post Deleted Successfully');
    }
}
