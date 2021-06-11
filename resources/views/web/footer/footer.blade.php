

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
            <div class="col-xl-4 col-lg-6"> <!-- about start-->
                <div class="footer-content">
                    <ul class="ul-footer-about">
                        <li><h4>About Lagos Match Maker</h4></li>
                        <li>
                            <p>
                                You Are Just Three Steps Away From A Greate Date <br>
                                You Are Just Three Steps Away From A Greate Date
                            </p>
                        </li>
                        <li>
                            <img src="{{ asset('web/images/banner/5.jpg') }}" alt="">
                        </li>
                    </ul>
                </div>
            </div><!-- about end-->
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-10"> <!-- newsletter start-->
                <div class="footer-content">
                    <ul class="ul-footer-about">
                        <li><h4>Signup To Our Newsletter</h4></li>
                        <li>
                            <p>
                                By subscribing to our mailing list you will always <br>
                                be updated with the lastest news from us.
                            </p>
                        </li>
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
                </div>
            </div><!-- newsletter end-->
            <div class="col-xl-4 col-lg-6"> <!-- links start-->
                <div class="footer-content">
                    <ul class="ul-footer-links">
                        <li class="footer-link-h"><h4>Contact Links</h4></li>
                        <li><a href="#"><i class="fa fa-phone"></i> Phone: 08023124563</a></li>
                        <li><a href="#"><i class="far fa-envelope"></i> Email: lagosmatchmaker@gmail.com</a></li>
                        <li><a href="#"><i class="fa fa-map-marker-alt"></i> 8/9 James Afred way, Victorial Island, Lagos Nigeria.</a></li>
                        <li><a href="{{ url('/contact') }}"><i class="fa fa-pen"></i>Contact us</a></li>
                    </ul>
                </div>
            </div><!-- links end-->
        </div>
    </div>
    <div class="footer-rights">Copyright lagosmatchmaker &copy; 2021. All Rights Reserved.</div>
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
