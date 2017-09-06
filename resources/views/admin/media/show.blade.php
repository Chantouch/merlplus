@extends('layouts.master')
@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default block3">
            <div class="panel-heading">{!! $advertise->provider_name !!}
                <div class="panel-action">
                    <div class="dropdown">
                        <a class="dropdown-toggle" id="examplePanelDropdown" data-toggle="dropdown" href="#"
                           aria-expanded="false" role="button">Action <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu bullet dropdown-menu-right" aria-labelledby="examplePanelDropdown"
                            role="menu">
                            <li role="presentation">
                                <a href="{!! route('admin.advertise.index') !!}" role="menuitem">
                                    <i class="icon wb-reply" aria-hidden="true"></i> Back
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="{!! route('admin.advertise.edit',$advertise->id) !!}" role="menuitem">
                                    <i class="icon wb-share" aria-hidden="true"></i> Edit
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="javascript:void(0)" role="menuitem">
                                    <i class="icon wb-trash" aria-hidden="true"></i> Delete
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <p>{!! $advertise->ads_type->name !!}</p>
                    <p>{!! $advertise->url !!}</p>
                    @if ($advertise->hasBanner())
                        {{ Html::image($advertise->banner()->media_url, $advertise->banner()->original_filename, ['class' => 'img-responsive']) }}
                    @endif
                </div>
                <div class="panel-footer">
                    <a href="{!! route('admin.advertise.index') !!}" class="btn btn-primary waves-effect">Back</a>
                </div>
            </div>
        </div>
        <hr>
    </div>
@stop