




<!-- <div class="home-empty-content"></div> -->









<!-- SUBSCRIPTION START-->
<section class="subscription-section">
<br><br><br><br>
    <div class="subscritpion-alert">
    @if(Session::has('error'))
        <div class="main-alert-danger text-center mb-3">{{ Session::get('error')}}</div>
    @endif
    @if(Session::has('success'))
        <div class="main-alert-success text-center mb-3">{{ Session::get('success')}}</div>
    @endif
    </div>
    <div class="subscription-content">
        <div class="row">
        @if(count($subscriptions))
            @foreach($subscriptions as $subscription)
            <div class="col-xl-4 col-lg-4 col-md-6"><!-- subscription start-->
                <div class="subscription-banner">
                    <img src="{{ asset('web/images/banner/sub-2.svg') }}" alt="">
                    <ul class="ul-sub-head">
                        <li><p>{{ ucfirst($subscription->type) }}</p></li>
                        @if($subscription->amount == 0)
                        <li><h3>Free</h3></li>
                        <li><p>Membership currently free</p></li>
                        @else
                        <li><h3><span>₦</span>{{ money($subscription->amount) }}</h3></li>
                        <li><p>Per Month</p></li>
                        @endif
                    </ul>
                    <ul class="ul-sub-body">
                        @if($subscription->description)
                        <li>
                            <p>{{ $subscription->description }}</p>
                        </li>
                        @endif
                        @if($subscription->type == 'basic' && $subscription->amount == 0)
                        <li style="color: #fff;">.</li>
                        @else
                        <li><a href="#" id="{{ $subscription->sub_id }}" class="subscrition-btn-open">Subscribe Now</a></li>
                        @endif
                    </ul>
                </div>
            </div><!-- subscription start-->
            @endforeach
        @endif
        
        @if($personalized && $personalized['is_feature'])
            <div class="col-xl-4 col-lg-4 col-md-6"><!-- subscription start-->
                <div class="subscription-banner">
                    <img src="{{ asset('web/images/banner/sub-2.svg') }}" alt="">
                    <ul class="ul-sub-head">
                        <li><p>{{ $personalized['title'] }}</p></li>
                        <li><h3><i class="fa fa-phone-alt"></i></h3></li>
                        <li><p>{{ $personalized['head'] }}</p></li>
                    </ul>
                    <ul class="ul-sub-body ul">
                        <li><p>{!!  $personalized['descriptions'] !!}</p></li>
                        <li><a href="#" class="whatsapp-subscrition-bn">Contact Us Now</a></li>
                    </ul>
                </div>
            </div><!-- subscription start-->
        @endif
        </div>
    </div>
</section>
<!-- SUBSCRIPTION END-->











<!-- MANUAL SUBSCRIPTION START-->
<section class="sub-bottom-section">
    <div class="title-header text-center">
        <h4>Manual payment</h4>
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








<div class="search-bar-container">
    <div class="inner-search-form">
        <form action="{{ url('/search') }}" method="GET">
            <div class="slider-form-header">
               @if(settings() && settings()->home_page)
               @php($home_page = json_decode(settings()->home_page, true))
                <h4>{{ strtoupper($home_page['title']) }}</h4>
                <p>{{ $home_page['body'] }}</p>
               @endif
            </div>
           <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group flex">
                        <label for="">I am: </label>
                        <select name="i_am" class="selectpicker form-control">
                            <option value="male">Man</option>
                            <option value="female">Woman</option>
                        </select>
                    </div>
                </div> 
                <div class="col-lg-12">
                    <div class="form-group flex">
                        <label for="">Looking for: </label>
                        <select name="looking_for" class="selectpicker form-control">
                            <option value="female">Woman</option>
                            <option value="male">Man</option>
                        </select>
                    </div>
                </div> 
                <div class="col-lg-12">
                    <div class="form-group flex">
                        <label for="">Age: </label>
                        <div class="form-items">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                    <select name="from_age" class="selectpicker form-control">
                                        <option value="">From</option>
                                        <option value="18">18</option>
                                        <option value="20">20</option>
                                        <option value="25">25</option>
                                        <option value="30">30</option>
                                        <option value="35">35</option>
                                        <option value="40">40</option>
                                        <option value="45">45</option>
                                        <option value="50">50</option>
                                        <option value="55">55</option>
                                        <option value="60">60</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                    <select name="to_age" class="selectpicker form-control">
                                        <option value="">To</option>
                                        <option value="18">18</option>
                                        <option value="20">20</option>
                                        <option value="25">25</option>
                                        <option value="30">30</option>
                                        <option value="35">35</option>
                                        <option value="40">40</option>
                                        <option value="45">45</option>
                                        <option value="50">50</option>
                                        <option value="55">55</option>
                                        <option value="60">60</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-12">
                   <div class="row">
                       <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                           <div class="form-group">
                                <select name="genotype" class="selectpicker form-control">
                                    <option value="">Select genotype</option>
                                    @foreach($genotypes as $genotype)
                                    <option value="{{ $genotype->genotype }}">{{ $genotype->genotype }}</option>
                                    @endforeach
                                </select>
                            </div>
                       </div>
                       <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                           <div class="form-group">
                                <select name="marital_status" class="selectpicker form-control">
                                    <option value="">Marital status</option>
                                    @if(count($marital_status))
                                        @foreach($marital_status as $marital_stat)
                                        <option value="{{ $marital_stat->marital_status }}">{{ $marital_stat->marital_status }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                       </div>
                   </div>
                </div>
                <div class="col-lg-12">
                   <div class="row">
                       <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                           <div class="form-group">
                                <select name="membership_level" class="selectpicker form-control">
                                    <option value="basic">Basic membership</option>
                                    <option value="premium">Premium membership</option>
                                </select>
                            </div>
                       </div>
                       <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                           <div class="form-group">
                                <input type="text" name="name" class="form-control" value="" placeholder="Name">
                            </div>
                       </div>
                   </div>
                </div>  
                <div class="col-lg-12">
                   <div class="row">
                       <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                           <div class="form-group">
                                <select name="religion" class="selectpicker form-control">
                                    <option value="">Select religion</option>
                                    <option value="christain">Christain</option>
                                    <option value="muslim">Muslim</option>
                                </select>
                            </div>
                       </div>
                       <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                           <div class="form-group">
                                <select name="location" class="selectpicker form-control">
                                    <option value="">Select location</option>
                                    @if(count($states))
                                        @foreach($states as $state)
                                        <option value="{{ strtolower($state->state) }}">{{ $state->state }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                       </div>
                   </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group flex">
                        <button type="submit" class="btn-fill btn-block">Find a match</button>
                        @csrf
                    </div>
                </div> 
            </div>
           </div>
        </form>
    </div>
</div>