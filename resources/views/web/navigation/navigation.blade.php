<div class="navigation-container" id="navigation-container">
    <div class="navigation">
        <div class="nav-content">
            <div class="nav-inner"><!-- NAVIGATION DESKTOP START -->
                <div class="nav-left">
                   <a href="{{ url('/') }}">
                        <img src="{{asset(settings()->logo) }}" alt="logo" class="app-logo">
                    </a>
                </div>
                <div class="nav-right">
                    <ul class="ul-nav-right">
                        <li><a href="{{ url('/') }}">HOME</a></li>
                        @if(is_loggedin())
                        <li><a href="{{ url('/manual-payment') }}">SUBSCRIPTION</a></li>
                        @endif
                        <li><a href="{{ url('/how-it-works') }}">HOW IT WORKS</a></li>
                        <li><a href="{{ url('https://lagosmatchmaker.ng/') }}">ABOUT US</a></li>
                        @if(is_loggedin())
                        <li>
                            <div class="notification-drop-down">
                                <a href="{{ url('/friends') }}">
                                    <i class="fa fa-users notification-icon notification-users-icon notification_users_icon_js">
                                        @if(nav_user_likes() > 0)
                                        <span class="badge bg-danger">{{ nav_user_likes() }}</span>
                                        @endif
                                    </i>
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="notification-drop-down">
                                <a href="{{ url('/messages') }}">
                                    <i class="far fa-comment notification-icon notification-users-icon">
                                    @if($unread = unread_nav_msg())
                                    <span class="badge bg-danger">{{ $unread }}</span>
                                    @endif
                                    </i>
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="notification-drop-down">
                                <a href="{{ url('/profile/'. user('id')) }}">
                                    <i class="fa fa-user notification-icon notification-users-icon"></i>
                                </a>
                            </div>
                        </li>
                        @endif
                        <li>
                            @if(is_loggedin())
                                <a href="{{ url('/logout') }}" id="logout_modal_open_btn" class="nav-login"><i class="fa fa-user"></i> LOG OUT</a>
                            @else
                                <a href="{{ url('/login') }}" class="nav-login"><i class="fa fa-user"></i> LOG IN</a>
                                <a href="{{ url('/register') }}" class="nav-signup"><i class="fa fa-users"></i> SIGNUP</a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div><!-- NAVIGATION DESKTOP END -->

            <div class="inner-nav-mobile"> <!-- NAVIGATION MOBILE START -->
                <div class="nav-left-mobile">
                    <a href="{{ url('/') }}">
                        <img src="{{asset(settings()->logo) }}" alt="logo" class="app-logo">
                    </a>
                </div>
                <div class="nav-right-mobile">
                    <ul class="nav-right-small">
                    @if(is_loggedin())
                        <li>
                            <div class="notification-drop-down">
                                <a href="{{ url('/profile/'. user('id')) }}">
                                    <i class="fa fa-user notification-icon notification-users-icon"></i>
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="notification-drop-down">
                                <a href="{{ url('/messages') }}">
                                    <i class="far fa-comment notification-icon notification-users-icon">
                                        @if($unread = unread_nav_msg())
                                        <span class="badge bg-danger">{{ $unread }}</span>
                                        @endif
                                    </i>
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="notification-drop-down">
                                <a href="{{ url('/friends') }}">
                                    <i class="fa fa-users notification-icon notification-users-icon notification_users_icon_js">
                                        @if(nav_user_likes() > 0)
                                        <span class="badge bg-danger">{{ nav_user_likes() }}</span>
                                        @endif
                                    </i>
                                </a>
                            </div>
                        </li>
                        <li><a href="#" class="side-navigation-open-button"><i class="fa fa-bars"></i></a></li>
                        @else
                        <li><a href="#" class="side-navigation-open-button"><i class="fa fa-bars"></i></a></li>
                        <li>
                            <a href="{{ url('/how-it-works') }}" class="nav-font">How it works</a>
                            <a href="{{ url('/login') }}" class="nav-font">Login</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div><!-- NAVIGATION MOBILE END -->
        </div>
    </div>
</div>



