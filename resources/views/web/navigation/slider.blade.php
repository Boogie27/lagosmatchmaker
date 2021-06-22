<div class="slider-container" data-duration="15000">
    @if(count($banners))
       @foreach($banners as $banner)
       <div class="slider-content" style="background-image: url({{ asset($banner->banner) }})"></div>
       @endforeach
    @else
    <div class="slider-content" style="background-image: url({{ asset('web/images/banner/demo.jpg') }})"></div>
    @endif
</div>


<div class="slider-main-header">
    <div class="inner-title">
        @if(settings() && settings()->home_page)
        @php($home_page = json_decode(settings()->home_page, true))
        <h3>{{ strtoupper($home_page['title']) }}</h3>
        <p>{{ $home_page['body'] }}</p>
        <a href="{{ url($home_page['link']) }}" class="slider-inner-title">Get Started</a>
        @endif
    </div>
</div>



<div class="slider-form-container"> <!--slider form start -->
    <div class="inner-slider-form">
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
                        <button type="submit" class="btn-fill btn-block">Find you partner</button>
                        @csrf
                    </div>
                </div> 
            </div>
           </div>
        </form>
    </div>
</div><!--slider form end -->