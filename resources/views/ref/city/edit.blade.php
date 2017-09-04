@extends('layouts.app')
@section('plugins')
    <!-- Bootstrap Select Css -->
    <link href="{!! asset('plugins/bootstrap-select/css/bootstrap-select.css') !!}" rel="stylesheet"/>
@stop
@section('content')
    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        UPDATE <span>{!! $user->name !!}</span> USER
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{!! route('users.index') !!}">USER LIST</a></li>
                                <li><a href="{!! route('users.create') !!}">ADD USER</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch']) !!}
                    @include('manage.city.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Vertical Layout -->
@stop

@section('scripts')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                password_options: 'keep',
                rolesSelected: {!! $user->roles->pluck('id') !!}
            }
        });
    </script>
    <!-- Select Plugin Js -->
    <script src="{!! asset('plugins/bootstrap-select/js/bootstrap-select.js') !!}"></script>
@stop
