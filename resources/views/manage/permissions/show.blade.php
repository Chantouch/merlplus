@extends('layouts.master')
@section('content')
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {!! $permission->display_name !!}
                <small class="text-muted">{!! $permission->name !!}</small>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <article class="media">
                        <div class="media-content">
                            <div class="content">
                                <p>{!! $permission->display_name !!}</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="panel-footer">
                    <a href="{!! route('admin.manage.permission.edit', [$permission->id]) !!}"
                       class="btn btn-primary btn-outline waves-effect waves-effect">EDIT</a>
                    <a href="{!! route('admin.manage.permission.index') !!}"
                       class="btn btn-primary btn-outline waves-effect waves-effect">BACK</a>
                </div>
            </div>
        </div>
    </div>
@stop