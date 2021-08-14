


<!-- CONTACT HEADER START-->
<section class="message-section">
    <div class="message-container">
        <div class="title-header">
            <h4>Contact us</h4>
            <p> <a href="{{ url('/') }}">Home</a> - Contact us</p>
        </div>
    </div>
</section>
<!-- CONTACT HEADER START-->





<!-- CONTACT US START-->
<section class="news-letter-section">
    <div class="unsubcribe-newsletter">
        @if(Session::has('error'))
        <div class="main-alert-danger text-center mb-3">{{ Session::get('error')}}</div>
        @endif
        @if(Session::has('success'))
        <div class="main-alert-success text-center mb-3">{{ Session::get('success')}}</div>
        @endif
        <form action="{{ url('/contact') }}" method="POST">
            <div class="row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <input type="text" name="full_name" class="form-control" placeholder="Enter Full name">
                        @if($errors->first('full_name'))
                        <div class="alert-form text-danger">{{ $errors->first('full_name') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Enter email">
                        @if($errors->first('email'))
                        <div class="alert-form text-danger">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="form-group">
                        <textarea name="comment" class="form-control" cols="30" rows="5"></textarea>
                        @if($errors->first('comment'))
                        <div class="alert-form text-danger">{{ $errors->first('comment') }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" id="contact_submit_btn" class="news-letter-btn"><i class="far fa-envelope"></i> Contact us</button>
                @csrf
            </div>
        </form>
    </div>
</section>

<!-- CONTACT US START-->












