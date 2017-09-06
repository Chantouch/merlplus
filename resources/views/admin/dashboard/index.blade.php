@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{!! asset('plugins/morrisjs/morris.css') !!}">
    <link rel="stylesheet" href="{!! asset('plugins/chartist-js/dist/chartist.min.css') !!}">
    <link rel="stylesheet"
          href="{!! asset('plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') !!}">
    <link rel="stylesheet" href="{!! asset('plugins/calendar/dist/fullcalendar.css') !!}">
@stop
@section('content')
    <div class="col-md-12">
        @include('admin.dashboard.different-data-widgets')
        <div class="row">
            <div class="col-md-12 col-lg-6 col-sm-12 col-xs-12">
                <div class="white-box">
                    <h3 class="box-title">Products Yearly Sales</h3>
                    <ul class="list-inline text-right">
                        <li>
                            <h5><i class="fa fa-circle m-r-5 text-info"></i>Mac</h5>
                        </li>
                        <li>
                            <h5><i class="fa fa-circle m-r-5 text-danger"></i>Windows</h5>
                        </li>
                    </ul>
                    {!! $year !!}
                    <div id="ct-visits" style="height: 285px;"></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 col-sm-6 col-xs-12">
                <div class="bg-theme-alt">
                    <div id="ct-daily-sales" class="p-t-30" style="height: 300px"></div>
                </div>
                <div class="white-box">
                    <div class="row">
                        <div class="col-xs-8">
                            <h2 class="m-b-0 font-medium">Week Sales</h2>
                            <h5 class="text-muted m-t-0">Ios app - 160 sales</h5>
                        </div>
                        <div class="col-xs-4">
                            <div class="circle circle-md bg-info pull-right m-t-10"><i class="ti-shopping-cart"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-3 col-xs-12">
                <div class="bg-theme white-box m-b-0">
                    <ul class="expense-box">
                        <li><i class="wi wi-day-cloudy text-white"></i>
                            <div>
                                <h1 class="text-white m-b-0">35<sup>o</sup></h1>
                                <h4 class="text-white">Clear and sunny</h4>
                            </div>
                        </li>
                    </ul>
                    <div id="ct-weather" style="height: 120px"></div>
                    <ul class="dp-table text-white">
                        <li>05 AM</li>
                        <li>10 AM</li>
                        <li>03 PM</li>
                        <li>08 PM</li>
                    </ul>
                </div>
                <div class="white-box">
                    <div class="row">
                        <div class="col-xs-8">
                            <h2 class="m-b-0 font-medium">Sunday</h2>
                            <h5 class="text-muted m-t-0">March 2017</h5>
                        </div>
                        <div class="col-xs-4">
                            <div class="circle circle-md bg-success pull-right m-t-10"><i class="wi wi-day-sunny"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.dashboard.wallet-user-widgets')
        @include('admin.dashboard.profile-inbox-widgets')
        @include('admin.dashboard.calendar-todo-widgets')
        @include('admin.dashboard.blog-component-widgets')
        @include('admin.dashboard.chats-message-widgets')
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
    <script src="{!! asset('js/dashboard1.js') !!}"></script>
    <script src="{!! asset('js/cbpFWTabs.js') !!}"></script>
@stop
@section('scripts')
    <script type="text/javascript">
        (function () {
            [].slice.call(document.querySelectorAll('.sttabs')).forEach(function (el) {
                new CBPFWTabs(el);
            });
            //ct-visits
            new Chartist.Line('#ct-visits', {
                labels: ['2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015'],
                series: [
                    [5, 2, 7, 4, 5, 3, 5, 4],
                    [6, 7, 1, 65, 2, 56, 2, 44],
                    [2, 5, 82, 26, 62, 35, 92, 54],
                    [42, 15, 2, 6, 2, 55, 20, 24]
                ]
            }, {
                top: 0,
                low: 1,
                showPoint: true,
                fullWidth: true,
                plugins: [
                    Chartist.plugins.tooltip()
                ],
                axisY: {
                    labelInterpolationFnc: function (value) {
                        return (value / 1) + 'k';
                    }
                },
                showArea: true
            });
        })();
    </script>
@stop