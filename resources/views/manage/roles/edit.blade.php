@extends('layouts.master')
@section('content')
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Default basic form</h3>
            <p class="text-muted m-b-30 font-13">Bootstrap form</p>
            {!! Form::model($role, ['route' => ['admin.manage.role.update', $role->id], 'method' => 'patch']) !!}
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
                permissionsSelected: {!!$role->permissions->pluck('id')!!}
            }
        });
    </script>
@stop