@extends('layouts.master')
@section('style')
@stop
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Category</h3>
            <p class="text-muted m-b-30">Easy to managing your category</p>
            {!! Form::model($tag, ['route' => ['admin.ref.tag.update', $tag->id], 'method' => 'patch', 'files'=> true]) !!}
            @include('ref.tag.fields')
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('plugins')

@stop

@section('scripts')
    <script>
//        $('#img_name').change(function () {
//            uploadPreview(this, 'img_preview');
//        });
    </script>
@stop