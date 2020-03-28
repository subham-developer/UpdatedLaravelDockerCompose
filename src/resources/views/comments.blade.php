@extends('web_master')
@section('body')

    <div class="container">
        <h1>{{ $data['project']['title'] }} / Comments</h1>
        <div class="breadcrumbs" style="display: inline-flex; margin-bottom: 25px;">
            
                <a href="{{ asset('/') }}">Home</a><span>&nbsp;/&nbsp;</span>
                {{ $data['project']['title'] }}
            
            </div><!-- .breadcrumbs -->
        </div>
        
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <img src="{{ asset('uploads/'.$data['project']['image'][0]->name) }}" class="img-fluid"><br>
            <h3 style="margin-top: 10px;">{{ $data['project']['title'] }}</h3>
            <p>{{ $data['project']['description'] }}</p>
        </div>
        <div class="col-lg-8">
            <div id="comment" class="tabs comment-area" style="margin-top: 0;margin-bottom: 50px;">
                
                <ol class="comments-list">
                    
                    @foreach($data['comments'] as $comment)
                    <li class="comment clearfix" style="margin-bottom: 20px;">
                        <div class="comment-body">
                            <div class="comment-avatar">
                                <img src="{{ asset('uploads').'/'.$comment['user']['profile_image'] }}" class="rounded"
                            style="height: 80px;border-radius:50% !important"></div>
                            <div class="comment-info">
                            <header class="comment-meta"></header>
                            <cite class="comment-author">{{ $comment->user->name }}</cite>
                            <div class="comment-inline">
                                <span class="comment-date">{{ $comment->created_at }}</span>
                                {{-- <a href="#" class="comment-reply">Reply</a> --}}
                            </div>
                            <div class="comment-content"><p>{{ $comment['comment'] }}</p></div>
                        </div>
                    </div>
                </li>
                @endforeach
                
            </ol>
            
        </div>
        {{ $data['comments']->links() }}
        
    </div>
</div>
</div>
@endsection