<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{!! asset('bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
    @yield('bootstrap')
    <link href="{!! asset('plugins/sidebar-nav/dist/sidebar-nav.min.css') !!}" rel="stylesheet">
    <!-- toast CSS -->
    <link href="{!! asset('plugins/toast-master/css/jquery.toast.css') !!}" rel="stylesheet">
    @yield('page-css')
    <link href="{!! asset('css/animate.css') !!}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{!! asset('css/style.css') !!}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{!! asset('css/colors/default.css') !!}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('style')
</head>
<body class="fix-header">
<div id="app">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
    @include('layouts.inc.header')
    @include('layouts.inc.menu')

    <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">{!! isset($page_title) ? $page_title : 'Home' !!}</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20">
                            <i class="ti-settings text-white"></i></button>
                        <ol class="breadcrumb">
                            <li><a href="{!! route('admin.dashboard') !!}">Dashboard</a></li>
                            <li class="active">Starter Page</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                </button>
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        @if ($message = Session::get('info'))
                            <div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                </button>
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        @if ($message = Session::get('warning'))
                            <div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                </button>
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                </button>
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                    </div>
                    @yield('content')
                </div>
                @include('layouts.inc.right-sidebar')
            </div>
            <!-- /.container-fluid -->
            @include('layouts.inc.footer')
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- /#wrapper -->
</div>

<!-- Scripts -->
{{--<script src="{{ asset('js/app.js') }}"></script>--}}

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{ asset('plugins/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
<!--Slimscroll JavaScript -->
<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('js/waves.js') }}"></script>
<script src="{!! asset('plugins/toast-master/js/jquery.toast.js') !!}"></script>
<script src="{!! asset('js/toastr.js') !!}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{ asset('js/custom.js') }}"></script>
<!-- Plugin JavaScript -->
<script src="{!! asset('plugins/moment/moment.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/vue/vue.js') !!}"></script>
<script src="{!! asset('js/vue/vue-resource.min.js') !!}"></script>
<script src="{!! asset('js/vue/vue-axios.min.js') !!}"></script>
@yield('plugins')
@yield('scripts')
<!--Style Switcher -->
<script src="{{ asset('plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
<script>
    $(function () {
                @if(Session::has('message'))
        let type = "{{ Session::get('alert-type', 'info') }}";
        switch (type) {
            case 'info':
                $.toast({
                    heading: 'Welcome to my Elite admin',
                    text: {{ Session::get('message') }},
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'info',
                    hideAfter: 3000,
                    stack: 6
                });
                break;
            case 'warning':
                $.toast({
                    heading: 'Welcome to my Elite admin',
                    text: {{ Session::get('message') }},
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'warning',
                    hideAfter: 3000,
                    stack: 6
                });
                break;
            case 'success':
                $.toast({
                    heading: 'Welcome to my Elite admin',
                    text: {{ Session::get('message') }},
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'success',
                    hideAfter: 3000,
                    stack: 6
                });
                break;
            case 'error':
                $.toast({
                    heading: 'Welcome to my Elite admin',
                    text: {{ Session::get('message') }},
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'error',
                    hideAfter: 3000,
                    stack: 6
                });
                break;
        }
        @endif
    })
</script>
</body>
</html>
