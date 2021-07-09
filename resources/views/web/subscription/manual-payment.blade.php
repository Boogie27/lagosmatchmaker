


<!-- MESSAGES HEADER START-->
<section class="message-section header-container">
    <div class="message-container">
        <div class="title-header">
            <h4>Manual Payment Option</h4>
            <p> <a href="{{ url('/') }}">Home</a> - Manual payment</p>
        </div>
    </div>
</section>
<!-- MESSAGES HEADER START-->







<!-- MANUAL SUBSCRIPTION START-->
<section class="sub-bottom-section">
    <div class="title-header text-center">
        <!-- <h4>Manual payment</h4> -->
        <p>Make payment manually through bank transfer</p>
    </div>
    <div class="manual-sub-body">
        @if($images)
        <div class="bank-icons">
            @foreach($images as $image)
            <img src="{{ asset($image) }}" alt="">
            @endforeach
        </div>
        @endif
        @if($descriptions)
        <ul class="ul-manual-sub-body">
            @php($x = 1)
            @foreach($descriptions as $description)
                <li><span>{{ $x}}.</span> <p>{{ $description }}</p></li>
                @php($x++)
            @endforeach
        </ul>
        @endif
    </div>
</section>
<!-- MANUAL SUBSCRIPTION END-->