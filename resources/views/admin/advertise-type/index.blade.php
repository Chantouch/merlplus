@extends('layouts.master')
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">{!! __('admin.ads_type') !!}</h3>
            <p class="text-muted m-b-30">{!! __('admin.easy_to_managing_your_advertise_type') !!}</p>
            @include('admin.advertise-type.table')
        </div>
    </div>
@stop


@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {

            },
            created: function () {

            },
            methods: {

            },
            watch: {}
        });

    </script>
@stop