<!-- MESSAGES HEADER START-->
<section class="message-section header-container">
    <div class="message-container">
        <div class="title-header">
            <h4>Membership Level</h4>
            <p> <a href="{{ url('/') }}">Home</a> - Subscription</p>
        </div>
    </div>
</section>
<!-- MESSAGES HEADER START-->



<!-- SUBSCRIPTION START-->
<section class="subscription-section">
    <div class="subscritpion-alert">
    @if(Session::has('error'))
        <div class="main-alert-danger text-center mb-3">{{ Session::get('error')}}</div>
    @endif
    @if(Session::has('success'))
        <div class="main-alert-success text-center mb-3">{{ Session::get('success')}}</div>
    @endif
    </div>
    <div class="subscription-body">
        <div class="subscription-content">
            @if(count($subscriptions))
            @foreach($subscriptions as $subscription)
            <div class="subscription-banner"><!-- subscription start-->
                <img src="{{ asset('web/images/banner/sub-2.svg') }}" alt="">
                <ul class="ul-sub-head">
                    <li><p>{{ ucfirst($subscription->type) }}</p></li>
                    @if($subscription->amount == 0)
                    <li><h3>Free</h3></li>
                    <li><p>Membership currently free</p></li>
                    @else
                    <li><h3><span>₦</span>{{ money($subscription->amount) }}</h3></li>
                    <li><p>Per Month</p></li>
                    @endif
                </ul>
                <ul class="ul-sub-body">
                    @if($subscription->description)
                    <li>
                        <p>{{ $subscription->description }}</p>
                    </li>
                    @endif
                    @if($subscription->type == 'basic' && $subscription->amount == 0)
                    <li style="color: #fff;">.</li>
                    @else
                    <li><a href="#" id="{{ $subscription->sub_id }}" class="subscrition-btn-open">Subscribe Now</a></li>
                    @endif
                </ul>
            </div><!-- subscription start-->
            @endforeach
            @else
            <div class="empty-page">
                <p>There are no subscriptions yet!</p>
            </div>
            @endif
        </div>
    </div>
</section>
<!-- SUBSCRIPTION END-->


<!-- MANUAL SUBSCRIPTION START-->
<section class="sub-bottom-section">
    <div class="title-header text-center">
        <h4>Manual payment</h4>
        <p>Make payment manually through bank transfer</p>
    </div>
    <div class="manual-sub-body">
        @if($images)
        <div class="bank-icons">
            @foreach($images as $image)
            <img src="{{ asset($image) }}" alt="">
            @endforeach
        </div>
        @endif
        @if($descriptions)
        <ul class="ul-manual-sub-body">
            @php($x = 1)
            @foreach($descriptions as $description)
                <li><span>{{ $x}}.</span> <p>{{ $description }}</p></li>
                @php($x++)
            @endforeach
        </ul>
        @endif
    </div>
</section>
<!-- MANUAL SUBSCRIPTION END-->



















<!-- SUBSCRIPTION ALERT START -->
<section class="modal-alert-popup" id="sub_confirm_container">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <div class="alert-form alert_1 text-danger"></div>
                    <p>Do you wish to subscribe to this plan?</p>
                </div>
                <div class="confirm-form">
                    <form action="{{ url('/subscription') }}" method="POST">
                        <input type="hidden" id="subscribe_id_input">
                        <button type="button" data-url="{{ url('/ajax-subscribe-now') }}" id="subscribe_to_plan_submit_btn" class="confirm-btn">Subscribe Now</button>
                        <button type="submit" id="subcription_paystack_btn" style="display: none;"></button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- SUBSCRIPTION ALERT END -->






<!-- SUBSCRIPTION ALERT START -->
<section class="modal-alert-popup" id="sub_continue_to_paystack">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to continue to paystack?</p>
                </div>
                <div class="confirm-form">
                    <form action="{{ url('/subscription') }}" method="POST">
                        <input type="hidden" id="subscribe_id_input">
                        <button type="submit" id="subcription_continue_paystack_btn" class="confirm-btn">Subscribe Now</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- SUBSCRIPTION ALERT END -->





<!-- ID CAR MODAL START -->
<section class="modal-alert-popup" id="ID_card_modal_popup">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <h4>Upload ID Card</h4>
                    <p>Upload Government issued or valid ID card, 1MB max</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <input type="file" id="id_card_input" style="display: none;">
                        <div class="alert-form alert_0 text-danger"></div>
                        <div class="form-group">
                            <button type="button" data-url="{{ url('/upload-ID-card') }}" id="ID_card_input_open_btn" class="confirm-btn">Upload Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ID CAR MODAL END -->































































<!-- ************ SUBSCRIPTION JAVASCRIPT SECTION ************** -->
<script>
$(document).ready(function(){

// ********* CLOSE SUBSCRIPTION CONFIRM BOX *********//
$(".confirm-box-close").click(function(e){
    e.preventDefault()
    $(".modal-alert-popup").hide()
})



// ********* DARK SKIN CLOSE SUBSCRIPTION CONFIRM BOX *********//
$(window).click(function(e){
    if($(e.target).hasClass('sub-confirm-dark-theme'))
    {
        $(".modal-alert-popup").hide()
    }
})



// ********* CLOSE SUBSCRIPTION OPEN CONFIRM BOX ********* //
$(".subscrition-btn-open").click(function(e){
    e.preventDefault()
    var id = $(this).attr('id')
    $(".alert_1").html('')
    $("#subscribe_id_input").val(id)
    $("#sub_confirm_container").show()
})





// ********** SUBSCRIBE TO PLAN ************//
$("#subscribe_to_plan_submit_btn").click(function(e){
    e.preventDefault()
    $(".alert_1").html('')
    var sub_id =  $("#subscribe_id_input").val()
    url = $('#subscribe_to_plan_submit_btn').attr('data-url')
    $("#sub_confirm_container").hide()
    $("#access_preloader_container").show()

    csrf_token() //csrf token

    $.ajax({
        url: url,
        method: "post",
        data: {
            sub_id: sub_id
        },
        success: function (response){
            if(response.login){
                location.assign(response.login)
            }else if(response.id_card){
                $("#access_preloader_container").hide()
                $("#ID_card_modal_popup").show()
            }else if(response.data){
                $("#subcription_paystack_btn").click()//proceed to paystack
            }else{
                $("#sub_confirm_container").show()
                $("#access_preloader_container").hide()
                $(".alert_1").html('Network error, try again later!')
            }
        }, 
        error: function(){
            $("#subscribe_to_plan_submit_btn").html('Subscribe Now')
            $(".alert_1").html('Network error, try again later!')
        }
    });
})







// ********* ID CARD INPUT OPEN *********//
$("#ID_card_input_open_btn").click(function(e){
    e.preventDefault()
    $("#id_card_input").click()
})




// ********* UPLOAD ID CARD *********//
$("#id_card_input").on('change', function(){
    var url = $("#ID_card_input_open_btn").attr('data-url');
    var image = $("#id_card_input");
    var sub_id =  $("#subscribe_id_input").val()
    $("#ID_card_input_open_btn").html('Please wait...')

    var data = new FormData();
    var image = $(image)[0].files[0];

    data.append('image', image);
    data.append('sub_id', sub_id);

    csrf_token() //csrf token

    $.ajax({
        url: url,
        method: "post",
        data: data,
        contentType: false,
        processData: false,
        success: function (response){
            if(response.error){
                $(".alert_0").html(response.error.image)
            }else if(response.login){
                location.assign(response.login)
            }else if(response.data){
                $("#ID_card_modal_popup").hide()
                show_continue_payment()
            }else{
                $(".alert_0").html('Network error, try again later!')
            }
            $("#id_card_input").val('')
            $("#ID_card_input_open_btn").html('Upload Now')
        },
        error: function(){
            $("#id_card_input").val('')
            $("#ID_card_input_open_btn").html('Upload Now')
            $(".alert_0").html('Network error, try again later!')
        }
    });
})






// **********DISPLAY CONTINEU PAYMENT MODAL **********
function show_continue_payment(){
    $("#access_preloader_container").show()
    setTimeout(function(){
        $("#sub_continue_to_paystack").show()
        $("#access_preloader_container").hide()
    }, 500)
}




// *********** PAYSTACK PAYMENT *************//
$("#subcription_continue_paystack_btn").click(function(e){
    e.preventDefault()
    $("#subcription_paystack_btn").click()
    $("#subcription_continue_paystack_btn").html('Please wait...')
})





// ********* CSRF PAGE TOKEN ***********//
function csrf_token(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf_token']").attr("content")
        }
    });
}




// ********** REMOVE ACCESS PRELOADER ***********//
function preloader_toggle(){
    $("#access_preloader_container").show()
    setTimeout(function(){
        $("#access_preloader_container").hide()
    }, 1000)
}



// end
})
</script>