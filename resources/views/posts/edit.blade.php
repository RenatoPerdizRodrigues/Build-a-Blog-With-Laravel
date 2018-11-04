@extends('main')

@section('title', ' - Edit Blog Post')

@section('stylesheet')
    {!! Html::style('css/parsley.css') !!}
    {!! Html::style('css/select2.min.css') !!}
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'link code image imagetools',
            menubar: false
        });
    </script>
@stop

@section('content')
    <div class="row">
        {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files' => true]) !!}
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

                {{ Form::label('tags', 'Tags', ['class' => 'form-spacing-top'])}}
                <select class="form-control select2-multi" name="tags[]" multiple="multiple">
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{ $tag->name }}</option>
                    @endforeach
                </select>

                {{ Form::label('featured_image', 'Update Featured Image:', ['class' => 'form-spacing-top'])}}
                {{ Form::file('featured_image')}}

                <input name="_method" type="hidden" value="PATCH">

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

@section('scripts')
    {!! Html::script('js/parsley.min.js') !!}
    {!! Html::script('js/select2.full.min.js') !!}

    <script type="text/javascript">
        $('.select2-multi').select2();
        $('.select2-multi').select2().val({!! json_encode($post->tags()->allRelatedIds()) !!}).trigger('change');
    </script>
@stop