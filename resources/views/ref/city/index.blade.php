@extends('layouts.backend.app')
@section('content')
    <!-- Hover Rows -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        CITIES LIST
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{!! route('admin.cities.create') !!}">Add</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                @include('backend.pages.city.table')
            </div>
        </div>
    </div>
    <!-- #END# Hover Rows -->
@stop