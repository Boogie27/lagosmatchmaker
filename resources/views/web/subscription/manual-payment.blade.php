


<!-- MESSAGES HEADER START-->
<section class="message-section header-container">
    <div class="message-container">
        <div class="title-header">
            <h4>Manual Payment Option</h4>
            <p> <a href="{{ url('/') }}">Home</a> - Manual payment</p>
        </div>
    </div>
</section>
<!-- MESSAGES HEADER START-->







<!-- MANUAL SUBSCRIPTION START-->
<section class="sub-bottom-section">
    <div class="title-header text-center">
        <!-- <h4>Manual payment</h4> -->
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
    
    @if(is_loggedin() && !user_detail()->id_card)
    <div class="text-center">
        <a href="#" id="{{ $premium->sub_id }}" class="btn-fill manual-payment-modal-open">Upload ID card</a>
    </div>
    @endif
</section>
<!-- MANUAL SUBSCRIPTION END-->
























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
                    <p class="text-warning" style="font-size: 10px;">Contact the admin for any assistance or information</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <input type="file" id="id_card_input" style="display: none;">
                        <div class="alert-form alert_0 text-danger"></div>
                        <div class="form-group">
                            <button type="button" id="ID_card_input_open_btn" class="confirm-btn">Upload Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ID CAR MODAL END -->










































<script>
$(document).ready(function(){

// ******* ID CARD MODAL POPUP OPEN ********* //
var sub_id
var self
$(".manual-payment-modal-open").click(function(e){
    e.preventDefault()
    
    self = $(this)
    sub_id = $(this).attr('id')
    $("#id_card_input").val('')

    check_member(sub_id)
    $("#access_preloader_container").show()
    $("#ID_card_input_open_btn").html('Upload Now')
})






// ******** CHECK IF MEMBER IS IS BASIC OR PREMIUM AND IF MEMBER HAS ID ******//
function check_member(sub_id){

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-check-member-detail') }}",
        method: "post",
        data: {
        sub_id: sub_id
        },
        success: function (response){
            if(response.login){
                location.assign(response.login)
            }else if(response.upload_id){
                $("#ID_card_modal_popup").show()
            }else if(response.payment_page){
                location.assign(response.payment_page)
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $("#access_preloader_container").hide()
        },
        error: function(){
            bottom_alert_error('Network error, try again later!')
        }
    });
}






// ********* ID CARD INPUT OPEN *********//
$("#ID_card_input_open_btn").click(function(e){
    e.preventDefault()
    $("#id_card_input").val('')
    $("#id_card_input").click()
})








// ********* UPLOAD ID CARD *********//
$("#id_card_input").on('change', function(e){
    var image = e.target.files
    var extension = image[0].type;
    $("#ID_card_input_open_btn").html('Please wait...')
    
    if(extension != 'image/jpeg'){
        $("#ID_card_modal_popup").hide()
        return bottom_alert_error('Image type must be jpg, jpeg, png!')
    }

    var data = new FormData();
    var image = $(image)[0];

    data.append('image', image);

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/upload-ID-card-index') }}",
        method: "post",
        data: data,
        contentType: false,
        processData: false,
        success: function (response){
            if(response.error){
                $("#ID_card_input_open_btn").html('Upload Now')
                return $(".alert_0").html(response.error.image)
            }else if(response.data){
                $(self).remove()
                $(".top-banner-start").hide()
                bottom_alert_success('ID card uploaded successfully, you may continue to payment!')
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $("#id_card_input").val('')
            $("#ID_card_modal_popup").hide()
            $("#ID_card_input_open_btn").html('Upload Now')
        },
        error: function(){
            $("#ID_card_modal_popup").hide()
            $("#ID_card_input_open_btn").html('Upload Now')
            bottom_alert_error('Network error, try again later!')
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