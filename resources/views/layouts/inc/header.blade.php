<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <div class="top-left-part">
            <!-- Logo -->
            <a class="logo" href="{!! route('blog.index') !!}" title="បើកទំព័រថ្មី">
                <!-- Logo icon image, you can use font-icon also --><b>
                    <!--This is dark logo icon-->
                    <img src="{!! asset('images/admin-logo.png') !!}" alt="home" class="dark-logo"/>
                    <!--This is light logo icon-->
                    <img src="{!! asset('images/admin-logo-dark.png') !!}" alt="home" class="light-logo"/>
                </b>
                <!-- Logo text image you can use text also -->
                <span class="hidden-xs">
                        <!--This is dark logo text-->
                    <img src="{!! asset('images/admin-text.png') !!}" alt="home" class="dark-logo"/>
                    <!--This is light logo text-->
                    <img src="{!! asset('images/admin-text-dark.png') !!}" alt="home" class="light-logo"/>
                </span>
            </a>
        </div>
        <!-- /Logo -->
        <ul class="nav navbar-top-links navbar-right pull-right">
            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                    @if (auth()->check())
                        @if(auth()->user()->hasThumbnail())
                            <img src="{!! asset('storage/uploads/user/'.auth()->user()->thumbnail()->filename) !!}"
                                 width="36" alt="{!! auth()->user()->name !!}" class="img-circle">
                        @else
                            <img src="{!! asset('images/users/varun.jpg') !!}" alt="user-img" width="36"
                                 class="img-circle">
                        @endif
                        <b class="hidden-xs">{!! auth()->user()->name !!}</b><span class="caret"></span>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">
                    <li>
                        <div class="dw-user-box">
                            <div class="u-img">
                                @if(auth()->user()->hasThumbnail())
                                    <img src="{!! asset('storage/uploads/user/'.auth()->user()->thumbnail()->filename) !!}"
                                         width="36"
                                         alt="{!! auth()->user()->name !!}" class="img-circle">
                                @else
                                    <img src="{!! asset('images/users/varun.jpg') !!}" alt="user-img" width="36">
                                @endif
                            </div>
                            <div class="u-text">
                                <h4>{!! auth()->user()->name !!}</h4>
                                <p class="text-muted">{!! auth()->user()->email !!}</p>
                                <a href="{!! route('admin.manage.user.edit', [auth()->id()]) !!}" class="btn btn-rounded btn-danger btn-sm">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{!! route('admin.profile.user.index') !!}"><i class="ti-user"></i> {!! __('admin.my_profile') !!}</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{!! route('admin.manage.user.edit', [auth()->id()]) !!}"><i class="ti-settings"></i> {!! __('admin.account_setting') !!}</a></li>
                    <li role="separator" class="divider"></li>
                    @if (Auth::check())
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i> {!! __('admin.logout') !!}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endif
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>
<!-- End Top Navigation -->