<div class="side-navigation-container">
    <div class="side-dark-theme" id="side_dark_theme"></div><!-- dark theme-->
    <div class="side-nav-content" id="side_nav_content">
        <div class="side-nav-btn-container">
            <button class="side-nav-close" id="side_nav_close"><i class="fa fa-times"></i></button>
        </div>
        <ul class="ul-side-nav">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/members') }}">Members</a></li>
            <li><a href="{{ url('/messages') }}">Message</a></li>
            <li><a href="{{ url('/friends') }}">Friends</a></li>
            <li><a href="{{ url('/subscription') }}">Subscription</a></li>
            <li><a href="{{ url('/how-it-works') }}">How it works</a></li>
            <li><a href="{{ url('/login') }}">Login</a></li>
            <li><a href="{{ url('/register') }}">Register</a></li>
        </ul>
    </div>
</div>