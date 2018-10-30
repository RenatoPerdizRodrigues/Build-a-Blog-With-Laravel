@extends('main')

@section('title', "- $post->title")

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{ $post->title }}</h1>
            <p>{{ $post->body }}</p>
            <hr>
            <!-- Post é um modelo do objeto Post, e a função category chama o médoto qu conexta as duas -->
            <p>Category: {{ $post->category->name }}
        </div>
    </div>

@stop