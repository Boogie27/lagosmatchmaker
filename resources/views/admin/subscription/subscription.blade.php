




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
                                <li class="breadcrumb-item active" aria-current="page">Subscriptions</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Subscriptions</h4>
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
                                                <th>Type</th>
                                                <th>Amount</th>
                                                <th>Duration</th>
                                                <th>Description</th>
                                                <th>Featured</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="parent_table">
                                            @if(count($subscriptions))
                                            @foreach($subscriptions as $subscription)
                                            <tr>
                                                <td>
                                                    {{ ucfirst($subscription->type) }}
                                                </td>
                                                <td>
                                                    @money($subscription->amount)
                                                </td>
                                                <td>
                                                    {{ $subscription->duration }}
                                                </td>
                                                <td>
                                                    {{ $subscription->description }}</td>
                                                <td>
                                                    <div class="check-box {{ $subscription->sub_is_featured ? 'active' : ''}}">
                                                        <a href="#" data-name="{{ $subscription->type }}" id="{{ $subscription->sub_id  }}" class="feature-confirm-box-open"></a>
                                                    </div>
                                                </td>
                                                <td>{{ date('d M Y', strtotime($subscription->sub_date_added)) }}</td>
                                                <td>
                                                    <div class="drop-down">
                                                        <i class="fa fa-ellipsis-h drop-down-open"></i>
                                                        <ul class="drop-down-body">
                                                            <li>
                                                                <a href="{{ url('/admin/edit-subscription/'.$subscription->sub_id) }}">Edit</a>
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
                                    @if(!count($subscriptions))
                                    <div class="text-center">There are no subscriptions yet!</div>
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
<section class="modal-alert-popup" id="feature_modal_popup_box">
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
                        <input type="hidden" id="feature_id_input">
                        <button type="button"  id="feature_confirm_submit_btn" class="confirm-btn">Proceed</button>
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









// ************ OPEN FEATURE CONFIMR BOX *********//
var featured = null;
var content = null
$(".feature-confirm-box-open").click(function(e){
    e.preventDefault()
    featured = $(this).parent()
    content = $(this).attr('data-name')
    var id =  $(this).attr('id')
    
    $("#feature_id_input").val(id)
    $("#feature_confirm_submit_btn").html('Proceed')
    $("#feature_modal_popup_box").show()
    if($(featured).hasClass('active')){
        apend_message("<p>Do you wish to unfeature <br><b>"+content+"</b></p>")  
    }else{
        apend_message("<p>Do you wish to feature <br><b>"+content+"</b></p>") 
    }
})





// *********** TOGGLE FEATURED GENOTYPE ************//
$("#feature_confirm_submit_btn").click(function(e){
    e.preventDefault()
    var id = $("#feature_id_input").val()
    $("#feature_confirm_submit_btn").html('Please wait...')
    
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-feature-subscription') }}",
        method: "post",
        data: {
            id: id,
        },
        success: function (response){
            if(response.featured){
                $(featured).addClass('active')
                bottom_alert_success(content+' has been featured!')
            }else if(response.unfeatured){
                $(featured).removeClass('active')
                bottom_alert_success(content+' has been unfeatured!')
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






// ********** CONFIRM MODAL MESSAGE***********//
function apend_message(message){
    $("#delete_modal_popup_box").find('.confirm-header').html(message)
    $("#feature_modal_popup_box").find('.confirm-header').html(message)
}




// end of ready funciton
})

</script>
































