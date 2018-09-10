@extends('layouts.app')
<style type="text/css">
     .profilePic{
         border-radius: 100%;
         max-width: 100px;
     }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{$error}}
                    </div>        
                @endforeach          
            @endif
            
            @if(session('response'))                
                    <div class="alert alert-success">{{session('response')}}
                    </div>         
            @endif
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="col-md-5">
                    @if(!empty($profile))    
                        <img src="{{ url( $profile->profile_pic ) }}" alt="" class="profilePic">
                        <p class="lead">{{ $profile->first_name . ' ' . $profile->last_name}}</p>
                    @elseif(!empty($username))
                        <img src="{{ url('img/profilePics/defaultProfilePic.png') }}" alt="" class="profilePic">
                        <p class="lead">{{ $username}}</p>
                    @endif
                        
                    </div>
                    <br/>
                    <div class="row">
                    @if(!empty($posts))  
                    @if(count($posts) > 0)
                    @foreach($posts->all() as $post)
                       <div class="col-md-4 offset-md-1">
                            <div class="card" style="width: 18rem;">
                            @if(isset($post->image) && $post->image != '')
                                <img class="card-img-top" src="{{ $post->image }}" alt="Card image cap">
                            @endif
                           <div class="card-body">
                               <h5 class="card-title">{{ $post->title }}</h5>
                               <p class="card-text">{{ $post->content }}</p>
                           </div>  
                           <div class="card-body">
                               <div class="row">
                               <ul class="nav nav-pills postBtns">
                                   <li role="presentation">
                                       <a href='{{ url("/view/{$post->id}") }}'>
                                           <span ><i class="material-icons md-18">remove_red_eye</i> VIEW</span>
                                       </a>
                                   </li>    
                               </ul> 
                               <ul class="nav nav-pills postBtns">
                                   <li role="presentation">
                                       @if(!$loginStatus || !$post->isOwnPost)                                      
                                           <a href='{{ url("/edit/{$post->id}") }}' class="isDisabled">
                                       @else
                                           <a href='{{ url("/edit/{$post->id}") }}'> 
                                       @endif       
                                       <span><i class="material-icons md-18">border_color</i> EDIT</span>
                                       </a>
                                   </li>    
                               </ul>   
                               <ul class="nav nav-pills postBtns">
                                   <li role="presentation">
                                   @if(!$loginStatus || !$post->isOwnPost)
                                           <a href='{{ url("/deletePost/{$post->id}") }}' class="isDisabled">
                                       @else    
                                           <a href='{{ url("/deletePost/{$post->id}") }}'>
                                       @endif
                                           <span ><i class="material-icons md-18">delete_forever</i> DELETE</span>
                                       </a>
                                    </li>    
                                </ul> 
                            </div>     
                                <cite style="font-size: 12px;">Posted on: {{ date('M j, Y H:i', strtotime($post->updated_at))}} </cite>
                        </div>
                    </div>
                    <br/>
                </div> 
                @endforeach
                @else
                     <p>No posts available</p> 
                @endif
                @endif
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
