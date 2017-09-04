@extends('layouts.master')
@section('content')
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {!! $role->name !!}
                <small class="text-muted">{!! $role->email !!}</small>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <article class="media">
                        <div class="media-content">
                            <div class="content">
                                <h3 class="title">Permissions:</h3>
                                <ul>
                                    @foreach ($role->permissions as $r)
                                        <li>{{$r->display_name}} <em class="m-l-15">({{$r->description}})</em></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="panel-footer">
                    <a href="{!! route('admin.manage.role.edit', [$role->id]) !!}"
                       class="btn btn-primary btn-outline waves-effect waves-effect">EDIT</a>
                    <a href="{!! route('admin.manage.role.index') !!}"
                       class="btn btn-primary btn-outline waves-effect waves-effect">BACK</a>
                </div>
            </div>
        </div>
    </div>
@stop