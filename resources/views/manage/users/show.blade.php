@extends('layouts.master')
@section('content')
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {!! $user->name !!}
                <small class="text-muted">{!! $user->email !!}</small>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <p>
                        Email: {!! $user->email !!}
                    </p>
                    <ul>
                        {{$user->roles->count() == 0 ? 'This user has not been assigned any roles yet' : ''}}
                        @foreach ($user->roles as $role)
                            <li>{{$role->display_name}} ({{$role->description}})</li>
                        @endforeach
                    </ul>
                </div>
                <div class="panel-footer">
                    <a href="{!! route('admin.manage.user.edit', [$user->id]) !!}"
                       class="btn btn-primary btn-outline waves-effect waves-effect">EDIT</a>
                    <a href="{!! route('admin.manage.user.index') !!}"
                       class="btn btn-primary btn-outline waves-effect waves-effect">BACK</a>
                </div>
            </div>
        </div>
    </div>
@stop