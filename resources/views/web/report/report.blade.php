
<!-- SETTINGS HEADER START-->
<section class="message-section">
    <div class="message-container">
        <div class="title-header">
            <h4>Report Member</h4>
            <p> <a href="{{ url('/') }}">Home</a> - Report</p>
        </div>
    </div>
</section>
<!-- SETTINGS HEADER START-->











<!-- CHANGE PASSWORD START-->
<section class="settings-section">
    <div class="setting-container">
        @if(Session::has('error-username'))
        <div class="main-alert-danger text-center mb-3">{{ Session::get('error-username')}}</div>
        @endif
        @if(Session::has('success-username'))
        <div class="main-alert-success text-center mb-3">{{ Session::get('success-username')}}</div>
        @endif
        <div class="settings-body"><!-- settings start-->
            <div class="title-header">
                <h4>Let us know what is going on</h4>
                <p>We use your feeback to help us learn when something's not right.</p>
            </div>
            <form action="{{ url('/change-password') }}" method="POST">
                <div class="content-body-body">
                    <ul class="ul-report">
                        <li><a href="#" class="report-button active">Harassmen</a></li>
                        <li><a href="#" class="report-button">Suicide or self injury</a></li>
                        <li><a href="#" class="report-button">Pretending to be someone else</a></li>
                        <li><a href="#" class="report-button">Sharing inappropriate things</a></li>
                        <li><a href="#" class="report-button">Hate speech</a></li>
                        <li><a href="#" class="report-button">Unauthrised sales</a></li>
                        <li><a href="#" class="report-button-others">Others</a></li>
                    </ul>
                    <div class="report-form">
                        <h4>Others</h4>
                        <p>Report other issues that was not listed above</p>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <textarea name="report" class="form-control" cols="30" rows="5"></textarea>
                                    <div class="alert-form text-danger">
                                        @if($errors->first('report'))
                                            {{ $errors->first('report') }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="news-letter-btn">Report</button>
                            @csrf
                        </div>
                    </div>
                    <div class="report-bottom">
                        <p>{{ ucfirst(user('user_name')) }} if someone is in immediate danger, call local services, Don't wait.</p>
                    </div>
                </div>
            </form>
        </div><!-- settings end-->
    </div>
</section>

<!-- CHANGE PASSWORD START-->