




<!-- BASIC MEMBERS START-->
<section>
    <div class="content-page">
        <div class="content">
            
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row page-title">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb" class="float-right mt-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/admin/user-subscription') }}">Subscriptions</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Subscriptions history</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Subscriptions History</h4>
                        @if(Session::has('error'))
                        <div class="main-alert-danger text-center mt-3">{{ Session::get('error')}}</div>
                        @endif
                        @if(Session::has('success'))
                        <div class="main-alert-success text-center mt-3">{{ Session::get('success')}}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                               <div class="table-responsive"> <!-- table start-->
                                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Amount</th>
                                                <th>Duration</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="parent_table">
                                            @if(count($user_subs))
                                            @foreach($user_subs as $user_sub)
                                            <tr>
                                                <td>
                                                    <div class="genotype-name">
                                                        @if($user_sub->is_expired == 0)
                                                        <i class="fa fa-check text-success"></i>
                                                        @endif
                                                        {{ ucfirst($user_sub->user_name) }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="genotype-name">{{ ucfirst($user_sub->subscription_type) }}</div>
                                                </td>
                                                <td>
                                                    <div class="genotype-name">@money($user_sub->amount)</div>
                                                </td>
                                                <td>
                                                    <div class="genotype-name">{{ $user_sub->duration }}</div>
                                                </td>
                                                <td>{{ date('d M Y', strtotime($user_sub->start_date)) }}</td>
                                                <td>{{ date('d M Y', strtotime($user_sub->end_date)) }}</td>
                                                <td>
                                                    <div class="drop-down">
                                                        <i class="fa fa-ellipsis-h drop-down-open"></i>
                                                        <ul class="drop-down-body">
                                                            <li>
                                                                <a href="{{ url('/admin/member-detail/'.$user_sub->id) }}">User detail</a>
                                                                @if(date('Y-m-d H:i:s') < $user_sub->end_date)
                                                                <a href="#" data-name="{{ $user_sub->user_name }}" id="{{ $user_sub->user_sub_id }}" class="confimr-box-open-btn">End subscription</a>
                                                                @endif
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div><!-- table end-->
                                <div id="bottom_table_part">
                                    @if(!count($user_subs))
                                    <div class="text-center">There are no subscriptions yet!</div>
                                    @endif
                                    @if(count($user_subs))
                                    <div class="paginate">{{ $user_subs->links("pagination::bootstrap-4") }}</div>
                                    @endif
                                </div>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->
            </div>
        </div>
    </div>
</section>
<!-- BASIC MEMBERS END-->















<!--  DELETE MODAL ALERT START -->
<section class="modal-alert-popup" id="confirm_end_sub_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to delete this items <br><b>example</b></p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <input type="hidden" id="end_sub_id_input">
                        <button type="button"  id="sub_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  DELETE MODAL ALERT END -->




















































<script>
$(document).ready(function(){
// ********* CSRF PAGE TOKEN ***********//
function csrf_token(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf_token']").attr("content")
        }
    });
}





// ********** CONFIRM MODAL MESSAGE***********//
function apend_message(message){
    $("#confirm_end_sub_modal_popup_box").find('.confirm-header').html(message)
}




// ************ OPEN SUBSCRIPTION CONFIMR BOX *********//

var content = null
var table_parent = null;
$(".confimr-box-open-btn").click(function(e){
    e.preventDefault()
    featured = $(this).parent()
    content = $(this).attr('data-name')
    var id =  $(this).attr('id')
    table_parent = $(this).parent().parent().parent().parent().parent()


    $("#end_sub_id_input").val(id)
    $("#sub_confirm_submit_btn").html('Proceed')
    $("#confirm_end_sub_modal_popup_box").show()
    apend_message("<p>Do you wish to end <b>"+content+"</b> subscription</p>") 
})





// *********** END SUBSCRIPTION  ************//
$("#sub_confirm_submit_btn").click(function(e){
    e.preventDefault()
    var id = $("#end_sub_id_input").val()
    $("#sub_confirm_submit_btn").html('Please wait...')
    
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-end-subscription') }}",
        method: "post",
        data: {
            id: id,
        },
        success: function (response){
            if(response.expired){
                $(table_parent).remove()
                bottom_alert_success(content+' subscription has been deleted!')
            }else if(response.active){
                $(table_parent).remove()
                bottom_alert_success(content+' subscription has been activated!')
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $(".modal-alert-popup").hide()
        }, 
        error: function(){
            $(".modal-alert-popup").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})










// end of ready funciton
})

</script>
































