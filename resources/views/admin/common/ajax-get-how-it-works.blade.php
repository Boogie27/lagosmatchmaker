<div class="row">                                           
    @if(count($how_it_works))
    @foreach($how_it_works as $how_it_work)
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12"> <!-- slider banner start-->
        <ul class="ul-slide-banner">
            <li class="child-slide-img"><img src="{{ asset($how_it_work->image) }}" alt=""></li>
            <li class="banner-slider-icon">
                <a href="#" id="{{ $how_it_work->id }}" class="slider-edit-icon update_banner_icon"><i class="fa fa-camera"></i></a>
                <a href="#" id="{{ $how_it_work->id }}" class="slider-delete-icon delete_banner_icon"><i class="fa fa-trash"></i></a>
            </li>
            <li>
                <div class="checkbox checkbox-success pt-2">
                    <input id="feature_checker_{{ $how_it_work->id }}" data-id="{{ $how_it_work->id }}" type="checkbox" class="feature_slider_checkbox_input"  {{ $how_it_work->is_featured ? 'checked' : '' }}>
                    <label for="feature_checker_{{ $how_it_work->id }}">Feature</label>
                </div>
            </li>
        </ul>
    </div><!-- slider banner end-->
    @endforeach
    @endif
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12"> <!-- slider banner start-->
        <ul class="ul-slide-banner">
            <li class="text-center">
                <input type="file" id="slider_banner_input" style="display: none;">
                <input type="file" id="update_slider_banner_input" style="display: none;">
                <a href="#" id="slider_banner_btn_open" class="upload-slider-icon"><i class="fa fa-camera"></i></a>
                <div>Max: 1MB</div>
                <div class="alert-form image_alert_0 text-danger"></div>
            </li>
        </ul>
    </div><!-- slider banner end-->
</div>