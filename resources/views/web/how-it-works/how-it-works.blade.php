

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
        @if(count($how_it_works))
        <div class="how-it-works-container">
            <div class="row">
                @foreach($how_it_works as $how_it_work)
                <div class="col-xl-6 col-lg-6"><!-- how it works start-->
                    <div class="how-it-work-content"> 
                        <img src="{{ asset($how_it_work->image) }}" alt="">
                    </div><!-- how it works end-->
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="text-center" style="color: #fff;">There are no descriptions</div>
        @endif
    </div>
</section>
<!-- HOW IT WORKS END-->








<!-- HOW IT WORKS SEARCH MODAL-->
@include('web.how-it-works.member-search-modal-popup')