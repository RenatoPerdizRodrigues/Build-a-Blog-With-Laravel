@extends('main')

@section('title', ' - Main')

@section('content')
    <div class="row">
        <div class="col-md-12">
          <div class="jumbotron">
            <h1>Welcome to My Blog!</h1>
            <p class="lead">Thank you so much for visiting. This is my test website built with Laravel. Please read my new post!</p>
            <p><a class="btn btn-primary btn-lg" href="{{ route('blog.single', $posts[0]->slug) }}" role="button">Latest Post: {{ $posts[0]->title }}</a></p>
          </div>
        </div>
      </div>
      <!-- end of header .row -->

      <div class="row">
        <div class="col-md-8">
          @foreach($posts as $post)
            @if($post->id != $posts[0]->id)
              <div class="post">
                <h3>{{$post->title}}</h3>
                <p>{{substr(strip_tags($post->body), 0, 300)}}{{ strip_tags(strlen($post->body)) > 300 ? "..." : ""}}</p>
                <a href="{{route('blog.single', $post->slug)}}" class="btn btn-primary">Read More</a>
              </div>

              <hr>
            @endif
          @endforeach

        </div>

        <div class="col-md-3 col-md-offset-1">
          <h2>Sidebar</h2>
        </div>
      </div>
@stop