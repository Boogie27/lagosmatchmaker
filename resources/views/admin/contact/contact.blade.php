




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
                                <li class="breadcrumb-item"><a href="javascript: void()">Contact</a></li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Contact Messages</h4>
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
                               <div class="table-responsive" id="contact_parent_container"> <!-- table start-->
                                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="mass_contact_us_check_box_input"></th>
                                                <th>Full name</th>
                                                <th>Email</th>
                                                <th>Seen</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="parent_table">
                                            @if(count($contacts))
                                                @foreach($contacts as $contact)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" id="{{ $contact->id }}" class="check-box-contact-us-input-btn">
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('/admin/contact-detail/'.$contact->id) }}" style="color: #555;">{{ ucfirst($contact->full_name) }}</a>
                                                    </td>
                                                    <td>
                                                       {{ $contact->email }}
                                                    </td>
                                                    <td>
                                                        <div class="suspend {{ !$contact->is_seen ? 'active' : ''}}">
                                                            <a href="#" data-name="{{ $contact->full_name }}" id="{{ $contact->id }}" class="seen-confirm-box-open"></a>
                                                        </div>
                                                    </td>
                                                    <td>{{ date('d M Y', strtotime($contact->date)) }}</td>
                                                    <td>
                                                        <div class="drop-down">
                                                            <i class="fa fa-ellipsis-h drop-down-open"></i>
                                                            <ul class="drop-down-body">
                                                                <li>
                                                                    <a href="mailto:{{ $contact->email }}">Reply</a>
                                                                    <a href="{{ url('/admin/contact-detail/'.$contact->id) }}">View detail</a>
                                                                    <a href="#" data-name="{{ $contact->full_name }}" id="{{ $contact->id }}" class="delete-confirm-box-open">Delete</a>
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
                                    @if(!count($contacts))
                                    <div class="text-center">There are no contact messages yet!</div>
                                    @endif
                                    @if(count($contacts))
                                    <div class="paginate">{{ $contacts->links("pagination::bootstrap-4") }}</div>
                                    @endif
                                </div>
                                @if(count($contacts))
                                <div class="text">
                                    <a href="#" id="open_mass_delete_contact_us_modal_btn">| Delete |</a>
                                    <a href="#" id="open_mass_contact_us_seen_modal_btn">| Mark as seen |</a>
                                </div>
                                @endif
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















<!--  SEEN MODAL ALERT START -->
<section class="modal-alert-popup" id="contact_modal_popup_box">
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
                        <button type="button"  id="contact_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  SEEN MODAL ALERT END -->












<!--  DELETE MODAL ALERT START -->
<section class="modal-alert-popup" id="delete_modal_popup_box">
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
                        <button type="button"  id="delete_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  DELETE MODAL ALERT END -->









<!--  DELETE MODAL ALERT START -->
<section class="modal-alert-popup" id="mass_delete_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to delete?</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button"  id="mass_delete_confirm_submit_btn" class="confirm-btn">Proceed</button>
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
    // ******* EMPTY TABLE MESSAGE **************//
function table_check(){
    var table = $("#parent_table").children()
    if(table.length == 0){
        $("#bottom_table_part").html("<div class='text-center'>There are no contacts messages yet!</div>")
    }
}





// ********* CSRF PAGE TOKEN ***********//
function csrf_token(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf_token']").attr("content")
        }
    });
}










// ************* CHECK/UNCHECK SINGLE MEMBERS ***********//
$("#contact_parent_container").on('click', '.check-box-contact-us-input-btn', function(){
    id = $(this).attr('id')

    if($(this).prop('checked'))
    {
        check_single_member(id, true)
    }else{
        check_single_member(id, false)
    }
    $("#mass_contact_us_check_box_input").prop('checked', false)
})




var stored_id = []
function check_single_member(id, data)
{
    if(stored_id.includes(id))
    {
        for(var i = 0; i < stored_id.length; i++){
            if(data == false && stored_id[i] == id){
                stored_id.splice(i, 1)
            }
        }
    }else{
        stored_id.push(id)
    }
    console.log(stored_id)
}








// *********** CHECK ALL CONTACTS ************//
$("#contact_parent_container").on('click', '#mass_contact_us_check_box_input', function(){
    if($(this).prop('checked'))
    {
        check_all(true)
        $(".check-box-contact-us-input-btn").prop('checked', true)
    }else{
        check_all(false)
        $(".check-box-contact-us-input-btn").prop('checked', false)
    }
})


function check_all(state){
    var checkbox = $(".check-box-contact-us-input-btn");
    $.each(checkbox, function(index, current){
        var id = $(current).attr('id')
        check_single_member(id, state)
    })
}







// ************ OPEN CONTACT CONFIMR BOX *********//
var is_seen = null;
var content = null
var contact_id = null;
$(".seen-confirm-box-open").click(function(e){
    e.preventDefault()
    is_seen = $(this).parent()
    content = $(this).attr('data-name')
    contact_id =  $(this).attr('id')

    if(!$(is_seen).hasClass('active')) return;
    
    $("#contact_confirm_submit_btn").html('Proceed')
    $("#contact_modal_popup_box").show()
    apend_message("<p>Mark <b>"+content+"</b> message as seen?</p>")  
})





// *********** SEEN CONTACT ************//
$("#contact_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $("#contact_confirm_submit_btn").html('Please wait...')
    
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-contact-us-seen') }}",
        method: "post",
        data: {
            contact_id: contact_id,
        },
        success: function (response){
            if(response.data){
                $(is_seen).removeClass('active')
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
    $("#contact_modal_popup_box").find('.confirm-header').html(message)
    $("#delete_modal_popup_box").find('.confirm-header').html(message)
}









// ************ OPEN CONTACT CONFIMR BOX *********//
var content = null
var contact_id = null;
var parent_container = null;
$(".delete-confirm-box-open").click(function(e){
    e.preventDefault()
    content = $(this).attr('data-name')
    contact_id =  $(this).attr('id')
    parent_container = $(this).parent().parent().parent().parent().parent()
    
    $("#delete_confirm_submit_btn").html('Proceed')
    $("#delete_modal_popup_box").show()
    apend_message("<p>Do you wish to delete <b>"+content+"</b> message?</p>")  
})





// *********** DELETE CONTACT ************//
$("#delete_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $("#delete_confirm_submit_btn").html('Please wait...')
    
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-contact-us-delete') }}",
        method: "post",
        data: {
            contact_id: contact_id,
        },
        success: function (response){
            if(response.data){
               $(parent_container).remove()
               table_check()
               bottom_alert_success(content+' message deleted successfully!')
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











// ********* OPEN MASS DELETE CONFIRM MODAL ************//
$("#open_mass_delete_contact_us_modal_btn").click(function(e){
    e.preventDefault()
    if(stored_id.length == 0)
    {
        return bottom_alert_error('No contact was selected!')
    }
    $("#mass_delete_modal_popup_box").show()
    $("#mass_delete_confirm_submit_btn").html('Proceed')
})






// ********* MASS DELETE CONTACTS MESSAGES ************//
$("#mass_delete_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $(this).html('Please wait...')
    
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-mass-contact-us-delete') }}",
        method: "post",
        data: {
            stored_id: stored_id,
        },
        success: function (response){
            if(response.data){
               location.reload()
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












// ************* MASS SEEN CONTACTS **************//
$("#open_mass_contact_us_seen_modal_btn").click(function(e){
    e.preventDefault()
    if(stored_id.length == 0)
    {
        return bottom_alert_error('No contact was selected!')
    }
    
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-mass-contact-us-seen') }}",
        method: "post",
        data: {
            stored_id: stored_id,
        },
        success: function (response){
            if(response.data){
               location.reload()
            }else{
                bottom_alert_error('Network error, try again later!')
            }
        }, 
        error: function(){
            bottom_alert_error('Network error, try again later!')
        }
    });
})






// end of ready funciton
})

</script>
































