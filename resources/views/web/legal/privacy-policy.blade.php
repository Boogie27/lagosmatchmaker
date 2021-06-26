<!--ABOUT US HEADER START-->
<section class="message-section">
    <div class="message-container">
        <div class="title-header">
            <h4>Privacy Policy</h4>
            <p> <a href="{{ url('/') }}">Home</a> - Privacy Policy</p>
        </div>
    </div>
</section>
<!--ABOUT US HEADER START-->



<!-- ABOUT US START-->
<section class="legal-section">
    <div class="container-main">
        <div class="title-header"><h4>{{ ucfirst($privacy->privacy_title) }}</h4></div>
        <div class="legal-body">
            <p>{!! $privacy->privacy_policy !!}</p>
        </div>
    </div>
</section>
<!-- ABOUT US END-->