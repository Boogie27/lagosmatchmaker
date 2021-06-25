

<!-- LOGIN START-->
<section class="login-form-section">
    <div class="form-container">
        <form action="{{ url('/register') }}" method="POST">
            @if(Session::has('error'))
            <div class="main-alert-danger text-center mb-3">{{ Session::get('error')}}</div>
            @endif
            <div class="title-header text-center">
                <h3>Register</h3>
                <p>Already have an account? <a href="{{ url('/login') }}">Login</a></p>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="form-group">
                        @if($errors->first('user_name'))
                        <div class="alert-form text-danger">{{ $errors->first('user_name') }}</div>
                        @endif
                        <input type="text" name="user_name" class="form-control" value="{{ old('user_name') }}" placeholder="User Name">
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="form-group">
                        @if($errors->first('email'))
                        <div class="alert-form text-danger">{{ $errors->first('email') }}</div>
                        @endif
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="form-group">
                        @if($errors->first('password'))
                        <div class="alert-form text-danger">{{ $errors->first('password') }}</div>
                        @endif
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="Password">
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="form-group">
                        @if($errors->first('confirm_password'))
                        <div class="alert-form text-danger">{{ $errors->first('confirm_password') }}</div>
                        @endif
                        <input type="password" name="confirm_password" class="form-control" value="" placeholder="Confirm Password">
                    </div>
                </div>
                <div class="col-xl-12">
                    @if($errors->first('gender'))
                    <div class="alert-form text-danger">{{ $errors->first('gender') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6-col-sm-6 col-6">
                            <div class="form-group">
                                <input type="checkbox" class="gender_checkbox_input" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}> <span>Male</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6-col-sm-6 col-6">
                            <div class="form-group">
                                <input type="checkbox" class="gender_checkbox_input" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}> <span>Female</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 mt-4">
                    <div class="form-group">
                        <input type="hidden" name="gender" id="member_gender_input" value="{{ old('gender') }}">
                         <button type="submit" id="register_form_submit" class="btn-fill-block">Get Started Now</button>
                    </div>
                    @csrf
                </div>
            </div>
        </form>
    </div>
</section>
<!-- LOGIN END-->





<script>
$(document).ready(function(){
// *********** ASSIGN GENDER FIELD **********//
function get_gender(){
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
        $("#member_gender_input").val($(this).val());
    });
}
get_gender()












// *********** LOGIN BUTTON *********//
$("#register_form_submit").click(function(e){
    $(this).html('Please wait...')
})






// end
})
</script>










