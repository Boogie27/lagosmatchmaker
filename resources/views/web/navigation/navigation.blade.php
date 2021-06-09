<div class="navigation-container" id="navigation-container">
    <div class="navigation">
        <div class="nav-content">
            <div class="nav-inner"><!-- NAVIGATION DESKTOP START -->
                <div class="nav-left">
                    <img src="{{asset('web/images/icons/logo.png') }}" alt="logo" class="app-logo">
                </div>
                <div class="nav-right">
                    <ul class="ul-nav-right">
                        <li><a href="{{ url('/') }}">HOME</a></li>
                        <li>
                            <div class="drop-down">
                                <a href="#" class="drop-down-btn">MEMBERS</a>
                                <ul class="drop-down-body ul-drop-down">
                                    <li><a href="{{ url('/basic') }}">Basic</a></li>
                                    <li><a href="{{ url('/premium') }}">Premium</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="{{ url('/subscription') }}">SUBSCRIPTION</a></li>
                        <li><a href="{{ url('/how-it-works') }}">HOW IT WORKS</a></li>
                        @if(is_loggedin())
                        <li>
                            <div class="notification-drop-down">
                                <a href="{{ url('/friends') }}">
                                    <i class="fa fa-users notification-icon notification-users-icon">
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
                                <i class="far fa-bell drop-down-btn notification-icon">
                                    <span class="badge bg-danger">0</span>
                                </i>
                                <ul class="drop-down-body ul-notification-body">
                                    <h4 class="drop-down-header">Notification</h4>
                                    <li>
                                        <a href="#">
                                            <h5>charles recently likes you</h5>
                                            <p>click to like charles back</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <h5>charles recently likes you</h5>
                                            <p>click to like charles back</p>
                                        </a>
                                    </li>
                                </ul>
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
                    <img src="{{asset('web/images/icons/logo.png') }}" alt="logo" class="app-logo">
                </div>
                <div class="nav-right-mobile">
                    <ul class="nav-right-small">
                    @if(is_loggedin())
                        <li>
                            <div class="notification-drop-down">
                                <a href="{{ url('/friends') }}">
                                    <i class="fa fa-users notification-icon notification-users-icon">
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
                                <i class="far fa-bell drop-down-btn notification-icon">
                                    <span class="badge bg-danger">0</span>
                                </i>
                                <ul class="drop-down-body ul-notification-body">
                                    <h4 class="drop-down-header">Notification</h4>
                                    <li>
                                        <a href="#">
                                            <h5>charles recently likes you</h5>
                                            <p>click to like charles back</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <h5>charles recently likes you</h5>
                                            <p>click to like charles back</p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif
                        <li><a href="#" class="side-navigation-open-button"><i class="fa fa-bars"></i></a></li>
                    </ul>
                </div>
            </div><!-- NAVIGATION MOBILE END -->
        </div>
    </div>
</div>
