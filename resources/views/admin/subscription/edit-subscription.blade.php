
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
                                <li class="breadcrumb-item"><a href="{{ url('/admin/subscription') }}">Subscription</a></li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Edit {{ ucfirst($subscription->type) }}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                               <div class="form-validation">
                                    @if(Session::has('error'))
                                    <div class="main-alert-danger text-center mb-3">{{ Session::get('error')}}</div>
                                    @endif
                                    @if(Session::has('success'))
                                    <div class="main-alert-success text-center mb-3">{{ Session::get('success')}}</div>
                                    @endif
                                   <form action="{{ url('/admin/edit-subscription/'.$subscription->sub_id) }}" method="POST" class="parsley-examples">
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <div class="form-group">
                                                    <label for="userName">Amount<span class="text-danger">*</span></label>
                                                    <input type="text" name="amount" parsley-trigger="change" placeholder="Enter Amount" class="form-control" value="{{ $subscription->amount ?? old('amount') }}">
                                                    @if($errors->first('amount'))
                                                    <div class="alert-form text-danger">{{ $errors->first('amount') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-xl-8">
                                                <div class="form-group">
                                                    <label for="userName">Amount in words</label>
                                                    <input type="text" name="amount_in_words" parsley-trigger="change" placeholder="Enter Amount in words" class="form-control" value="{{ $subscription->amount_in_words ?? old('amount_in_words') }}">
                                                    @if($errors->first('amount_in_words'))
                                                    <div class="alert-form text-danger">{{ $errors->first('amount_in_words') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="emailAddress">Duration<span class="text-danger">*</span></label>
                                                    <select name="duration"  class="selectpicker form-control">
                                                        <option value="">Select duration</option>
                                                        @if(count($durations))
                                                            @foreach($durations as $duration)
                                                            <option value="{{ $duration->duration }}" {{  $duration->duration == $subscription->duration ? 'selected' : '' }}>{{ $duration->duration }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @if($errors->first('duration'))
                                                    <div class="alert-form text-danger">{{ $errors->first('duration') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="daily-request">Daily Request<span class="text-danger">*</span></label>
                                                    <input type="number" min="0" name="daily_request" class="form-control" value="{{ $subscription->daily_request ?? old('daily_request') }}">
                                                    @if($errors->first('daily_request'))
                                                    <div class="alert-form text-danger">{{ $errors->first('daily_request') }}</div>
                                                    @endif
                                                </div> 
                                            </div>
                                            <div class="col-xl-12">
                                                <!-- <div class="form-group">
                                                    <label for="description">Description<span class="text-danger">*</span></label>
                                                    <textarea name="description"  class="form-control" cols="30" rows="5" placeholder="Write something..">{{ $subscription->description}}</textarea>
                                                    @if($errors->first('description'))
                                                    <div class="alert-form text-danger">{{ $errors->first('description') }}</div>
                                                    @endif
                                                </div> -->
                                                <div class="form-group">
                                                    <label for="emailAddress">Description<span class="text-danger">*</span></label>
                                                    <div class="summernote-editor">
                                                        {!! $subscription->description ?? old('description') !!} 
                                                    </div> <!-- end summernote-editor-->
                                                    <textarea name="description" id="subscription_input" style="display: none;"></textarea>
                                                    <div class="alert-form text-danger">@if($errors->first('description')) {{ $errors->first('description') }} @endif</div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-16">
                                                            <div class="checkbox checkbox-success">
                                                                <input id="feature_type_checker" type="checkbox" class="featured_checkbox_input" {{  $subscription->sub_is_featured ? 'checked' : '' }}>
                                                                <label for="feature_type_checker">
                                                                    Feature
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group text-right mb-3">
                                            <div class="form-group">
                                                <input type="hidden" name="featured" class="featured_input" value="{{ $subscription->sub_is_featured ?? old('featured') }}">
                                                <button type="submit" id="edit_subscription_submit" class="btn-fill-block">Update</button>
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

// ************ LOAD INPUT TO SUBSCRIPTION INPUT BAR *******//
$("#edit_subscription_submit").click(function(e){
    $(this).html('Please wait...')
    inner_content = $(this).parent().parent().parent().find('.note-editable').html()
    $("#subscription_input").val(inner_content)
})




// ********** FEATURED INPUT ************//
var featured = $(".featured_checkbox_input");
$(featured).click(function(e){
    $(".featured_input").val('');
    if($(this).prop('checked')){
        $(".featured_input").val('1');
    }
})










// end of ready function
})
</script>