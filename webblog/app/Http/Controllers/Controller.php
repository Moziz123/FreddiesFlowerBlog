<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  
    public $status;
    
    public function isLoggedIn(){
        $user_id = (null != Auth::user()) ? Auth::user()->id : ''; 
        $status = (null == $user_id) ? 0 : 1;
        $this->status = $status;               
    }

    public function isOwnPost($post){
        $user_id = (null != Auth::user()) ? Auth::user()->id : '';
        
        return ($post[0]->user_id == $user_id) ? 1 : 0;        
    }    

    public function setStatus($status){
         $this->status = $status;
    }
}
