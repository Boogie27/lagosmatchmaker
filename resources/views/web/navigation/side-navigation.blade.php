<div class="side-navigation-container">
    <div class="side-dark-theme" id="side_dark_theme"></div><!-- dark theme-->
    <div class="side-nav-content" id="side_nav_content">
        <div class="side-nav-btn-container">
            <button class="side-nav-close" id="side_nav_close"><i class="fa fa-times"></i></button>
        </div>
        <ul class="ul-side-nav">
            <li><a href="{{ url('/') }}">Home</a></li>
            <!-- <li><a href="{{ url('/basic') }}">Basic</a></li>
            <li><a href="{{ url('/premium') }}">Premium</a></li> -->
            @if(is_loggedin())
            <li><a href="{{ url('/messages') }}">Message</a></li>
            <li><a href="{{ url('/friends') }}">Matches</a></li>
            <li><a href="{{ url('/manual-payment') }}">Subscription</a></li>
            @endif
            <li><a href="{{ url('/how-it-works') }}">How it works</a></li>
            @if(is_loggedin())
            <li><a href="{{ url('/profile/'.user('id')) }}">Profile</a></li>
            <li><a href="{{ url('/settings') }}">Settings</a></li>
            <li><a href="{{ url('/logout') }}" id="mobile_logout_modal_open_btn">Logout</a></li>
            @else
            <li><a href="{{ url('/login') }}">Login</a></li>
            <li><a href="{{ url('/register') }}">Register</a></li>
            @endif
        </ul>
    </div>
</div>