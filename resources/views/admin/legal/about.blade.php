
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
                                <li class="breadcrumb-item"><a href="javascript: void()">Legal</a></li>
                                <li class="breadcrumb-item active" aria-current="page">About us</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">About us</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                               <div class="">
                                    @if(Session::has('error'))
                                    <div class="main-alert-danger text-center mb-3">{{ Session::get('error')}}</div>
                                    @endif
                                    @if(Session::has('success'))
                                    <div class="main-alert-success text-center mb-3">{{ Session::get('success')}}</div>
                                    @endif
                                    <form action="{{ url('/admin/about-us') }}" method="POST" class="parsley-examples">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                    <label for="userName">Header<span class="text-danger">*</span></label>
                                                    <input type="text" name="title" parsley-trigger="change" placeholder="Enter title" class="form-control" value="{{ $about_us->about_us_title ?? old('title') }}">
                                                    <div class="alert-form text-danger">@if($errors->first('title')) {{ $errors->first('title') }} @endif</div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                    <label for="emailAddress">About us<span class="text-danger">*</span></label>
                                                    <div id="summernote-editor">
                                                        {!! $about_us->about_us !!} 
                                                    </div> <!-- end summernote-editor-->
                                                    <textarea name="about_us" id="about_us_condition_input" style="display: none;"></textarea>
                                                    <div class="alert-form text-danger">@if($errors->first('about_us')) {{ $errors->first('about_us') }} @endif</div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="form-group text-right mb-3">
                                                    <div class="form-group">
                                                        <button type="submit" id="admin_update_submit" class="btn-fill-block">Submit</button>
                                                    </div>
                                                    @csrf
                                                </div>
                                            </div>
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
// *********** UPDATE BUTTON *********//
$("#admin_update_submit").click(function(e){
    $(this).html('Please wait...')
    var inner_content = $(".note-editable").html()
    $("#about_us_condition_input").val(inner_content)
})


// end of ready function
})
</script>












