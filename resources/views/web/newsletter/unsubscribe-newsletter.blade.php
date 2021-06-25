<!-- UNSUB HEADER START-->
<section class="message-section">
    <div class="message-container">
        <div class="title-header">
            <h4>Unsubscribe Newsletter</h4>
            <p> <a href="{{ url('/') }}">Home</a> - unsubscribe newsletter</p>
        </div>
    </div>
</section>
<!-- UNSUB HEADER START-->










<!-- UNSUBSCRIBE NEWSLETTER START-->
<section class="news-letter-section">
    <div class="unsubcribe-newsletter">
        <form action="" method="POST">
            <div class="form-group">
                <input type="email" id="unsub_news_letter_email_input" class="form-control" placeholder="Enter email" required>
                <div class="alert-form unsub-newsletter-alert text-danger"></div>
            </div>
            <div class="form-group">
                <button type="button" id="unsub_news_letter_submit_btn" class="news-letter-btn"><i class="far fa-envelope"></i> Unsubscribe Newsletter</button>
            </div>
        </form>
    </div>
</section>

<!-- UNSUBSCRIBE NEWSLETTER START-->

















<script>
$(document).ready(function(){
// ************* SUBSCRIBE TO NEWS-LETTER *************//
$("#unsub_news_letter_submit_btn").click(function(e){
    e.preventDefault()
    $('.unsub-newsletter-alert').html('')
    var email = $("#unsub_news_letter_email_input").val()

    if(email == ''){
       $('.unsub-newsletter-alert').html('*Email field is required')
       return;
    }

    csrf_token() //csrf token
    $("#unsub_news_letter_submit_btn").html('Please wait...')

    $.ajax({
        url: "{{ url('/ajax-newsletter-unsubscription') }}",
        method: "post",
        data: {
            email: email
        },
        success: function (response){
           if(response.error){
                $('.unsub-newsletter-alert').html(response.error.email)
           }else if(response.data){
                $("#unsub_news_letter_email_input").val('')
                bottom_alert_success('Newsletter unsubscribed successfully!')
           }
           $("#unsub_news_letter_submit_btn").html('<i class="far fa-envelope"></i> Unsubscribe Newsletter')
        }, 
        error: function(){
           bottom_error_danger('Network error, try again later!')
           $("#unsub_news_letter_submit_btn").html('<i class="far fa-envelope"></i> Unsubscribe Newsletter')
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






function bottom_alert_success(string){
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