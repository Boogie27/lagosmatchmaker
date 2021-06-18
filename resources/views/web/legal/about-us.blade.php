<!--ABOUT US HEADER START-->
<section class="message-section">
    <div class="message-container">
        <div class="title-header">
            <h4>About Lagosmatchmaker</h4>
            <p> <a href="{{ url('/') }}">Home</a> - About us</p>
        </div>
    </div>
</section>
<!--ABOUT US HEADER START-->



<!-- ABOUT US START-->
<section class="legal-section">
    <div class="container-main">
        <div class="title-header"><h4>{{ ucfirst($about_us->about_us_title) }}</h4></div>
        <div class="legal-body">
            <p>{!! $about_us->about_us !!}</p>
        </div>
    </div>
</section>
<!-- ABOUT US END-->