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
                    <div class="col-md-4">
                    @if(!empty($profile))    
                        <img src="{{ url( $profile->profile_pic ) }}" alt="" class="profilePic">
                        <p class="lead">{{ $profile->first_name . ' ' . $profile->last_name}}</p>
                    @elseif(!empty($username))
                        <img src="{{ url('img/profilePics/defaultProfilePic.png') }}" alt="" class="profilePic">
                        <p class="lead">{{ $username}}</p>
                    @endif
                        
                    </div>
                    <br/>
                    <div class="col-md-8">
                    @if(count($posts) > 0)
                       @foreach($posts->all() as $post)
                            <div class="card" style="width: 20rem;">
                            @if(isset($post->image) && $post->image != '')
                                <img class="card-img-top" src="{{ $post->image }}" alt="Card image cap">
                            @endif
                           <div class="card-body">
                               <h5 class="card-title">{{ $post->title }}</h5>
                               <p class="card-text">{{ $post->content }}</p>
                           </div>  
                           <div class="card-body">
                                @if(isset($user_name))
                                    <a href="#" class="card-link">Comment</a>
                                @endif    
                           </div>
                           </div>
                           <br/>
                        @endforeach
                    @else
                        <p>No posts available</p> 
                    @endif
                    </div>  

                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
