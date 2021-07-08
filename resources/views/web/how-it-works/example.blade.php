

<!-- MESSAGES HEADER START-->
<section class="message-section">
    <div class="message-container">
        <div class="title-header">
            <h4>How It Works</h4>
            <p> <a href="{{ url('/') }}">Home</a> - How it works</p>
        </div>
    </div>
</section>
<!-- MESSAGES HEADER START-->








<!-- HOW IT WORKS START-->
<section class="how-section">
    <div class="how-it-wrks-container">
        <div class="title-header text-center">
            <p>How Does It Work!</p>
            <h3>You Are Just some Steps Away From <br> A Greate Date</h3>
        </div>
        <div class="how-it-works-body">
            <div class="how-it-work-content"> <!-- how it works start-->
                <ul class="ul-how-it-work">
                    <li class="hiw-img"><img src="{{ asset('web/images/icons/6.jpg') }}" alt=""></li>
                    <li><h4>Create An Account</h4></li>
                    <li>
                        <p>
                            You Are Just Three Steps Away From A Greate Date
                            You Are Just Three Steps Away From A Greate Date
                        </p>
                    </li>
                    <li class="hiw-button"><a href="{{ url('/register') }}">Get started</a></li>
                </ul>
            </div><!-- how it works end-->

            <div class="how-it-work-content"> 
                <ul class="ul-how-it-work">
                    <li class="hiw-img"><img src="{{ asset('web/images/icons/8.jpg') }}" alt=""></li>
                    <li><h4>Find A Match</h4></li>
                    <li>
                        <p>
                            You Are Just Three Steps Away From A Greate Date
                            You Are Just Three Steps Away From A Greate Date
                        </p>
                    </li>
                    <li class="hiw-button"><a href="#" data-modal="#member_search_form_modal">Search members</a></li>
                </ul>
            </div>

            <div class="how-it-work-content"> <!-- how it works start-->
                <ul class="ul-how-it-work">
                    <li class="hiw-img"><img src="{{ asset('web/images/icons/7.jpg') }}" alt=""></li>
                    <li><h4>Start Dating</h4></li>
                    <li>
                        <p>
                            You Are Just Three Steps Away From A Greate Date
                            You Are Just Three Steps Away From A Greate Date
                        </p>
                    </li>
                    <li class="hiw-button"><a href="{{ url('/basic') }}">Get started</a></li>
                </ul>
            </div><!-- how it works end-->
        </div>
    </div>
</section>
<!-- HOW IT WORKS END-->








<!-- HOW IT WORKS SEARCH MODAL-->
@include('web.how-it-works.member-search-modal-popup')