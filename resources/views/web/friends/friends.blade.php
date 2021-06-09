<!-- MESSAGES HEADER START-->
<section class="message-section">
    <div class="message-container">
        <div class="title-header">
            <h4>Your friends</h4>
            <p> <a href="{{ url('/') }}">Home</a> - friends</p>
        </div>
        <div class="message-form">
            <form action="" method="GET">
                <input type="text" class="form-control" placeholder="Search friends">
                <button><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
</section>
<!-- MESSAGES HEADER START-->








<!-- MESSAGE SECTION START-->
<section class="message-section-chart">
    <div class="profile-detail-container">
        @if(count($friends))
        <div class="row">
            <div class="col-xl-12"><!-- profile detail left end-->
                @foreach($friends as $friend)
                @php($display_name = $friend->display_name ? ucfirst($friend->display_name) : ucfirst($friend->user_name))
                @php($image =  avatar($friend->display_image, $friend->gender))
                <div class="firends-main-body"><!-- firend start-->
                    <div class="friends-inner-content">
                        <div class="message-img">
                            <i class="fa fa-circle {{ $friend->is_active ? 'active' : '' }}"></i>   
                            <a href="{{ url('/profile/'.$friend->id) }}"><img src="{{ asset($image) }}" alt="{{ $display_name }}"></a>
                        </div>
                        <ul class="ul-friends">
                            <li>
                                <a href="{{ url('/profile/'.$friend->id) }}"><h5>{{ $display_name }}</h5></a>
                            </li>
                           <li class="friends-bottom">
                               <a href="{{ url('/chat/'.$friend->id) }}" class="f-send-msg">Send message</a>
                               <label for="">matched</label>
                           </li>
                        </ul>
                    </div>
                    </div><!-- firend end-->
                @endforeach
            </div><!-- profile detail left end-->
        </div>
        @else
        <div class="empty-page">
            <p>There are no members yet!</p>
        </div>
        @endif
    </div>
</section>
<!-- MESSAGE SECTION END-->

















