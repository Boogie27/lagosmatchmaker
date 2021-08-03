




<!-- <div class="home-empty-content"></div> -->

@if(count($latest_members))
<section class="latest-members-section">
    <div class="title-header">
            <h4>Latest Members</h4>
            <p> Lagosmatchmaker newly registered members</p>
        </div>
    <div class="latest-members">
        <div class="row">
            @foreach($latest_members as $latest_member)
            @php($image =  gender($latest_member->gender))
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 "> <!-- member start-->
                <a href="{{ url('/profile/'.$latest_member->id) }}">
                    <div class="member-content">
                        <ul>
                            <li class="header">
                                <h3>{{ $image }}</h3>
                            </li>
                            <li class="level pt-2 {{ $latest_member->is_active ? 'text-success' : 'text-danger' }}">{{ $latest_member->is_active ? 'online' : 'offline' }}</li>
                            <li class="name">{{ $latest_member->user_name }}</li>
                            <li class="level">{{ ucfirst($latest_member->membership_level) }} Member</li>
                        </ul>
                    </div>
                </a>
            </div><!-- member end-->
            @endforeach
        </div>
    </div>
</section>
@endif





<!-- SUBSCRIPTION START-->
<section class="index-subscription-section">
    <div class="subscritpion-alert">
    @if(Session::has('error'))
        <div class="main-alert-danger text-center mb-3">{{ Session::get('error')}}</div>
    @endif
    @if(Session::has('success'))
        <div class="main-alert-success text-center mb-3">{{ Session::get('success')}}</div>
    @endif
    </div>
    <div class="index-subscription-content">
        <!-- <div class="text-center">
            <a href="#" id="start_record_audio_btn" class="btn-fill">Start recording...</a>
            <a href="#" id="stop_record_audio_btn" class="btn btn-danger">Stop recording</a>
        </div> -->
        <br><br>
        <div class="row">
            <div class="col-xl-8"><!-- sub content start-->
                <div class="main-subscription-body">
                @if(count($subscriptions))
                    @foreach($subscriptions as $subscription)
                    <div class="index-subscription-banner"><!-- sub start-->
                        <div class="sub-banner">
                            <img src="{{ asset('web/images/banner/sub-2.svg') }}" alt="">
                            <ul class="ul-index-sub-head">
                                <li><b><p>{{ ucfirst($subscription->type) }}</p></b></li>
                                @if($subscription->amount == 0)
                                <li><h3>Free</h3></li>
                                <li><p>Membership currently free</p></li>
                                @else
                                <li><h3><span>₦</span>{{ money($subscription->amount) }}</h3></li>
                                <li><p>Per Month</p></li>
                                @endif
                            </ul>
                        </div>
                        <ul class="ul-index-sub-body">
                            @if($subscription->description)
                            <li class="text-center">
                                <p>{{ $subscription->description }}</p>
                            </li>
                            @endif
                            @if($subscription->type == 'basic' && $subscription->amount != 0 || $subscription->type == 'premium')
                                @if(!is_loggedin())
                                <li class="text-center"><a href="#" class="btn-fill manual-payment-btn">Subscribe Now</a></li>
                                @else
                                <li class="text-center"><a href="#" id="{{ $subscription->sub_id }}" class="btn-fill manual-payment-modal-open">Subscribe Now</a></li>
                                @endif
                            @endif
                        </ul>
                    </div><!-- sub end-->
                    @endforeach
                @endif    
                @if($personalized && $personalized['is_feature'])
                    <div class="index-subscription-banner"><!-- sub start-->
                        <div class="sub-banner">
                            <img src="{{ asset('web/images/banner/sub-2.svg') }}" alt="">
                                <ul class="ul-index-sub-head">
                                    <li><b><p>{{ $personalized['title'] }}</p></b></li>
                                    <li><h3><i class="fa fa-phone-alt"></i></h3></li>
                                    <li><p>{{ $personalized['head'] }}</p></li>
                                </ul>
                        </div>
                        <ul class="ul-index-sub-body">
                            <li><p>{!!  $personalized['descriptions'] !!}</p></li>
                            @if(is_loggedin())
                            <li class="text-center"><a href="https://api.whatsapp.com/send?phone={{ settings()->phone }}" class="btn-fill">Subscribe Now</a></li>
                            @else
                            <li class="text-center">
                                <a href="#" class="btn-fill manual-payment-btn">Contact Us Now</a>
                            </li>
                            @endif
                        </ul>
                    </div><!-- sub end-->
                </div>
                @endif
            </div><!-- sub content end-->
            <div class="col-xl-4"><!-- form content start-->
                <div class="search-bar-container">
                    <div class="inner-search-form">
                        <form action="{{ url('/search') }}" method="GET">
                            <div class="slider-form-header">
                            @if(settings() && settings()->home_page)
                            @php($home_page = json_decode(settings()->home_page, true))
                                <h4>{{ strtoupper($home_page['title']) }}</h4>
                                <p>{{ $home_page['body'] }}</p>
                            @endif
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group flex">
                                            <label for="">I am: </label>
                                            <select name="i_am" class="selectpicker form-control">
                                                <option value="">Select</option>
                                                <option value="male">Man</option>
                                                <option value="female">Woman</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="col-lg-12">
                                        <div class="form-group flex">
                                            <label for="">Looking for: </label>
                                            <select name="looking_for" class="selectpicker form-control">
                                                <option value="">Select</option>
                                                <option value="man">Man</option>
                                                <option value="woman">Woman</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="col-lg-12">
                                        <div class="form-group flex">
                                            <label for="">Age: </label>
                                            <div class="form-items">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                        <select name="from_age" class="selectpicker form-control">
                                                            <option value="">From</option>
                                                            <option value="18">18</option>
                                                            <option value="20">20</option>
                                                            <option value="25">25</option>
                                                            <option value="30">30</option>
                                                            <option value="35">35</option>
                                                            <option value="40">40</option>
                                                            <option value="45">45</option>
                                                            <option value="50">50</option>
                                                            <option value="55">55</option>
                                                            <option value="60">60</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                        <select name="to_age" class="selectpicker form-control">
                                                            <option value="">To</option>
                                                            <option value="18">18</option>
                                                            <option value="20">20</option>
                                                            <option value="25">25</option>
                                                            <option value="30">30</option>
                                                            <option value="35">35</option>
                                                            <option value="40">40</option>
                                                            <option value="45">45</option>
                                                            <option value="50">50</option>
                                                            <option value="55">55</option>
                                                            <option value="60">60</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                    <select name="genotype" class="selectpicker form-control">
                                                        <option value="">Select genotype</option>
                                                        @foreach($genotypes as $genotype)
                                                        <option value="{{ $genotype->genotype }}">{{ $genotype->genotype }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                    <select name="marital_status" class="selectpicker form-control">
                                                        <option value="">Marital status</option>
                                                        @if(count($marital_status))
                                                            @foreach($marital_status as $marital_stat)
                                                            <option value="{{ $marital_stat->marital_status }}">{{ $marital_stat->marital_status }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                        <select name="membership_level" class="selectpicker form-control">
                                                            <option value="basic">Basic membership</option>
                                                            <option value="premium">Premium membership</option>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                        <input type="text" name="name" class="form-control" value="" placeholder="Name">
                                                    </div>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                        <select name="religion" class="selectpicker form-control">
                                                            <option value="">Select religion</option>
                                                            <option value="christian">Christian</option>
                                                            <option value="muslim">Muslim</option>
                                                            <option value="other">Other</option>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" name="location" class="form-control" value="" placeholder="State">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                    <input type="text" name="country" class="form-control" value="" placeholder="Country">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group flex">
                                            <button type="submit" class="btn-fill btn-block">Find a match</button>
                                            @csrf
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            @if(settings() && settings()->home_page)
                            @php($home_page = json_decode(settings()->home_page, true))
                           <div class="search-bottom-info">
                               <p>
                                    <i class="fa fa-bell"></i>
                                    {!! nl2br($home_page['search_bottom']) !!}
                                </p>
                           </div>
                           @endif
                        </form>
                    </div>
                </div>
            </div><!-- form content end-->
        </div>
    </div>
</section>
<!-- SUBSCRIPTION END-->



























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
                    <form action="{{ url('/login') }}" method="GET">
                        <button type="submit" class="confirm-btn">Subscribe Now</button>
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
                    <p>Upload Government issued or valid ID card, 10MB max</p>
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
// ********** SUBSCRIBE TO PLAN MODAL************//
$(".manual-payment-btn").click(function(e){
    e.preventDefault()

    $("#form_submit_btn").html("Subscribe Now")
    $("#sub_confirm_container").show()
})








// ******* ID CARD MODAL POPUP OPEN ********* //
var sub_id
var parent
$(".manual-payment-modal-open").click(function(e){
    e.preventDefault()
    
    parent = $(this).parent()
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
                $(parent).html('<a href="{{ url("/manual-payment") }}" class="btn-fill">Subscribe Now</a>')
                bottom_alert_success('ID card uploaded successfully, you may continue to payment page!')
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








// *********** START AUDIO RECORD BUTTON *********//
// $("#start_record_audio_btn").click(function(e){
//     e.preventDefault()
//     start_recording(true)
// })



// // *********** STOP AUDIO RECORD BUTTON *********//
// $("#stop_record_audio_btn").click(function(e){
//     e.preventDefault()
//    start_recording(false)
// })

 


// function start_recording(state){
   
//     navigator.mediaDevices.getUserMedia({ audio: true }).then(stream => {
//         const mediaRecorder = new MediaRecorder(stream);
//         mediaRecorder.start();

//         const audioChunks = [];

//         mediaRecorder.addEventListener("dataavailable", event => {
//         audioChunks.push(event.data);
//         });

//          mediaRecorder.addEventListener("stop", () => {
//             const audioBlob = new Blob(audioChunks);
//             const audioUrl = URL.createObjectURL(audioBlob);
//             const audio = new Audio(audioUrl);
//             audio.play();
//         });


//         setTimeout(() => {
//         mediaRecorder.stop();
//         }, 3000);
//   });

       
// }







// end
})
</script>