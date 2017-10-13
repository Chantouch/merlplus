@extends('layouts.master')
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">{!! __('admin.advertise') !!}</h3>
            <p class="text-muted m-b-30">{!! __('admin.easy_to_manage_your_setting') !!}</p>
            @include('admin.setting.table')
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

        $(function () {
            $('.ajax-request').click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var value = $(this).data('value');
                if (value == '1') {
                    $(this).data('value', "0");
                    var element = 0;
                } else {
                    $(this).data('value', "1");
                    var element = 1;
                }
                $.ajax({
                    type: "PATCH",
                    url: "/admin/settings/ajax/" + id,
                    data: {
                        'value': element
                    },
                    success: function (rrr) {
                        $(this).data('value', value);
                        if (value == '0') {
                            $('#value' + id).removeClass('fa-square-o');
                            $('#value' + id).addClass('fa-check-square-o');

                        } else {
                            $('#value' + id).removeClass('fa-check-square-o');
                            $('#value' + id).addClass('fa-square-o');
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            })
        })
    </script>
@stop