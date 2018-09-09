<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Profile;
use Auth;

class ProfileController extends Controller
{
    public function profile(){
        return view('profiles.profile');
    }

    public function addProfile(Request $request){
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'profile_pic' => 'required'
        ]);

        $profiles = new Profile;
        $profiles->user_id = Auth::user()->id;
        $profiles->first_name = $request->input('first_name');
        $profiles->last_name = $request->input('last_name');
        if(Input::hasFile('profile_pic')){
              $file = Input::file('profile_pic');
              $file->move(public_path() . '/img/profilePics', $file->getClientOriginalName());
              $url = URL::to("/") . '/img/profilePics/' . $file->getClientOriginalName();
              
        }
        $profiles->profile_pic = $url;
        $profiles->save();
        return redirect('/home')->with('response','Profile Added Successfully');
   }
}
