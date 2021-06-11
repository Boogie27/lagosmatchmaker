




<!-- LOGOUT ALERT START-->
<section id="logout_preloader_container">
    <div class="logout-preloader-container">
        <div class="logout-preloader-dark-theme">
            <div class="logout-inner-content">
                <ul class="ul-logout">
                    <li class="logout-first">
                        <h4>Logout?</h4>
                        <p>Are you sure you want to logout?</p>
                    </li>
                    <li class="logout-btns">
                        <div class="logout-cancle"><a href="#" id="logout_user_cancle_btn">Cancle</a> </div>
                        <div class="logout-btn"><a href="{{ url('/ajax-logout') }}" id="logout_user_btn" class="logout-btn text-danger">Logout</a></div> 
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- LOGOUT ALERT END-->









<!-- BOTTOM ALERT DANGER POPUP START-->
<section class="bottom-alert" id="bottom_alert_danger">
    <div class="bottom-alert-danger">Network error, try again later!</div>
</section>
<!--  BOTTOM ALERT DANGER POPUP START-->





<!-- BOTTOM ALERT SUCCESS POPUP START-->
<section class="bottom-alert" id="bottom_alert_success">
    <div class="bottom-alert-success">Network error, try again later</div>
</section>
<!--  BOTTOM ALERT SUCCESS POPUP START-->



















<script>
$(document).ready(function(){
// ********** LOGOUT USER *************//
$("#logout_user_btn").click(function(e){
    e.preventDefault()
    var url = $(this).attr('href')
    $("#logout_preloader_container").hide()
    $("#access_preloader_container").show()

    csrf_token() //csrf token

    $.ajax({
        url: url,
        method: "post",
        data: {
            logout: 'logout'
        },
        success: function (response){
            location.reload()
        }
    });
   
})





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