
<!-- EDIT DETAIL INFO START-->
<section class="modal-popup-container modal-form-section" id="edit_detail_info_section">
    <div class="edit-info-main">
        <div class="edit-info-dark-theme dark-theme-modal-popup">
            <div class="edit-info-container">
                <div class="btn-close-container">
                    <button class="modal-btn-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="title-header">
                    <h4>Detail Info</h4>
                    <p>Edit your basic detail information</p>
                </div>
                <div class="form-input-popup">
                     <form action="{{ current_url() }}" method="POST">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_0 text-danger"></div>
                                    <input type="text" id="edit_display_name_input" class="form-control" value="{{ $display_name }}" placeholder="Display name">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_1 text-danger"></div>
                                    <select id="edit_im_am_input" class="selectpicker form-control">
                                        <option value="">I am</option>
                                        <option value="male" {{  $gender == 'man' ? 'selected' : '' }}>Man</option>
                                        <option value="female" {{  $gender == 'woman' ? 'selected' : '' }}>Woman</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4">
                                <div class="form-group">
                                    <div class="alert-form alert_2 text-danger"></div>
                                    <select id="edit_looking_for_input" class="selectpicker form-control">
                                        <option value="">Looking For</option>
                                        <option value="man" {{  $user->looking_for == 'man' ? 'selected' : '' }}>Man</option>
                                        <option value="woman" {{  $user->looking_for == 'woman' ? 'selected' : '' }}>Woman</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4">
                                <div class="form-group">
                                    <div class="alert-form alert_3 text-danger"></div>
                                    <select id="edit_marital_status_input" class="selectpicker form-control">
                                        <option value="">Marital Status</option>
                                        @if(count($marital_status))
                                            @foreach($marital_status as $marital_stat)
                                            <option value="{{ $marital_stat->marital_status }}" {{  $marital_stat->marital_status == $user->marital_status ? 'selected' : '' }}>{{ $marital_stat->marital_status }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4">
                                <div class="form-group">
                                    <div class="alert-form alert_4 text-danger"></div>
                                    <input type="number" min="1" id="edit_age_input" class="form-control" value="{{ $user->age }}" placeholder="Age">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_21 text-danger"></div>
                                    <select id="edit_genotype_input" class="selectpicker form-control">
                                        <option value="">Select genotype</option>
                                        @if(count($genotypes))
                                        @foreach($genotypes as $genotype)
                                            <option value="{{ $genotype->genotype }}" {{  $user->genotype == $genotype->genotype ? 'selected' : '' }}>{{ ucfirst($genotype->genotype) }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_5 text-danger"></div>
                                    <select id="edit_religion_input"class="selectpicker form-control">
                                        <option value="">Select religion</option>
                                        <option value="christian" {{  $user->religion == 'christian' ? 'selected' : '' }}>Christian</option>
                                        <option value="muslim" {{  $user->religion == 'muslim' ? 'selected' : '' }}>Muslim</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_6 text-danger"></div>
                                    <input type="date" id="edit_date_of_birth_input" class="form-control" value="{{ $user->date_of_birth ? date('Y-m-d', strtotime($user->date_of_birth)) : '' }}" placeholder="Date of birth">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_7 text-danger"></div>
                                    <select id="edit_location_input" class="selectpicker form-control">
                                        <option value="">Select location</option>
                                        @if(count($states))
                                        @foreach($states as $state)
                                            <option value="{{ $state->state }}" {{   $state->state == strtoupper($user->location) ? 'selected' : '' }}>{{ strtoupper($state->state) }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-12 mt-4">
                                <div class="form-group">
                                    <button type="button" data-url="{{ url('/edit-detail-info') }}" id="edit_detail_info_submit_btn" class="btn-fill-block">Update Detail</button>
                                    <div class="form-error-alert form_alert_0 text-danger"></div>
                                </div>
                            </div>
                        </div>
                     </form>
                </div>
            <div>
        <div>
    <div>
</section>
<!-- EDIT DETAIL INFO END-->

