<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/15/2017
 * Time: 10:58 PM
 */
?>
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3>
                <span class="fa-fw open-close">
                    <i class="ti-menu hidden-xs"></i>
                    <i class="ti-close visible-xs"></i>
                </span>
                <span class="hide-menu">Navigation</span>
            </h3>
        </div>
        <ul class="nav" id="side-menu">
            @if (auth()->check())
                <li class="user-pro">
                    <a href="#" class="waves-effect">
                        @if(auth()->user()->hasThumbnail())
                            <img src="{!! asset('storage/uploads/user/'.auth()->user()->thumbnail()->filename) !!}"
                                 width="36" alt="{!! auth()->user()->name !!}" class="img-circle">
                        @else
                            <img src="{!! asset('images/users/varun.jpg') !!}" alt="user-img" width="36"
                                 class="img-circle">
                        @endif
                        <span class="hide-menu">{!! auth()->user()->name !!}<span class="fa arrow"></span></span>
                    </a>
                    <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0;">
                        <li>
                            <a href="javascript:void(0)"><i class="ti-user"></i>
                                <span class="hide-menu">My Profile</span></a></li>
                        <li>
                            <a href="javascript:void(0)"><i class="ti-wallet"></i>
                                <span class="hide-menu">My Balance</span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="ti-email"></i>
                                <span class="hide-menu">Inbox</span></a></li>
                        <li>
                            <a href="javascript:void(0)"><i class="ti-settings"></i>
                                <span class="hide-menu">Account Setting</span></a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i>
                                <span class="hide-menu">Logout</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            <li>
                <a href="{!! route('admin.dashboard') !!}"
                   class="waves-effect{!! Request::is('admin/dashboard') ? ' active': '' !!}">
                    <i class="mdi mdi-av-timer fa-fw" data-icon="v"></i>
                    <span class="hide-menu"> Dashboard
                        <span class="label label-rouded label-inverse pull-right">1</span>
                    </span>
                </a>
            </li>

            <li>
                <a href="#" class="waves-effect">
                    <i class="ti-clipboard fa-fw" data-icon="v"></i>
                    <span class="hide-menu"> Posts <span class="fa arrow"></span>
                        <span class="label label-rouded label-inverse pull-right">3</span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{!! route('admin.article.index') !!}">
                            <i class="fa-fw">A</i>
                            <span class="hide-menu">All</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.article.create') !!}">
                            <i class="fa-fw">N</i>
                            <span class="hide-menu">New</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.article.draft') !!}">
                            <i class="fa-fw">D</i>
                            <span class="hide-menu">Draft</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{!! Request::is('admin/ref/*') ? ' active': '' !!}">
                <a href="#" class="waves-effect{!! Request::is('admin/ref/*') ? ' active': '' !!}">
                    <i class="ti-server fa-fw" data-icon="v"></i>
                    <span class="hide-menu"> Ref.Master Data <span class="fa arrow"></span>
                        <span class="label label-rouded label-inverse pull-right">4</span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="javascript:void(0)" class="waves-effect">
                            <i class="ti-layout-media-overlay fa-fw"></i>
                            <span class="hide-menu">Page</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="{!! route('admin.ref.page.index') !!}">
                                    <i class="fa-fw">L</i>
                                    <span class="hide-menu">List</span>
                                </a>
                            </li>
                            <li>
                                <a href="{!! route('admin.ref.page.create') !!}">
                                    <i class="fa-fw">N</i>
                                    <span class="hide-menu">New</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="waves-effect">
                            <i class="ti-layout-accordion-list fa-fw"></i>
                            <span class="hide-menu">Category</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="{!! route('admin.ref.category.index') !!}">
                                    <i class="fa-fw">L</i>
                                    <span class="hide-menu">List</span>
                                </a>
                            </li>
                            <li>
                                <a href="{!! route('admin.ref.category.create') !!}">
                                    <i class="fa-fw">N</i>
                                    <span class="hide-menu">New</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0)" class="waves-effect">
                            <i class="ti-tag fa-fw"></i>
                            <span class="hide-menu">Tags</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="{!! route('admin.ref.tag.index') !!}">
                                    <i class="fa-fw">A</i>
                                    <span class="hide-menu">All</span>
                                </a>
                            </li>
                            <li>
                                <a href="{!! route('admin.ref.tag.create') !!}">
                                    <i class="fa-fw">N</i>
                                    <span class="hide-menu">New</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{!! route('admin.advertise-type.index') !!}">
                            <i class="fa-fw">A</i>
                            <span class="hide-menu">Advertise Type</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.media-library.index') !!}">
                            <i class="fa-fw">M</i>
                            <span class="hide-menu">Media</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{!! Request::is('admin/manage/*')? 'active' : '' !!}">
                <a href="javascript:void(0)" class="waves-effect {!! Request::is('admin/manage/*')? 'active' : '' !!}">
                    <i class="mdi mdi-content-copy fa-fw"></i>
                    <span class="hide-menu">Manage<span class="fa arrow"></span>
                        <span class="label label-rouded label-warning pull-right">30</span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{!! route('admin.manage.user.index') !!}"
                           class="{!! Request::is('admin/manage/user*')? 'active' : '' !!}">
                            <i class="mdi mdi-account fa-fw"></i>
                            <span class="hide-menu">User</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.manage.role.index') !!}">
                            <i class="mdi mdi-label-outline fa-fw"></i>
                            <span class="hide-menu">Role</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.manage.permission.index') !!}">
                            <i class="mdi mdi-key-variant fa-fw"></i>
                            <span class="hide-menu">Permission</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="waves-effect">
                    <i class="ti-announcement fa-fw" data-icon="v"></i>
                    <span class="hide-menu"> Advertise <span class="fa arrow"></span>
                        <span class="label label-rouded label-inverse pull-right">4</span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{!! route('admin.advertise.index') !!}">
                            <i class=" fa-fw">L</i>
                            <span class="hide-menu">List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.advertise.create') !!}">
                            <i class=" fa-fw">N</i>
                            <span class="hide-menu">New</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.advertise.active') !!}">
                            <i class=" fa-fw">A</i>
                            <span class="hide-menu">Active</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.advertise.expired') !!}">
                            <i class=" fa-fw">E</i>
                            <span class="hide-menu">Expired</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{!! route('admin.settings.index') !!}"
                   class="waves-effect{!! Request::is('admin/settings*') ? ' active': '' !!}">
                    <i class="mdi mdi-av-timer fa-fw" data-icon="v"></i>
                    <span class="hide-menu"> Settings
                        <span class="label label-rouded label-inverse pull-right">1</span>
                    </span>
                </a>
            </li>

            <li class="devider"></li>
            @if (Auth::check())
                <li>
                    <a href="{{ route('logout') }}" class="waves-effect" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout fa-fw"></i>
                        <span class="hide-menu">Log out</span>
                    </a>
                </li>
                <li class="devider"></li>
            @endif
        </ul>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Left Sidebar -->
