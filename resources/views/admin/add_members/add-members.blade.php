
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
                                <li class="breadcrumb-item"><a href="javascript: void()">Members</a></li>
                                <li class="breadcrumb-item active" aria-current="page">New members</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Add members</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="header-title mt-0 mb-1">Buttons example</h4> -->
                               <div class="table-top">
                                    <div class="page-icon"><i class="fa fa-users"></i></div>
                               </div>
                               <div class="form-validation">
                                    @if(Session::has('error'))
                                    <div class="main-alert-danger text-center mb-3">{{ Session::get('error')}}</div>
                                    @endif
                                    @if(Session::has('success'))
                                    <div class="main-alert-success text-center mb-3">{{ Session::get('success')}}</div>
                                    @endif
                                   <form action="{{ url('/admin/add-member') }}" method="POST" class="parsley-examples">
                                        <div class="form-group">
                                            <label for="userName">User Name<span class="text-danger">*</span></label>
                                            <input type="text" name="user_name" parsley-trigger="change" placeholder="Enter user name" class="form-control" value="{{ old('user_name') }}">
                                            @if($errors->first('user_name'))
                                            <div class="alert-form text-danger">{{ $errors->first('user_name') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">Email address<span class="text-danger">*</span></label>
                                            <input type="email" name="email" parsley-trigger="change" placeholder="Enter email" class="form-control" value="{{ old('email') }}">
                                            @if($errors->first('email'))
                                            <div class="alert-form text-danger">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-16">
                                                    <div class="checkbox checkbox-success">
                                                        <input id="male_type_checker" type="checkbox" class="gender_checkbox_input" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                                                        <label for="male_type_checker">
                                                            Male
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-16">
                                                    <div class="checkbox checkbox-success">
                                                        <input id="fenale_type_checker" type="checkbox" class="gender_checkbox_input" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                                        <label for="fenale_type_checker">
                                                            Female
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($errors->first('gender'))
                                            <div class="alert-form text-danger">{{ $errors->first('gender') }}</div>
                                            @endif
                                        </div>
                                        <br>
                                        <div class="form-group text-right mb-3">
                                            <div class="form-group">
                                                <input type="hidden" name="gender" class="member_gender_input" value="{{ old('gender') }}">
                                                <button type="submit" id="add_member_submit" class="btn-fill-block">Add Member</button>
                                            </div>
                                            @csrf
                                        </div>
                                    </form>
                               </div>
                            </div>
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->
            </div>
        </div>
    </div>
</section>
<!-- BASIC MEMBERS END-->

















<script>
$(document).ready(function(){
// *********** LOGIN BUTTON *********//
$("#add_member_submit").click(function(e){
    $(this).html('Please wait...')
})




// ********** GENDER INPUT ************//
var gender = $(".gender_checkbox_input");
$.each($(".gender_checkbox_input"), function(index, current){
    $(this).click(function(){
        for(var i = 0; i < gender.length; i++){
            if(index != i)
            {
               $($(gender)[i]).prop('checked', false);
            }else{
                $($(gender)[i]).prop('checked', true);
            }
        }
    });
});


$(gender).click(function(){
    $(".member_gender_input").val($(this).val());
});
})
</script>