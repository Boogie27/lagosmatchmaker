







<!-- MEMBER SEARCH FORM START-->
<section class="modal-alert-popup modal-form-section" id="member_search_form_modal">
    <div class="edit-info-main">
        <div class="edit-info-dark-theme dark-theme-modal-popup">
            <div class="edit-info-container">
                <div class="btn-close-container">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="title-header">
                    <h4>Search members</h4>
                    <p>Search through our existing basic members</p>
                </div>
                <div class="form-input-popup">
                    <form action="{{ url('/basic') }}" method="GET">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <select name="i_am" class="selectpicker form-control">
                                        <option value="">I am</option>
                                        <option value="male">Man</option>
                                        <option value="female">Woman</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <select name="looking_for" class="selectpicker form-control">
                                        <option value="">Looking for</option>
                                        <option value="female">Woman</option>
                                        <option value="male">Man</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4">
                                <div class="form-group">
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
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4">
                                <div class="form-group">
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
                            <div class="col-xl-4 col-lg-4 col-md-4">
                                <div class="form-group">
                                    <select name="genotype" class="selectpicker form-control">
                                        <option value="">Select genotype</option>
                                        @if(count($genotypes))
                                            @foreach($genotypes as $genotype)
                                            <option value="{{ $genotype->genotype }}">{{ $genotype->genotype }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <select name="religion" class="selectpicker form-control">
                                        <option value="">Select religion</option>
                                        <option value="christain">Christain</option>
                                        <option value="muslim">Muslim</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
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
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <select name="membership_level" class="selectpicker form-control">
                                        <option value="basic">Basic membership</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" value="" placeholder="Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
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
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <button type="submit" class="btn-fill-block"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </div>
                     </form>
                </div>
            <div>
        <div>
    <div>
</section>
<!-- MEMBER SEARCH FORM END-->


