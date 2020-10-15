<style>
    .page-header.navbar .top-menu .navbar-nav > li.dropdown .dropdown-toggle:hover,
    .page-header.navbar .top-menu .navbar-nav > li.dropdown.open .dropdown-toggle {
        background-color: #ffffff;
    }

    .page-header.navbar .top-menu .navbar-nav > li.dropdown-language > .dropdown-toggle > .langname,
    .page-header.navbar .top-menu .navbar-nav > li.dropdown-user > .dropdown-toggle > .username,
    .page-header.navbar .top-menu .navbar-nav > li.dropdown-user > .dropdown-toggle > i {
        color: #333;
    }

    .page-header.navbar {
        background-color: #ffffff;
        -webkit-box-shadow: 0 3px 12px rgba(51, 51, 51, .07);
        -moz-box-shadow: 0 3px 12px rgba(51, 51, 51, .07);
        box-shadow: 0 3px 12px rgba(51, 51, 51, .07);
    }

    .page-logo {
        background-color: #ffffff;
    }

    .page-header.navbar .menu-toggler > span,
    .page-header.navbar .menu-toggler > span:after,
    .page-header.navbar .menu-toggler > span:before,
    .page-header.navbar .menu-toggler > span:hover,
    .page-header.navbar .menu-toggler > span:hover:after,
    .page-header.navbar .menu-toggler > span:hover:before {
        background-color: #424242;
    }

    @media (min-width: 992px) {
        .page-sidebar-closed.page-sidebar-closed-hide-logo .page-header.navbar .page-logo .logo-text,
        .page-sidebar-closed.page-sidebar-closed-hide-logo .page-header.navbar .page-logo .logo-default {
            display: none !important;
        }
    }
</style>

<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="{{url('/')}}" style="display: flex; align-items: center">
                {{--<img src="{{url('public/admin_ui_assets')}}/layouts/layout/img/logo.png"
                     style="margin: 3px 0 0;"
                     alt="logo"
                     class="logo-default"/>--}}
                <strong class="logo-text"
                        style="margin-left: 10px; color: #141518; line-height: 50px; font-size: 2rem;">Bazar
                    Bondhu</strong>
            </a>
            <div class="menu-toggler sidebar-toggler">
                <span></span>
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse">
            <span></span>
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">

                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                @if(@\Illuminate\Support\Facades\Auth::guard('web_admin')->user()->id)
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <img alt="" class="img-circle"
                                 src="{{url('public/admin_ui_assets')}}/pages/media/users/blank_avatar.png"/>
                            <span class="username username-hide-on-mobile">
                            Bazar Bondhu Admin
                        </span>
                            <i class="fa fa-angle-down"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="javascript:void(0);"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="icon-logout"></i> Sign out
                                </a>

                                <form id="logout-form" action="{{ route('admin-logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>

                    </li>
            @else
            @endif
            <!-- END USER LOGIN DROPDOWN -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->