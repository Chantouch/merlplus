@extends('layouts.master')
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">{!! $post->title !!}</h3>
            <p class="text-muted m-b-30">Easy to managing your article</p>
            <p>{!! $post->description !!}</p>
        </div>
    </div>
@stop