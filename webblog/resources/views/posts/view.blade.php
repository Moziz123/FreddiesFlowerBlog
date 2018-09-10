@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">    
        @foreach($post as $p)
            <div class="col-md-10 ">                           
                <div class="card">
                @if(session('response'))                
                    <div class="alert alert-success">{{session('response')}}
                    </div>      
                @endif    
                    <div class="card-header">{{ $p->title }}</div>                           
                    </div>
                </div>
                <div class="col-md-10 ">
                @if(isset($p->image) && $p->image != '')                       
                    <div class="card" >
                        <img class="card-img-top" src="{{ $p->image }}" alt="Card image cap">
                    </div>
                @endif
                    <div class="card" >
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text">{{ $p->content }}</p>
                        </div> 
                    </div> 
                    <div class="card-body">
                        <div class="row">
                            <ul class="nav nav-pills postBtns">
                                <li role="presentation">
                                    <span ><i class="material-icons md-18">chat_bubble_outline</i> COMMENT</span></a>
                                </li>    
                            </ul>
                        </div> 
                        <cite style="font-size: 12px;">Posted on: {{ date('M j, Y H:i', strtotime($p->updated_at))}} </cite>
                    </div>
                </div>
               <div class="col-md-10 ">                           
                   <div class="card">
                   @if($isOwnPost || !$loginStatus)          
                       <form method="POST" action='{{ url("/comments/{$p->id}") }}' >
                       @csrf
                            <div class="form-group">
                                <textarea id="comments" style="height:150px;" class="form-control{{ $errors->has('comments') ? ' is-invalid' : '' }}" name="comments" required>
                                </textarea>
                                <br/>
                                <button type="submit" class="btn  btn-lg btn-block" disabled aria-disabled="true">
                                    {{ __('Post Comment') }}
                                </button>
                             </div>
                         </form>
                     @else
                     <form method="POST" action='{{ url("/comments/{$p->id}") }}' >
                     @csrf
                          <div class="form-group">
                               <textarea id="comments" style="height:150px;" class="form-control{{ $errors->has('comments') ? ' is-invalid' : '' }}" name="comments" required>
                               </textarea>
                               <br/>
                               <button type="submit" class="btn  btn-lg btn-block">
                                    {{ __('Post Comment') }}
                               </button>
                           </div>
                      </form>
                      @endif
                  </div>
            @endforeach 
            
            <div class="card col-md-12" > 
                <div class="row justify-content-center" > 
                    <h3 class="commentsHeader">COMMENTS</h3> 
                </div>
                <div class="row justify-content-center" >
                    <div>  
                        @if(count($comments) > 0)
                            @foreach($comments->all() as $c)
                                <p class="card-text">{{ $c->comments }}</p>
                                <p class="card-text">Posted by: {{ $c->name }}</p>
                            @endforeach
                        @endif    
                    </div>
                 </div>
             </div>  
@endsection                           
