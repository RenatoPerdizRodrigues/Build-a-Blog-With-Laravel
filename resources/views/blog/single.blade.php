@extends('main')

@section('title', "- $post->title")

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{ $post->title }}</h1>
            <img src="{{asset('images/' . $post->image)}}">
            <p>{!! $post->body !!}</p>
            <hr>
            <!-- Post é um modelo do objeto Post, e a função category chama o médoto qu conexta as duas -->
            <p>Category: {{ $post->category->name }}
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3 class="comments-title"><span class="glyphicon glyphicon-comment"></span>{{ $post->comments()->count() }}  Comments</h3>
            @foreach($post->comments as $comment)
                <div class="comment">
                    <div class="author-info">
                        <img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) . "?s=50&d=retro" }} " class="author-image">
                        <div class="author-name">
                                <h4>{{$comment->name }}</h4>
                                <p class="author-time">{{date('F nS, Y - g:i', strtotime($comment->created_at))}}</p>
                        </div>
                    </div>
                    <div class="comment-content">
                        <p>{{$comment->comment}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="row">
        <div id="comment-form" class="col-md-8 col-md-offset-2" style="margin-top: 50px;">
            {{Form::open(['route' => ['comments.store', $post->id, 'method' => 'POST']])}}

            <div class="row">
                <div class="col-md-6">
                    {{Form::label('name', "Name:")}}
                    {{Form::text('name', null, ['class' => 'form-control'])}}

                    {{Form::label('email', "Email:")}}
                    {{Form::text('email', null, ['class' => 'form-control'])}}

                    <div class="col-md-12">
                        {{Form::label('comment', "Comment:")}}
                    {{Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5'])}}

                    {{ Form::submit('Add Comment', ['class' => 'btn-success btn-block', 'style' => 'margin-top: 15px;'])}}
                    </div>
                </div>
            </div>

            {{Form::close()}}
        </div>
    </div>

@stop