


<!-- EDIT DETAIL INFO START-->
<section class="modal-popup-container modal-form-section" id="report_member_section">
    <div class="edit-info-main">
        <div class="edit-info-dark-theme dark-theme-modal-popup">
            <div class="edit-info-container">
                <div class="btn-close-container">
                    <button class="modal-btn-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="title-header">
                    <h4>Report Member</h4>
                    <p>We use your feeback to help us learn when something's not right.</p>
                </div>
                <div class="form-input-popup"><br>
                     <form action="{{ current_url() }}" method="POST">
                        <ul class="ul-report">
                            @if(count($reports))
                            @foreach($reports as $report)
                            <li><a href="#" id="{{ $report->id }}" class="report-button">{{ ucfirst($report->report) }}</a></li>
                            @endforeach
                            @endif
                            <li><a href="#" id="report_button_others">Others</a></li>
                        </ul>
                        <div class="report-form" id="other_report_form">
                            <h4>Others</h4>
                            <p>Report other issues that was not listed above</p>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <textarea id="other_report_input" class="form-control" cols="30" rows="5"></textarea>
                                        <div class="alert-form report_alert_1 text-danger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="report-bottom">
                            <p>{{ ucfirst(user('user_name')) }} if someone is in immediate danger, call local services, Don't wait.</p>
                        </div>
                        <div class="row">
                           <div class="col-xl-12">
                                <div class="form-group">
                                    <input type="hidden" id="report_id_input">
                                    <button type="button" data-url="{{ url('/report-member') }}" id="report_member_submit_btn" class="btn-fill-block">Report member</button>
                                    <div class="form-error-alert report_alert_0 text-danger"></div>
                                </div>
                            </div>
                        </div>
                     </form>
                </div>
            <div>
        <div>
    <div>
</section>
<!-- EDIT DETAIL INFO END-->








<script>
$(document).ready(function(){
// ***********OPEN OTHER FORM *************//
$("#report_button_others").click(function(e){
    e.preventDefault()

    $(this).toggleClass('active')
    $('#other_report_form').slideToggle()
    $("#report_id_input").val('other')
    $('ul.ul-report li a.report-button').removeClass('active')
})



// ********* SELECT REPORT OPTIONS ********//
 $('ul.ul-report li a.report-button').click(function(e){
    e.preventDefault()
    var report_id = $(this).attr('id')
    
    $("#report_id_input").val(report_id)
    $('ul.ul-report li a.report-button').removeClass('active')
    $(this).addClass('active') 
    $("#report_button_others").removeClass('active')
    $('#other_report_form').slideUp()
 })





// ************* REPORT MEMBER ***************//
$("#report_member_submit_btn").click(function(e){
    e.preventDefault()

    report_member()
})


function report_member(){
    $(".report_alert_1").html('')
    $('.report_alert_0').html('')
    var report_id = $("#report_id_input").val()
    var other_report = $("#other_report_input").val()
    $("#report_member_submit_btn").html('Please wait...')




    if(report_id == ''){
        return $('.report_alert_0').html('Select a report option!')
    }
    // if(report_id == 'other')
    // {
    //     if(other_report.length == ''){
    //         $(".report_alert_1").html('*Other report field is required')
    //     }else if(other_report.length > 1000){
    //         $(".report_alert_1").html('*Maximum of 1000 character')
    //     }
    //     $("#report_member_submit_btn").html('Report member')
    //     return
    // }
    

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-report-member') }}",
        method: "post",
        data: {
            user_id: '{{ $user->id }}',
            report_id: report_id,
            other_report: other_report
        },
        success: function (response){
            if(response.error){
                $(".report_alert_1").html(response.error.other_report)
            }else if(response.not_friends){
                init_fields()
                $("#other_report_form").slideUp()
                $(".modal-btn-close").click()
                bottom_error_danger('Unable to report member, You are not matched!')
            }else if(response.data){
                init_fields()
                $("#other_report_form").slideUp()
                $(".modal-btn-close").click()
                bottom_alert_success('Report has been sent!')
            }else{
                $('.report_alert_0').html('Network error, try again later!')
            }
            $("#report_member_submit_btn").html('Report member')
        }, 
        error: function(){
            $('.report_alert_0').html('Network error, try again later!')
            $("#report_member_submit_btn").html('Report member')
        }
    });
}






function init_fields(){
    $(".report_alert_1").html('')
    $('.report_alert_0').html('')
    $("#other_report_input").val('')
    $("#report_button_others").removeClass('active')
    $('ul.ul-report li a.report-button').removeClass('active')
}





// ********* CSRF PAGE TOKEN ***********//
function csrf_token(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf_token']").attr("content")
        }
    });
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




// end
})
</script>