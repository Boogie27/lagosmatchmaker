<!-- Topbar Start -->
<div class="navbar navbar-expand flex-column flex-md-row navbar-custom">
    <div class="container-fluid">
        <!-- LOGO -->
        <a href="{{ url('/admin') }}" class="navbar-brand mr-0 mr-md-2 logo">
            @if(settings()->logo)
            <span class="logo-lg">
                <img src="{{ asset( settings()->logo) }}" alt="" />
                <!-- <span class="d-inline h5 ml-1 text-logo">Lagosmatchmaker</span> -->
            </span>
            @endif
            
            @if(settings()->logo)
            <span class="logo-sm">
                <img src="{{ asset( settings()->logo) }}" alt="" />
            </span>
            @endif
        </a>

        <ul class="navbar-nav bd-navbar-nav flex-row list-unstyled menu-left mb-0">
            <li class="">
                <button class="button-menu-mobile open-left disable-btn">
                    <i data-feather="menu" class="menu-icon"></i>
                    <i data-feather="x" class="close-icon"></i>
                </button>
            </li>
        </ul>

        <ul class="navbar-nav flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">
            <li class="d-none d-sm-block">
                <div class="app-search">
                    <form action="{{ url('/admin/premium') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search...">
                            <span data-feather="search"></span>
                        </div>
                    </form>
                </div>
            </li>


            <li class="dropdown notification-list" data-toggle="tooltip" data-placement="left"
                title="notifications">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                    aria-expanded="false">
                    <i data-feather="bell"></i>
                    <span id="admin_notification_alert" data-url="{{ url('/admin/ajax-get-notification-count') }}" class="noti-icon-badge..."></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                    <!-- item-->
                    <div class="dropdown-item noti-title border-bottom">
                        <h5 class="m-0 font-size-16">
                            <span class="float-right">
                                <a href="#" class="text-dark admin-clear-all-notification">
                                    <small>Clear All</small>
                                </a>
                            </span>Notification
                        </h5>
                    </div>

                    <div class="slimscroll noti-scroll" id="navigation_notification_body" data-url="{{ url('/admin/ajax-get-navi-notification') }}">
                       <!-- added notification using ajax -->
                    </div>
                    

                    <!-- All-->
                    <a href="{{ url('/admin/notification') }}"
                        class="dropdown-item text-center text-primary notify-item notify-all border-top">
                        View all
                        <i class="fi-arrow-right"></i>
                    </a>

                </div>
            </li>

            <li class="dropdown d-none d-lg-block" data-toggle="tooltip" data-placement="left" title="Change settings">
                <a class="nav-link dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <i data-feather="settings"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ url('/admin/settings') }}" class="dropdown-item notify-item">General settings</a>
                    <a href="{{ url('/admin/email-settings') }}" class="dropdown-item notify-item">Email settings</a>
                    <a href="{{ url('/admin/payment-settings') }}" class="dropdown-item notify-item">Payment settings</a>
                    <a href="{{ url('/admin/banner-settings') }}" class="dropdown-item notify-item">Banner settings</a>
                </div>
            </li>
        </ul>
    </div>

</div>
<!-- end Topbar -->

           