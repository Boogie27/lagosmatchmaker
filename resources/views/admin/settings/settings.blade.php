


<!-- BASIC MEMBERS START-->
<section>
    <div class="content-page">
        <div class="content">
            <div class="container-fluid"><!-- Start Content-->
                <div class="row page-title">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb" class="float-right mt-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Settings</a></li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">General Settings</h4>
                        @if(Session::has('error'))
                        <div class="main-alert-danger text-center mt-3">{{ Session::get('error')}}</div>
                        @endif
                        @if(Session::has('success'))
                        <div class="main-alert-success text-center mt-3">{{ Session::get('success')}}</div>
                        @endif
                    </div>
                </div>
               
                <!-- PROFILE DETAILS START-->
                <div class="profile-detail-section">
                    
                    <div class="profile-detail-container">
                        <div class="row">
                            <div class="col-xl-12"><!-- profile detail left end-->
                                <div class="row">
                                    <div class="col-xl-6"><!-- report start-->
                                        <div class="profile-detail-left">
                                            <div class="title-header">
                                                <h4>Home banner text</h4> 
                                            </div>
                                            <div class="form-body-settings">
                                                <form action="{{ url('/admin/home-page') }}" method="POST" class="parsley-examples">
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" name="title" parsley-trigger="change" placeholder="Title" class="form-control" value="{{ $home_page['title'] }}">
                                                                <div class="alert-form text-danger">@if($errors->first('title')) {{ $errors->first('title') }} @endif</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" name="link" parsley-trigger="change" placeholder="Link" class="form-control" value="{{ $home_page['link'] }}">
                                                                <div class="alert-form text-danger">@if($errors->first('link')) {{ $errors->first('link') }} @endif</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="form-group">
                                                                <input type="text" name="body" parsley-trigger="change" placeholder="Body" class="form-control" value="{{ $home_page['body'] }}">
                                                                <div class="alert-form text-danger">@if($errors->first('body')) {{ $errors->first('body') }} @endif</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-right mb-3">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn-mini">Update</button>
                                                        </div>
                                                        @csrf
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- report end-->
                                    <div class="col-xl-6"><!-- report start-->
                                        <div class="profile-detail-left">
                                            <div class="title-header">
                                                <h4>Footer middle</h4> 
                                            </div>
                                            <div class="form-body-settings">
                                                <form action="{{ url('/admin/footer-middle') }}" method="POST" enctype="multipart/form-data" class="parsley-examples">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="form-group">
                                                                <input type="text" name="title" parsley-trigger="change" placeholder="Title" class="form-control" value="{{ $footer_middle['title'] }}">
                                                                <div class="alert-form text-danger">@if($errors->first('title')) {{ $errors->first('title') }} @endif</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="form-group">
                                                                <input type="text" name="body" parsley-trigger="change" placeholder="Body" class="form-control" value="{{ $footer_middle['body'] }}">
                                                                <div class="alert-form text-danger">@if($errors->first('body')) {{ $errors->first('body') }} @endif</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-right mb-3">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn-mini">Update</button>
                                                        </div>
                                                        @csrf
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- report end-->
                                    
                                    <div class="col-xl-6"><!-- report start-->
                                        <div class="profile-detail-left">
                                            <div class="title-header">
                                                <h4>Footer left</h4> 
                                            </div>
                                            <div class="form-body-settings">
                                                <form action="{{ url('/admin/footer-left') }}" method="POST" enctype="multipart/form-data" class="parsley-examples">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="form-group">
                                                                <input type="text" name="title" parsley-trigger="change" placeholder="Title" class="form-control" value="{{ $footer_left['title'] }}">
                                                                <div class="alert-form text-danger">@if($errors->first('title')) {{ $errors->first('title') }} @endif</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="form-group">
                                                                <input type="text" name="body" parsley-trigger="change" placeholder="Body" class="form-control" value="{{ $footer_left['body'] }}">
                                                                <div class="alert-form text-danger">@if($errors->first('body')) {{ $errors->first('body') }} @endif</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                                            <div class="form-group">
                                                                <div class="footer-image"> 
                                                                    <img src="{{ asset($footer_left['image']) }}" alt="footer-image">
                                                                </div>
                                                                <div class="alert-form text-danger">@if($errors->first('image')) {{ $errors->first('image') }} @endif</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                                            <div class="form-group">
                                                                <input type="file" name="image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-right mb-3">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn-mini">Update</button>
                                                        </div>
                                                        @csrf
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- report end-->
                                    
                                    <div class="col-xl-6"><!-- report start-->
                                        <div class="profile-detail-left">
                                            <div class="title-header">
                                                <h4>Contact</h4> 
                                            </div>
                                            <div class="form-body-settings">
                                                <form action="{{ url('/admin/app-contact') }}" method="POST" class="parsley-examples">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="form-group">
                                                                <input type="text" name="phone" parsley-trigger="change" placeholder="Phone" class="form-control" value="{{ $settings->phone ?? old('phone')}}">
                                                                <div class="alert-form text-danger">@if($errors->first('phone')) {{ $errors->first('phone') }} @endif</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="form-group">
                                                                <input type="email" name="email" parsley-trigger="change" placeholder="Email" class="form-control" value="{{ $settings->email ?? old('email') }}">
                                                                <div class="alert-form text-danger">@if($errors->first('email')) {{ $errors->first('email') }} @endif</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="form-group">
                                                                <textarea name="address" class="form-control" cols="30" rows="4" placeholder="Address">{{ $settings->address ?? old('address') }}</textarea>
                                                                <div class="alert-form text-danger">@if($errors->first('address')) {{ $errors->first('address') }} @endif</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-right mb-3">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn-mini">Update</button>
                                                        </div>
                                                        @csrf
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- report end-->
                                    <div class="col-xl-6"><!-- report start-->
                                        <div class="profile-detail-left">
                                            <div class="title-header">
                                                <h4>Site detail</h4> 
                                            </div>
                                            <div class="form-body-settings">
                                                <form action="{{ url('/admin/site-detail') }}" method="POST" enctype="multipart/form-data" class="parsley-examples">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="form-group">
                                                                <input type="text" name="site_name" parsley-trigger="change" placeholder="Site name" class="form-control" value="{{ $settings->app_name }}">
                                                                <div class="alert-form text-danger">@if($errors->first('site_name')) {{ $errors->first('site_name') }} @endif</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="form-group">
                                                                <input type="text" name="copy_right" parsley-trigger="change" placeholder="Copyright" class="form-control" value="{{ $settings->copyright }}">
                                                                <div class="alert-form text-danger">@if($errors->first('copy_right')) {{ $errors->first('copy_right') }} @endif</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                                            <div class="form-group">
                                                                <div class="app-image-logo"> 
                                                                    <img src="{{ asset($settings->logo) }}" alt="logo">
                                                                </div>
                                                                <div class="alert-form text-danger">@if($errors->first('logo')) {{ $errors->first('logo') }} @endif</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                                            <div class="form-group">
                                                                <label for="">App logo</label>
                                                                <input type="file" name="logo">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-right mb-3">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn-mini">Update</button>
                                                        </div>
                                                        @csrf
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- report end-->
                                    <div class="col-xl-6"><!-- report start-->
                                        <div class="profile-detail-left">
                                            <div class="title-header">
                                                <h4>Profile alert</h4> 
                                            </div>
                                            <div class="form-body-settings">
                                                <form action="{{ url('/admin/profile-alert-message') }}" method="POST" enctype="multipart/form-data" class="parsley-examples">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="form-group">
                                                                <label for="">Complete profile alert</label>
                                                                <textarea name="complete_profile_alert" class="form-control" cols="30" rows="3" placeholder="Write Complete profile alert message...">{{ $settings->complete_profile_alert ?? old('complete_profile_alert')}}</textarea>
                                                                <div class="alert-form text-danger">@if($errors->first('complete_profile_alert')) {{ $errors->first('complete_profile_alert') }} @endif</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="form-group">
                                                                <label for="">Incomplete profile alert</label>
                                                                <textarea name="profile_alert" class="form-control" cols="30" rows="3" placeholder="Write Incomplete profile alert message...">{{ $settings->profile_alert ?? old('profile_alert')}}</textarea>
                                                                <div class="alert-form text-danger">@if($errors->first('profile_alert')) {{ $errors->first('profile_alert') }} @endif</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-right mb-3">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn-mini">Update</button>
                                                        </div>
                                                        @csrf
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- report end-->
                                    
                                    <div class="col-xl-12"><!-- report start-->
                                        <!-- <div class="profile-detail-left">
                                            <div class="title-header"><h4>Report</h4></div>
                                            <ul class="ul-profile-detail">
                                                <li>
                                                    <p class="detail-about-p">helloooo o hoeu</p>
                                                </li>
                                            </ul>
                                        </div> -->
                                    </div><!-- report end-->
                                </div>
                            </div> <!-- profile detail left end-->
                        </div>
                    </div>
                </div>
                <!-- PROFILE DETAILS END-->
            </div><!-- end Content-->
        </div>
    </div>
</section>







































