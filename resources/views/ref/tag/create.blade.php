@extends('layouts.master')
@section('style')

@stop
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Tag</h3>
            <p class="text-muted m-b-30">Easy to managing your tag</p>
            {!! Form::open(['route' => ['admin.ref.tag.store'], 'method' => 'POST', 'files'=> true]) !!}
            @include('ref.tag.fields')
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('plugins')

@stop


@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {
                tags: [],
            },
            created: function () {

            },
            methods: {}
        });
    </script>
@stop