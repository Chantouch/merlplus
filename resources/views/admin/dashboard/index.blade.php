@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{!! asset('plugins/morrisjs/morris.css') !!}">
    <link rel="stylesheet" href="{!! asset('plugins/chartist-js/dist/chartist.min.css') !!}">
    <link rel="stylesheet"
          href="{!! asset('plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') !!}">
    <link rel="stylesheet" href="{!! asset('plugins/calendar/dist/fullcalendar.css') !!}">
    <link rel="stylesheet" href="{!! asset('plugins/sweetalert/sweetalert.css') !!}">
@stop
@section('style')
    <style>
        .manage-u-table select {
            max-width: 150px;
            border-radius: 0 !important;
        }
    </style>
@endsection
@section('content')
    <div class="col-md-12">
        @include('admin.dashboard.different-data-widgets')
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="white-box">
                    <h3 class="box-title">Articles daily posted</h3>
                    <ul class="list-inline text-right">
                        <li>
                            <h5><i class="fa fa-circle m-r-5 text-info"></i>Active</h5>
                        </li>
                        <li>
                            <h5><i class="fa fa-circle m-r-5 text-danger"></i>InActive</h5>
                        </li>
                        <li>
                            <h5><i class="fa fa-circle m-r-5 text-warning"></i>InActive</h5>
                        </li>
                    </ul>
                    <div id="article-daily-posted" style="height: 285px;"></div>
                </div>
            </div>
        </div>
        {{--@include('admin.dashboard.wallet-user-widgets')--}}
        @include('admin.dashboard.profile-inbox-widgets')
        {{--@include('admin.dashboard.calendar-todo-widgets')--}}
        @include('admin.dashboard.blog-component-widgets')
        {{--@include('admin.dashboard.chats-message-widgets')--}}
    </div>
@endsection
@section('plugins')
    <script src="{!! asset('plugins/waypoints/lib/jquery.waypoints.js') !!}"></script>
    <script src="{!! asset('plugins/counterup/jquery.counterup.min.js') !!}"></script>
    <script src="{!! asset('plugins/raphael/raphael-min.js') !!}"></script>
    <script src="{!! asset('plugins/morrisjs/morris.js') !!}"></script>
    <script src="{!! asset('plugins/chartist-js/dist/chartist.min.js') !!}"></script>
    <script src="{!! asset('plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') !!}"></script>
    <script src="{!! asset('plugins/calendar/dist/fullcalendar.min.js') !!}"></script>
    <script src="{!! asset('plugins/calendar/dist/cal-init.js') !!}"></script>
    <script src="{!! asset('plugins/sweetalert/sweetalert.min.js') !!}"></script>
    <script src="{!! asset('plugins/sweetalert/jquery.sweet-alert.custom.js') !!}"></script>
    <script src="{!! asset('js/dashboard1.js') !!}"></script>
    <script src="{!! asset('js/cbpFWTabs.js') !!}"></script>
@stop
@section('scripts')
    <script type="text/javascript">
        let app = new Vue({
            el: '#app',
            data: {
                dashboard: [],
                updateUser: {
                    id: '',
                    name: '',
                    email: ''
                },
                auth: {
                    dashboard_value: $("#dashboard_value").val()
                }
            },
            created() {
                this.dashboardData();
            },
            methods: {
                dashboardData() {
                    let vm = this;
                    vm.$http.get('/api/v1/dashboard/').then(response => {
                        vm.dashboard = response.data;
                    })
                },
                postChartDaily() {
                    let vm = this;
                    vm.$http.get('/api/v1/dashboard/').then(response => {
                        vm.dashboard = response.data;
                        console.log(response.data);
                    })
                },
                editUser(item) {
                    let vm = this;
                    vm.updateUser.name = item.name;
                    vm.updateUser.email = item.email;
                    vm.updateUser.id = item.id;
                    $('#edit-user').modal({
                        'show': true
                    })
                },
                updateUserInfo(id) {
                    let vm = this;
                    let input = vm.updateUser;
                    vm.$http.patch('/api/v1/users/' + id, input).then((response) => {
                        vm.updateUser = {
                            'name': '',
                            'email': '',
                            'id': ''
                        };
                        $("#edit-user").modal('hide');
                        vm.dashboardData();
                    });
                },
                deleteUser: function (item) {
                    let vm = this;
                    swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel plx!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }, function (isConfirm) {
                        if (isConfirm) {
                            vm.$http.delete('/api/v1/users/' + item.id)
                                .then(res => {
                                    swal("Deleted!", "Your file has been deleted.", "success");
                                    vm.dashboardData();
                                })
                                .catch(err => {

                                })
                        } else {
                            swal("Cancelled", "Your file is safe :)", "error");
                        }
                    });
                }
            }
        });

        (function () {
            [].slice.call(document.querySelectorAll('.sttabs')).forEach(function (el) {
                new CBPFWTabs(el);
            });

            var data = {
                labels: {!! $labels !!},
                series: [
                    {!! $inactive !!},
                    {!! $active !!},
                    {!! $draft !!}
                ]
            };

            /* Set some base options (settings will override the default settings in Chartist.js *see default settings*). We are adding a basic label interpolation function for the xAxis labels. */
            var options = {
                top: 0,
                low: 1,
                showPoint: true,
                fullWidth: true,
                plugins: [
                    Chartist.plugins.tooltip()
                ],
                axisY: {
                    labelInterpolationFnc: function (value) {
                        return (value / 1);
                    }
                },
                chartPadding: {
                    right: 10
                }
            };

            /* Now we can specify multiple responsive settings that will override the base settings based on order and if the media queries match. In this example we are changing the visibility of dots and lines as well as use different label interpolations for space reasons. */
            var responsiveOptions = [
                ['screen and (min-width: 641px) and (max-width: 1024px)', {
                    showPoint: false,
                    axisX: {
                        labelInterpolationFnc: function (value) {
                            return 'Week ' + value;
                        }
                    }
                }],
                ['screen and (max-width: 640px)', {
                    showLine: false,
                    axisX: {
                        labelInterpolationFnc: function (value) {
                            return 'W' + value;
                        }
                    }
                }]
            ];

            /* Initialize the chart with the above settings */
            new Chartist.Line('#article-daily-posted', data, options, responsiveOptions);

        })();
    </script>
@stop