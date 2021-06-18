<!--ABOUT US HEADER START-->
<section class="message-section">
    <div class="message-container">
        <div class="title-header">
            <h4>Lagosmatchmaker Terms</h4>
            <p> <a href="{{ url('/') }}">Home</a> - Terms</p>
        </div>
    </div>
</section>
<!--ABOUT US HEADER START-->



<!-- ABOUT US START-->
<section class="legal-section">
    <div class="container-main">
        <div class="title-header"><h4>{{ ucfirst($terms->terms_title) }}</h4></div>
        <div class="legal-body">
            <p>{!! $terms->terms !!}</p>
        </div>
    </div>
</section>
<!-- ABOUT US END-->