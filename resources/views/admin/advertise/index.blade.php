@extends('layouts.master')
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Advertising</h3>
            <p class="text-muted m-b-30">Easy to managing your advertise</p>
            @include('admin.advertise.table')
        </div>
    </div>
@stop


@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {},
            created: function () {

            },
            methods: {},
            watch: {}
        });

    </script>
@stop