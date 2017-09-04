@extends('layouts.master')
@section('content')
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Add Permission</h3>
            <p class="text-muted m-b-20 font-13">Clearify lall thesl</p>
            {!! Form::model($permission, ['route' => ['admin.manage.permission.update', $permission->id], 'method' => 'patch']) !!}
            @include('manage.permissions.fields')
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
                permissionType: 'basic',
                resource: '',
                crudSelected: ['create', 'read', 'update', 'delete']
            },
            methods: {
                crudName: function (item) {
                    return item.substr(0, 1).toUpperCase() + item.substr(1) + " " + app.resource.substr(0, 1).toUpperCase() + app.resource.substr(1);
                },
                crudSlug: function (item) {
                    return item.toLowerCase() + "-" + app.resource.toLowerCase();
                },
                crudDescription: function (item) {
                    return "Allow a User to " + item.toUpperCase() + " a " + app.resource.substr(0, 1).toUpperCase() + app.resource.substr(1);
                }
            }
        });
@stop