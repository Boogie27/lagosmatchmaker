
<div class="banner-preview-container">
    <div class="banner-preview" id="banner_preview_image">
        <img src="{{ asset($user->banner) }}" alt="">
    </div>
</div>
<div class="banner-body">
    <ul>
        @if(count($banners))
            @foreach($banners as $banner)
            <li>
                <a href="#" id="{{ $banner->id }}" class="banner-img"><img src="{{ asset($banner->banner) }}" alt=""></a>
            </li>
            @endforeach
        @endif
    </ul>
</div>