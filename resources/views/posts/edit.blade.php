@extends('main')

@section('title', ' - Edit Blog Post')

@section('content')
    <div class="row">
        {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'POST']) !!}
        <div class="col-md-8">
            {{ Form::label('title', 'Title')}}
            {{ Form::text('title', null, ["class" => 'form-control input-lg'])}}
            
            {{ Form::label('slug', 'Slug:', ['class' => ' form-spacing-top']) }}
            {{ Form::text('slug', null, ["class" => 'form-control']) }}

            {{ Form::label('category', 'Category')}}
                <select class="form-control" name="category">
                    @foreach($categories as $category)
                        <option value='{{$category->id}}'>{{$category->name}}</option>
                    @endforeach
                </select>

                <input name="_method" type="hidden" value="PATCH">;

            {{ Form::label('body', 'Body', ["class" => 'form-spacing-top'])}}
            {{ Form::textarea('body', null, ["class" => 'form-control'])}}
        </div>
        
        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>Created At:</dt>
                    <dd>{{ date('M j, Y H:i', strtotime($post->created_at)) }}</dd>
                </dl>

                <dl class="dl-horizontal">
                        <dt>Last Updated:</dt>
                        <dd>{{ date('M j, Y H:i', strtotime($post->updated_at)) }}</dd>
                </dl>

                <hr>

                <div class="row">
                    <div class="col-sm-6">
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-danger btn-block">Cancel</a>
                    </div>

                    <div class="col-sm-6">
                        {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
                    </div>
                </div>

            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop