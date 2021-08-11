@php($settings = settings())

<!-- SCROLL TOP ICON START-->
<section>
    <div class="angle-up-container nav-links">
        <a href="#" id="smooth_scroll_btn"><i class="fa fa-angle-up"></i></a>
    </div>
</section>
<!-- SCROLL TOP ICON END-->




<!-- FOOTER START-->
<section class="footer-section">
    <div class="footer-container">
        <div class="row">
            @if($settings && $settings->footer_left)
            @php($footer_left = json_decode($settings->footer_left, true))
            <div class="col-xl-4 col-lg-6"> <!-- about start-->
                <div class="footer-content">
                    <ul class="ul-footer-about">
                        <li><h4>{{ ucfirst($footer_left['title']) }}</h4></li>
                        <li>
                            <p>{{ $footer_left['body'] }}</p>
                        </li>
                        <li>
                            <img src="{{ asset($footer_left['image']) }}" alt="">
                        </li>
                    </ul>
                </div>
            </div><!-- about end-->
            @endif
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-10"> <!-- newsletter start-->
                <div class="footer-content">
                    <ul class="ul-footer-about">
                        @if($settings && $settings->footer_middle)
                        @php($footer_middle = json_decode($settings->footer_middle, true))
                        <li><h4>{{ ucfirst($footer_middle['title']) }}</h4></li>
                        <li>
                            <p>{{ $footer_middle['body'] }}</p>
                        </li>
                        @endif
                        <li>
                           <form action="{{ url('/contact') }}" method="POST">
                               <div class="form-group">
                                   <input type="email" id="news_letter_email_input" class="form-control" placeholder="Enter email" required>
                                   <div class="alert-form newsletter-alert text-danger"></div>
                                </div>
                               <div class="form-group">
                                    <button type="button" id="news_letter_submit_btn" class="news-letter-btn"><i class="far fa-envelope"></i> Send Messages</button>
                                    <a href="{{ url('/unsubscribe-newsletter') }}" class="float-right">Unsubscribe</a>
                                </div>
                           </form>
                        </li>
                    </ul>
                    @if($settings && $settings->social_media)
                    @php($social_media = json_decode($settings->social_media, true))
                    <div class="footer-social-media">
                        <label for="" class="s-header">Social Media: </label>
                        @if(isset($social_media['facebook']))
                        <a href="{{ $social_media['facebook'] }}" title="Facebook"><i class="fab fa-facebook"></i></a>
                        @endif
                        @if(isset($social_media['linkedin']))
                        <a href="{{ $social_media['linkedin'] }}" title="Linkedin"><i class="fab fa-linkedin"></i></a>
                        @endif
                        @if(isset($social_media['twitter']))
                        <a href="{{ $social_media['twitter'] }}" title="Twitter"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if(isset($social_media['instagram']))
                        <a href="{{ $social_media['instagram'] }}" title="Instagram"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if(isset($social_media['youtube']))
                        <a href="{{ $social_media['youtube'] }}" title="Youtube"><i class="fab fa-youtube"></i></a>
                        @endif
                    </div>
                    @endif
                </div>
            </div><!-- newsletter end-->
            <div class="col-xl-4 col-lg-6"> <!-- links start-->
                <div class="footer-content">
                    <ul class="ul-footer-links">
                        <li class="footer-link-h"><h4>Contact Links</h4></li>
                        @if($settings && $settings->phone)
                        <li><a href="tel:{{ $settings->phone }}"><i class="fa fa-phone"></i> Phone: {{ $settings->phone }}</a></li>
                        @endif
                        @if($settings && $settings->email)
                        <li><a href="mailto:{{ $settings->email }}"><i class="far fa-envelope"></i> Email: {{ $settings->email }}</a></li>
                        @endif
                        @if($settings && $settings->address)
                        <li><a href="#"><i class="fa fa-map-marker-alt"></i> {{ $settings->address }}</a></li>
                        @endif
                        <li><a href="{{ url('/about-us') }}"><i class="fa fa-users"></i>About us</a></li>
                        <li><a href="{{ url('/terms') }}"><i class="fa fa-folder"></i>Terms & Condition</a></li>
                        <li><a href="{{ url('/privacy-policy') }}"><i class="fa fa-file"></i>Privacy policy</a></li>
                        <li><a href="{{ url('/contact') }}"><i class="fa fa-pen"></i>Contact us</a></li>
                    </ul>
                </div>
            </div><!-- links end-->
        </div>
    </div>
    
    <div class="footer-rights">{{ $settings->copyright }}</div>
</section>
<!-- FOOTER START-->
































<script>
$(document).ready(function(){
// ************* SUBSCRIBE TO NEWS-LETTER *************//
$("#news_letter_submit_btn").click(function(e){
    e.preventDefault()
    $('.newsletter-alert').html('')
    var email = $("#news_letter_email_input").val()

    if(email == ''){
       $('.newsletter-alert').html('*Email field is required')
       return;
    }

    csrf_token() //csrf token
    $("#news_letter_submit_btn").html('Please wait...')

    $.ajax({
        url: "{{ url('/ajax-newsletter-subscription') }}",
        method: "post",
        data: {
            email: email
        },
        success: function (response){
           if(response.error){
                $('.newsletter-alert').html(response.error.email)
           }else if(response.data){
               $("#news_letter_email_input").val('')
                bottom_success_danger('Newsletter subscribed successfully!')
           }

           $("#news_letter_submit_btn").html('<i class="far fa-envelope"></i> Send Messages')
        }, 
        error: function(){
           bottom_error_danger('Network error, try again later!')
        }
    });
})






function bottom_error_danger(string){
    var bottom = '0px';
    var alert =  $("#bottom_alert_danger").children('.bottom-alert-danger')

    if($(window).width() > 767){
        bottom = '5px'
    }

    $(alert).html(string)
    $(alert).css({ bottom: bottom })

    setTimeout(function(){
        $(alert).css({
            bottom: '-100px'
        })
    }, 4000)
}






function bottom_success_danger(string){
    var bottom = '0px';
    var alert =  $("#bottom_alert_success").children('.bottom-alert-success')

    if($(window).width() > 767){
        bottom = '5px'
    }

    $(alert).html(string)
    $(alert).css({ bottom: bottom })

    setTimeout(function(){
        $(alert).css({
            bottom: '-100px'
        })
    }, 4000)
}




// ********* CSRF PAGE TOKEN ***********//
function csrf_token(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf_token']").attr("content")
        }
    });
}





// end
})
</script>

<script type="text/javascript" src="{{ asset('web/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/js/script.js') }}"></script>
