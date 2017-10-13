@extends('layouts.master')
@section('content')
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">{!! __('admin.role') !!}</h3>
            <p class="text-muted m-b-30">{!! __('admin.easy_to_managing_your_role') !!}</p>
            {!! Form::open(['route' => ['admin.manage.role.store'], 'method' => 'POST']) !!}
            @include('manage.roles.fields')
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('scripts')
    <script src="{!! asset('js/script.js') !!}"></script>
    <script>
        let app = new Vue({
            el: '#app',
            data: {
                permissionsSelected: []
            }
        });

    </script>
@stop