@extends('layouts.master')
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Default Basic Forms</h3>
            <p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>
            {!! Form::model($user, ['route' => ['admin.manage.user.update', $user->id], 'method' => 'patch','class'=>'form-horizontal']) !!}
            @include('manage.users.fields')
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('scripts')
    <script src="{!! asset('js/script.js') !!}"></script>
@stop
