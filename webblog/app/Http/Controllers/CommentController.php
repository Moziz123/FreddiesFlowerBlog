<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

use App\Post;
use App\Comment;
use Auth;

final class CommentController extends Controller
{
    public function addComment(Request $request, $post_id){
        
        $this->validate($request,[            
            'comments' => 'required'            
        ]);

        $comment = new Comment;  
        $comment->user_id = Auth::user()->id;  
        $comment->post_id = $post_id;    
        $comment->comments = $request->input('comments');
        $comment->save();
        
        return redirect("/view/{$post_id}")->with('response','Comment Added Successfully');
    }
}
